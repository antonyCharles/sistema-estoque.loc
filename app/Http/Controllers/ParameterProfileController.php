<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\ParameterProfileRequest;
use App\Repositories\Interfaces\IParameterProfileRepository;
use App\Repositories\Interfaces\IProfileRepository;
use App\Repositories\Interfaces\IGroupParameterRepository;
use Illuminate\Support\Collection;

class ParameterProfileController extends Controller
{
    private $repository;
    private $profileRepository;
    private $groupParameterRepository;

    public function __construct(
        IParameterProfileRepository $repository,
        IProfileRepository $profileRepository,
        IGroupParameterRepository $groupParameterRepository
    )
    {
        $this->repository = $repository;
        $this->profileRepository = $profileRepository;
        $this->groupParameterRepository = $groupParameterRepository;
    }

    public function update(int $id)
    {
        try
        {
            $this->data['profile'] = $this->profileRepository->getProfileById($id);

            if($this->data['profile'] == null)
                throw new Exception(trans('exceptions.notExist'));

            $this->data['groupsParameters'] = $this->groupParameterRepository->getGroupsParametersAllByActive();

            if($this->data['groupsParameters'] == null)
                throw new Exception(trans('exceptions.notExist'));

        }
        catch(Exception $e)
        {
            redirect()->back()->with(['msg-redirect-erro' => trans('exceptions.generic', ['message' => $e->getMessage()])]);
        }

        return View('parameterProfile.update',$this->data);
    }

    public function updatePost(int $id, ParameterProfileRequest $request)
    {
        try
        {
            $requestAll = $request->all();

            $result = $this->repository->alterParameterProfileUpdateInsertRemove($requestAll);

            return redirect()
                ->action('ParameterProfileController@update',$id)
                ->with(['msg-redirect-sucesso' => trans('message.successUpdate',['item' => 'Parameter Profile'])]);
        }
        catch(Exception $e)
        {
            $msg = trans('exceptions.generic', ['message' => $e->getMessage()]);
        }
        
        return redirect()->action('ParameterProfileController@updatePost',$id)->withInput()->withErrors($msg);
    }
}
