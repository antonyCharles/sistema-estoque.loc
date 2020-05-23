<?php

namespace App\Http\Controllers;

use Exception;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\RoleActionItemRequest;
use App\Repositories\Interfaces\IRoleActionItemRepository;
use App\Repositories\Interfaces\IRoleActionRepository;

class RoleActionItemController extends Controller
{
    private $repository;
    private $roleActionRepository;

    public function __construct(
        IRoleActionItemRepository $repository,
        IRoleActionRepository $roleActionRepository
    )
    {
        $this->repository = $repository;
        $this->roleActionRepository = $roleActionRepository;
    }

    public function update(int $roleActionId)
    {
        try
        {
            $this->data['roleAction'] = $this->roleActionRepository->getRoleActionById($roleActionId);

            if($this->data['roleAction'] == null)
                throw new Exception(trans('exceptions.notExist'));
        }
        catch(Exception $e)
        {
            return redirect()->action('SystemController@detail')->with(['msg-redirect-erro' => $e->getMessage()]);
        }

        return View('roleActionItem.update',$this->data);
    }

    public function updatePost(int $id, RoleActionItemRequest $request)
    {
        $msg = "";
        try
        {
            $dados = $request->all();
            $result = $this->repository->alterRoleActionItemUpdateInsertRemove($dados);

            if($result)
                return redirect()
                    ->action('RoleActionItemController@update',$id)
                    ->with(['msg-redirect-sucesso' => trans('message.successUpdate',['item' => 'Roles Action Item'])]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('RoleActionItemController@update',$id)->with(['msg-redirect-erro' => trans('exceptions.queryUpdate',['message' => $msg])]);
    }
}
