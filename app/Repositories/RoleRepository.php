<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\IRoleRepository;
use App\Repositories\Interfaces\ISystemRepository;
use App\Repositories\Interfaces\IRoleProfileRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RoleRepository implements IRoleRepository
{
	private $systemRepository;
	private $roleProfileRepository;

	public function __construct(
		ISystemRepository $systemRepository,
		IRoleProfileRepository $roleProfileRepository
	)
    {
		$this->systemRepository = $systemRepository;
		$this->roleProfileRepository = $roleProfileRepository;
	}
	public function GetAllSelectRoles() : Collection
	{
		try{
			return Role::select('name','role_id')->where('status','=','A')->get();
		}
		catch(QueryException $e)
		{
			throw new Exception($e->getMessage());
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	public function getAllRecursiveRoles() : Collection
	{
        try
        {
			return Role::whereNull('role_father_id')->with('allChildrenRoles','roleAction','roleAction.roleActionItens')->get();
        }
        catch(QueryException $e)
        {
            throw new Exception($e->getMessage());
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
	}
    
	public function alterRolesUpdateInsertRemove(array $dados) : bool
	{
		try
		{
			$systemId = ($this->systemRepository->getFirstSystem())->system_id;

			$list = collect();

            for($i = 0; $i < count($dados['item_status']); $i++){
                $list->push(array(
                    'role_id' => $dados['role_id'][$i],
                    'item_status' => $dados['item_status'][$i],
                    'name' => $dados['name'][$i],
                    'role' => $dados['role'][$i],
					'role_father_id' => $dados['role_father_id'][$i],
					'role_action_id' => $dados['role_action_id'][$i],
					'status' => $dados['status'][$i],
					'system_id' => $systemId
                ));
			}
			
			$this->insertList($list);
			$this->updateList($list);
			$this->removeList($list);
		}	
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}

		return true;
	}

	private function insertList(Collection $list) : bool
	{
		try
		{
			$dados = $list->where('item_status','insert')->map(function ($item,$k){
				return array(
                    'name' => $item['name'],
                    'role' => $item['role'],
					'role_father_id' => $item['role_father_id'],
					'role_action_id' => $item['role_action_id'],
					'status' => $item['status'],
					'system_id' => $item['system_id'],
					'created_at' => date("Y-m-d H:i:s")
				);
			})->all();
			
			DB::table('logn_roles')->insert($dados);
		}
		catch(QueryException $e)
		{
			if(isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062)
				throw new Exception(trans('exceptions.queryRoleDuplicate'));
				
			throw new Exception($e->getMessage());
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}

		return true;
	}

    private function updateList(Collection $list) : bool
	{
		try
		{
			$mRoleProfile = $this->roleProfileRepository;

			$list->where('item_status','update')->map(function ($item,$k) use($mRoleProfile){
				$role = Role::find($item['role_id']);
				
				if($mRoleProfile->ExistRelationshipRoleIdAndRoleActionId($item['role_id'],$role->role_action_id)){
					$item['role_action_id'] = $role->role_action_id;
				}

				$role->update([
					'name' => $item['name'],
					'role' => $item['role'],
					'role_father_id' => $item['role_father_id'],
					'role_action_id' => $item['role_action_id'],
					'status' => $item['status'],
					'updated_at' => date("Y-m-d H:i:s")
				]);
			});
		}
		catch(QueryException $e)
		{
			if(isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062)
				throw new Exception(trans('exceptions.queryRoleDuplicate'));
				

			throw new Exception($e->getMessage());
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}

		return true;
	}

	private function removeList(Collection $list) : bool
	{
		try
		{
			$dados = $list->where('item_status','remove')->map(function ($item,$k){
				return $item['role_id'];
			})->all();
			
			DB::table('logn_roles')->whereIn('role_id',$dados)->delete();
		}
		catch(QueryException $e)
		{
			if("23000" == $e->getCode())
				throw new Exception(trans('exceptions.queryDeleteForeachKey'));

			throw new Exception($e->getMessage());
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}

		return true;
	}
}