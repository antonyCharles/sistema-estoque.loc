<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\GroupParameterRequest;
use App\Repositories\Interfaces\IGroupParameterRepository;

class GroupParameterController extends Controller
{
    private $repository;

    public function __construct(IGroupParameterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        try
        {
            $this->data['groupsParameters'] = $this->repository->getGroupsParametersAll();
        }
        catch(Exception $e)
        {
            redirect()->back()->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('groupParameter.list',$this->data);
    }

    public function create()
    {
        return View('groupParameter.create');
    }

    public function createPost(GroupParameterRequest $request)
    {
        try
        {
            $requestAll =$request->all();
            $result = $this->repository->insertGroupParameter($requestAll);

            return redirect()
                ->action('GroupParameterController@list')
                ->with(['msg-redirect-sucesso' => trans('message.successInsert',['item' => $requestAll['name']])]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }

        return redirect()->action('GroupParameterController@createPost')->withInput()->withErrors($msg);
    }

    public function update(int $id)
    {
        try
        {
            $this->data['groupParameter'] = $this->repository->getGroupParameterById($id);

            if($this->data['groupParameter'] == null)
                throw new Exception(trans('exceptions.notExist'));
        }
        catch(Exception $e)
        {
            return redirect()
                    ->action('GroupParameterController@list')
                    ->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('groupParameter.update',$this->data);
    }

    public function updatePost(int $id, GroupParameterRequest $request)
    {
        try
        {
            $requestAll = $request->all();

            if($id != $requestAll['group_parameter_id'])
                throw new Exception(trans('exceptions.notExist'));

            $result = $this->repository->updateGroupParameter($id, $requestAll);

            return redirect()
                ->action('GroupParameterController@list')
                ->with(['msg-redirect-sucesso' => trans('message.successUpdate',['item' => $requestAll['name']])]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }

        return redirect()->action('GroupParameterController@updatePost',$id)->withInput()->withErrors($msg);
    }

    public function delete(int $id)
    {
        try
        {
            $this->data['groupParameter'] = $this->repository->getGroupParameterById($id);

            if($this->data['groupParameter'] == null)
                throw new Exception(trans('exceptions.notExist'));

        }
        catch(Exception $e)
        {
            return redirect()
                ->action('GroupParameterController@list')
                ->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('groupParameter.delete',$this->data);
    }

    public function deletePost(int $id, Request $request)
    {
        try
        {
            $request->validate(['group_parameter_id' => 'required|numeric']);

            $result = $this->repository->deleteGroupParameter($request->group_parameter_id);

            return redirect()
                ->action('GroupParameterController@list')
                ->with(['msg-redirect-sucesso' => trans('message.successDelete')]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }

        return redirect()->action('GroupParameterController@delete',$id)->with(['msg-redirect-erro' => $msg]);
    }
}
