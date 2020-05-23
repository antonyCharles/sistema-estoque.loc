<?php

namespace App\Repositories;

use App\Models\RoleProfile;
use App\Repositories\Interfaces\IRoleProfileRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RoleProfileRepository implements IRoleProfileRepository
{
	public function getRoleProfileForCache() : Collection
	{
		try
		{
			$result = DB::table('logn_roles_profiles')
						->join('logn_roles','logn_roles_profiles.role_id','=','logn_roles.role_id')
						->join('logn_systems','logn_roles.system_id','=','logn_systems.system_id')
						->join('logn_roles_actions_itens','logn_roles_profiles.role_action_item_id','=','logn_roles_actions_itens.role_action_item_id')
						->join('logn_profiles','logn_roles_profiles.profile_id','=','logn_profiles.profile_id')
						->select(
								'logn_roles_profiles.profile_id as profile_id',
								'logn_systems.abrrev as system_abrrev',
								'logn_roles.role as role',
								'logn_roles_actions_itens.slug as slug'
								)
						->where([
							['logn_roles.status','=','A'],
							['logn_profiles.status','=','A']
						])->orderBy('logn_roles_profiles.role_id')->get();
		}
		catch(QueryException $e)
		{
			throw new Exception($e->getMessage());
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}

		return $result;
	}

	public function ExistRelationshipRoleIdAndRoleActionId(int $roleId, int $roleActionId) : bool
	{
		try
		{
			$result = DB::table('logn_roles_profiles')
							->join('logn_roles_actions_itens','logn_roles_profiles.role_action_item_id','=','logn_roles_actions_itens.role_action_item_id')
							->where([
								['logn_roles_profiles.role_id','=',$roleId],
								['logn_roles_actions_itens.role_action_id','=',$roleActionId]
							])->count();
			$result = $result > 0 ? true : false;
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}

		return $result;
	}

	public function alterRolesProfileUpdateInsertRemove(array $dados) : bool
	{
		try
		{
			$list = collect();

            for($i = 0; $i < count($dados['role_id']); $i++){
                $list->push(array(
                    'role_id' => $dados['role_id'][$i],
                    'profile_id' => $dados['profile_id'],
                    'role_profile_id' => isset($dados['role_profile_id'][$i]) ? $dados['role_profile_id'][$i] : null,
                    'role_action_item_id' => isset($dados['role_action_item_id'][$i]) ? $dados['role_action_item_id'][$i] : null
                ));
			}
			
			$this->insertList($list);
			//$this->updateList($list);
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
			$dados = $list
						->where('role_profile_id',null)
						->where('role_action_item_id','!=',null)
						->map(function ($item,$k){
				return array(
                    'role_id' => $item['role_id'],
                    'profile_id' => $item['profile_id'],
                    'role_action_item_id' => $item['role_action_item_id'],
					'created_at' => date("Y-m-d H:i:s")
				);
			})->all();
			
			DB::table('logn_roles_profiles')->insert($dados);
		}
		catch(QueryException $e)
		{
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
			$list
				->where('role_profile_id','!=',null)
				->where('totalNone','!=','N')
				->each(function ($item,$k){
				RoleProfile::find($item['role_profile_id'])->update([
                    'create' => $item['create'],
					'read' => $item['read'],
					'update' => $item['update'],
					'delete' => $item['delete'],
					'updated_at' => date("Y-m-d H:i:s")
				]);
			});
		}
		catch(QueryException $e)
		{
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
			$dados = $list
						->where('role_profile_id','!=',null)
						->where('role_action_item_id',null)
						->map(function ($item,$k){
							return $item['role_profile_id'];
						})->all();
			
			DB::table('logn_roles_profiles')->whereIn('role_profile_id',$dados)->delete();
		}
		catch(QueryException $e)
		{
			throw new Exception($e->getMessage());
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}

		return true;
	}
}