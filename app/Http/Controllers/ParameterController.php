<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\ParameterRequest;
use App\Repositories\Interfaces\IParameterRepository;
use App\Repositories\Interfaces\IGroupParameterRepository;

class ParameterController extends Controller
{
    private $repository;
    private $groupParameterRepository;

    public function __construct(
        IParameterRepository $repository,
        IGroupParameterRepository $groupParameterRepository
    )
    {
        $this->repository = $repository;
        $this->groupParameterRepository = $groupParameterRepository;
    }

    public function list()
    {
        try
        {
            $this->data['parameters'] = $this->repository->getParametersAll();
        }
        catch(Exception $e)
        {
            redirect()->back()->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('parameter.list',$this->data);
    }

    public function create()
    {
        try
        {
            $this->data['groupsParameter'] = $this->groupParameterRepository->GetGroupsParametersAllSelect();
        }
        catch(Exception $e)
        {
            redirect()->back()->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('parameter.create',$this->data);
    }

    public function createPost(ParameterRequest $request)
    {
        try
        {
            $requestAll =$request->all();
            $result = $this->repository->insertParameter($requestAll);

            return redirect()
                ->action('ParameterController@list')
                ->with(['msg-redirect-sucesso' => trans('message.successInsert',['item' => $requestAll['label']])]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }

        return redirect()->action('ParameterController@createPost')->withInput()->withErrors($msg);
    }

    public function update(int $id)
    {
        try
        {
            $this->data['parameter'] = $this->repository->getParameterById($id);

            if($this->data['parameter'] == null)
                throw new Exception(trans('exceptions.notExist'));

            $this->data['groupsParameter'] = $this->groupParameterRepository->GetGroupsParametersAllSelect();
        }
        catch(Exception $e)
        {
            return redirect()
                    ->action('ParameterController@list')
                    ->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('parameter.update',$this->data);
    }

    public function updatePost(int $id, ParameterRequest $request)
    {
        try
        {
            $requestAll = $request->all();

            if($id != $requestAll['parameter_id'])
                throw new Exception(trans('exceptions.notExist'));

            $result = $this->repository->updateParameter($id, $requestAll);

            return redirect()
                ->action('ParameterController@list')
                ->with(['msg-redirect-sucesso' => trans('message.successUpdate',['item' => $requestAll['label']])]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }

        return redirect()->action('ParameterController@updatePost',$id)->withInput()->withErrors($msg);
    }

    public function delete(int $id)
    {
        try
        {
            $this->data['parameter'] = $this->repository->getParameterById($id);

            if($this->data['parameter'] == null)
                throw new Exception(trans('exceptions.notExist'));

        }
        catch(Exception $e)
        {
            return redirect()
                ->action('ParameterController@list')
                ->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('parameter.delete',$this->data);
    }

    public function deletePost(int $id, Request $request)
    {
        try
        {
            $request->validate(['parameter_id' => 'required|numeric']);

            $result = $this->repository->deleteParameter($request->parameter_id);

            return redirect()
                ->action('ParameterController@list')
                ->with(['msg-redirect-sucesso' => trans('message.successDelete')]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }

        return redirect()->action('ParameterController@delete',$id)->with(['msg-redirect-erro' => $msg]);
    }
}
