<?php

namespace App\Http\Controllers;

use Exception;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Repositories\Interfaces\IRoleRepository;
use App\Repositories\Interfaces\IRoleActionRepository;

class RoleController extends Controller
{
    private $repository;
    private $roleActionRepository;

    public function __construct(
        IRoleRepository $repository,
        IRoleActionRepository $roleActionRepository
    )
    {
        $this->repository = $repository;
        $this->roleActionRepository = $roleActionRepository;
    }

    public function update()
    {
        try
        {
            $this->data['roles'] = $this->repository->getAllRecursiveRoles();

            if($this->data['roles'] == null)
                throw new Exception(trans('exceptions.notExist'));

            $this->data['rolesSelect'] = $this->repository->GetAllSelectRoles();

            $this->data['rolesActions'] = $this->roleActionRepository->GetRolesActionsAllSelect();

        }
        catch(Exception $e)
        {
            return redirect()->action('SystemController@detail')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('role.update',$this->data);
    }

    public function updatePost(RoleRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            $result = $this->repository->alterRolesUpdateInsertRemove($dados);

            if($result)
                return redirect()
                    ->action('RoleController@update')
                    ->with(['msg-redirect-sucesso' => trans('message.successUpdate',['item' => 'Roles'])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('RoleController@update')->with(['msg-redirect-erro' => trans('exceptions.queryUpdate',['message' => $msg])]);
    }
}
