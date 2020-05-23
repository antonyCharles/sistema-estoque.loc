<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Repositories\Interfaces\IProfileRepository;

class ProfileController extends Controller
{
    private $repository;

    public function __construct(IProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        try
        {
            $this->data['profiles'] = $this->repository->getProfilesAll();
        }
        catch(Exception $e)
        {
            redirect()->back()->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('profile.list',$this->data);
    }

    public function create()
    {
        return View('profile.create');
    }

    public function createPost(ProfileRequest $request)
    {
        try
        {
            $requestAll =$request->all();
            $result = $this->repository->insertProfile($requestAll);

            return redirect()
                ->action('ProfileController@list')
                ->with(['msg-redirect-sucesso' => trans('message.successInsert',['item' => $requestAll['name']])]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }

        return redirect()->action('ProfileController@createPost')->withInput()->withErrors($msg);
    }

    public function update(int $id)
    {
        try
        {
            $this->data['profile'] = $this->repository->getProfileById($id);

            if($this->data['profile'] == null)
                throw new Exception(trans('exceptions.notExist'));
        }
        catch(Exception $e)
        {
            return redirect()
                    ->action('ProfileController@list')
                    ->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('profile.update',$this->data);
    }

    public function updatePost(int $id, ProfileRequest $request)
    {
        try
        {
            $requestAll = $request->all();

            if($id != $requestAll['profile_id'])
                throw new Exception(trans('exceptions.notExist'));

            $result = $this->repository->updateProfile($id, $requestAll);

            return redirect()
                ->action('ProfileController@list')
                ->with(['msg-redirect-sucesso' => trans('message.successUpdate',['item' => $requestAll['name']])]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }

        return redirect()->action('ProfileController@updatePost',$id)->withInput()->withErrors($msg);
    }

    public function delete(int $id)
    {
        try
        {
            $this->data['profile'] = $this->repository->getProfileById($id);

            if($this->data['profile'] == null)
                throw new Exception(trans('exceptions.notExist'));

        }
        catch(Exception $e)
        {
            return redirect()
                ->action('ProfileController@list')
                ->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('profile.delete',$this->data);
    }

    public function deletePost(int $id, Request $request)
    {
        try
        {
            $request->validate(['profile_id' => 'required|numeric']);

            $result = $this->repository->deleteProfile($request->profile_id);

            return redirect()
                ->action('ProfileController@list')
                ->with(['msg-redirect-sucesso' => trans('message.successDelete')]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }

        return redirect()->action('ProfileController@delete',$id)->with(['msg-redirect-erro' => $msg]);
    }
}
