<?php

namespace App\Repositories;

use App\Models\RoleActionItem;
use App\Repositories\Interfaces\IRoleActionItemRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RoleActionItemRepository implements IRoleActionItemRepository
{
	public function alterRoleActionItemUpdateInsertRemove(array $dados) : bool
	{
		try
		{
			$list = collect();

            for($i = 0; $i < count($dados['role_action_item_id']); $i++){
                $list->push(array(
                    'role_action_item_id' => isset($dados['role_action_item_id'][$i]) ? $dados['role_action_item_id'][$i] : null,
                    'name' => $dados['name'][$i],
                    'slug' => strtoupper(trim($dados['slug'][$i])),
                    'role_action_id' => $dados['role_action_id'],
                    'status' => $dados['status'][$i],
                    'remove' => isset($dados['remove'][$i]) ? $dados['remove'][$i] : false
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
			$dados = $list
						->where('role_action_item_id',null)
						->map(function ($item,$k){
				return array(
                    'name' => $item['name'],
                    'slug' => $item['slug'],
                    'role_action_id' => $item['role_action_id'],
					'status' => $item['status'],
					'created_at' => date("Y-m-d H:i:s")
				);
			})->all();
			
			DB::table('logn_roles_actions_itens')->insert($dados);
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
				->where('role_action_item_id','!=',null)
				->where('remove','!=',true)
				->each(function ($item,$k){
				RoleActionItem::find($item['role_action_item_id'])->update([
                    'name' => $item['name'],
                    'slug' => $item['slug'],
                    'role_action_id' => $item['role_action_id'],
					'status' => $item['status'],
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
						->where('role_action_item_id','!=',null)
						->where('remove','=','true')
						->map(function ($item,$k){
							return $item['role_action_item_id'];
						})->all();
			
			DB::table('logn_roles_actions_itens')->whereIn('role_action_item_id',$dados)->delete();
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