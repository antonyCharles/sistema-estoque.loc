<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\SystemRequest;
use App\Repositories\Interfaces\ISystemRepository;
use App\Repositories\Interfaces\IRoleRepository;
use App\Repositories\Interfaces\IRoleActionRepository;

class SystemController extends Controller
{
    private $repository;
    private $roleRepository;
    private $roleActionRepositoty;

    public function __construct(
        ISystemRepository $repository,
        IRoleRepository $roleRepository,
        IRoleActionRepository $roleActionRepositoty
    )
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
        $this->roleActionRepositoty = $roleActionRepositoty;
    }

    public function detail(){
        try{
            $this->data['system'] = $this->repository->getFirstSystem();

            $this->data['roles'] = $this->roleRepository->getAllRecursiveRoles();

            $this->data['rolesActions'] = $this->roleActionRepositoty->getRoleActionAll();
        }
        catch(Exception $e)
        {
            redirect()->back()->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('system.detail',$this->data);
    }

    public function update()
    {
        try
        {
            $this->data['system'] = $this->repository->getFirstSystem();

            if($this->data['system'] == null)
                throw new Exception(trans('exceptions.notExist'));

        }
        catch(Exception $e)
        {
            return redirect()->action('SystemController@detail')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('system.update',$this->data);
    }

    public function updatePost(SystemRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            
            $result = $this->repository->updateSystem($dados);

            if($result)
                return redirect()
                            ->action('SystemController@detail')
                            ->with(['msg-redirect-sucesso' => trans('message.successUpdate',['item' => $dados['name']])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('SystemController@updatePost')->withInput()->withErrors($msg);
    }
}