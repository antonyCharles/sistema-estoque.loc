<?php

namespace App\Repositories;

use App\Models\RoleAction;
use App\Repositories\Interfaces\IRoleActionRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RoleActionRepository implements IRoleActionRepository
{
	public function getRoleActionById(int $id) : RoleAction
	{
		try
		{
			$roleAction = RoleAction::find($id);
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.querySelect', ['message' => $e->getMessage()]));
		}

		return $roleAction;
	}

    public function getRoleActionAll() : Collection
	{
        try
        {
            $rolesActions =  RoleAction::all();
        }
        catch(Exception $e)
        {
            throw new Exception(trans('exceptions.querySelect', ['message' => $e->getMessage()]));
		}
		
		return $rolesActions;
    }
    
    public function GetRolesActionsAllSelect() : Collection
	{
		try
		{
			return RoleAction::where('status','A')->pluck('name','role_action_id');
		}
		catch(\Exception $e)
		{
			throw new Exception(trans('msgErros.querySelect',['message' =>  $e->getMessage()]));
		}
    }
    
	public function insertRoleAction(array $dados) : bool
	{
		try
		{
			$dados['created_at'] = date("Y-m-d H:i:s");
			
			RoleAction::create($dados);
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.queryInsert', ['message' => $e->getMessage()]));
		}

		return true;
	}

	public function updateRoleAction(int $id, array $dados) : bool
	{
		try
		{
			$dados['updated_at'] = date("Y-m-d H:i:s");
			$roleAction = RoleAction::find($id);
			$roleAction->update($dados);
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.queryUpdate', ['message' => $e->getMessage()]));
		}

		return true;
	}

	public function deleteRoleAction(int $id, string $field = 'role_action_id') : bool
	{
		try
		{
			RoleAction::where($field, '=', $id)->delete();
		}
		catch(QueryException $e)
		{
			if("23000" == $e->getCode())
				throw new Exception(trans('exceptions.queryDeleteForeachKey'));
				
			throw new Exception($e->getMessage());
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.queryDelete', ['message' => $e->getMessage()]));
		}

		return true;
	}
}