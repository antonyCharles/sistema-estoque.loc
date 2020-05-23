<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\RoleProfileRequest;
use App\Repositories\Interfaces\IRoleProfileRepository;
use App\Repositories\Interfaces\IProfileRepository;
use App\Repositories\Interfaces\IRoleRepository;
use Illuminate\Support\Collection;

class RoleProfileController extends Controller
{
    private $repository;
    private $profileRepository;
    private $roleRepository;

    public function __construct(
        IRoleProfileRepository $repository,
        IProfileRepository $profileRepository,
        IRoleRepository $roleRepository
    )
    {
        $this->repository = $repository;
        $this->profileRepository = $profileRepository;
        $this->roleRepository = $roleRepository;
    }

    public function update(int $id)
    {
        try
        {
            $this->data['profile'] = $this->profileRepository->getProfileById($id);

            if($this->data['profile'] == null)
                throw new Exception(trans('exceptions.notExist'));

            $this->data['roles'] = $this->roleRepository->getAllRecursiveRoles();

            if($this->data['roles'] == null)
                throw new Exception(trans('exceptions.notExist'));

        }
        catch(Exception $e)
        {
            redirect()->back()->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('roleProfile.update',$this->data);
    }

    public function updatePost(int $id, RoleProfileRequest $request)
    {
        try
        {
            $requestAll = $request->all();

            $result = $this->repository->alterRolesProfileUpdateInsertRemove($requestAll);

            return redirect()
                ->action('RoleProfileController@update',$id)
                ->with(['msg-redirect-sucesso' => trans('message.successUpdate',['item' => 'Roles Profile'])]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }
        
        return redirect()->action('RoleProfileController@updatePost',$id)->withInput()->withErrors($msg);
    }
}
