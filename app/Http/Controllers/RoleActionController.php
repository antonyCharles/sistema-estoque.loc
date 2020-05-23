<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\RoleActionRequest;
use App\Repositories\Interfaces\IRoleActionRepository;

class RoleActionController extends Controller
{
    private $repository;

    public function __construct(IRoleActionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        return View('roleAction.create');
    }

    public function createPost(RoleActionRequest $request)
    {
        try
        {
            $requestAll =$request->all();
            $result = $this->repository->insertRoleAction($requestAll);

            return redirect()
                ->action('SystemController@detail')
                ->with(['msg-redirect-sucesso' => trans('message.successInsert',['item' => $requestAll['name']])]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }

        return redirect()->action('RoleActionController@createPost')->withInput()->withErrors($msg);
    }

    public function update(int $id)
    {
        try
        {
            $this->data['roleAction'] = $this->repository->getRoleActionById($id);

            if($this->data['roleAction'] == null)
                throw new Exception(trans('exceptions.notExist'));
        }
        catch(Exception $e)
        {
            return redirect()
                    ->action('SystemController@detail')
                    ->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('roleAction.update',$this->data);
    }

    public function updatePost(int $id, RoleActionRequest $request)
    {
        try
        {
            $requestAll = $request->all();

            if($id != $requestAll['role_action_id'])
                throw new Exception(trans('exceptions.notExist'));

            $result = $this->repository->updateRoleAction($id, $requestAll);

            return redirect()
                ->action('SystemController@detail')
                ->with(['msg-redirect-sucesso' => trans('message.successUpdate',['item' => $requestAll['name']])]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }

        return redirect()->action('RoleActionController@updatePost',$id)->withInput()->withErrors($msg);
    }

    public function delete(int $id)
    {
        try
        {
            $this->data['roleAction'] = $this->repository->getRoleActionById($id);

            if($this->data['roleAction'] == null)
                throw new Exception(trans('exceptions.notExist'));

        }
        catch(Exception $e)
        {
            return redirect()
                ->action('SystemController@detail')
                ->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('roleAction.delete',$this->data);
    }

    public function deletePost(int $id, Request $request)
    {
        try
        {
            $request->validate(['role_action_id' => 'required|numeric']);

            $result = $this->repository->deleteRoleAction($request->role_action_id);

            return redirect()
                ->action('SystemController@detail')
                ->with(['msg-redirect-sucesso' => trans('message.successDelete')]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }

        return redirect()->action('RoleActionController@delete',$id)->with(['msg-redirect-erro' => $msg]);
    }
}
