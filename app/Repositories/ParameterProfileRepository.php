<?php

namespace App\Repositories;

use App\Models\ParameterProfile;
use App\Repositories\Interfaces\IParameterProfileRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ParameterProfileRepository implements IParameterProfileRepository
{
	public function alterParameterProfileUpdateInsertRemove(array $dados) : bool
	{
		try
		{
			$list = collect();

            for($i = 0; $i < count($dados['parameter_id']); $i++){
				$value = null;
				if(isset($dados['value'][$i]))
					$value = is_array($dados['value'][$i]) ? json_encode($dados['value'][$i]) : $dados['value'][$i];
					
                $list->push(array(
                    'parameter_profile_id' => isset($dados['parameter_profile_id'][$i]) ? $dados['parameter_profile_id'][$i] : null,
                    'parameter_id' => $dados['parameter_id'][$i],
					'profile_id' => $dados['profile_id'],
                    'value' =>  $value
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
						->where('parameter_profile_id',null)
						->where('value','!=',null)
						->map(function ($item,$k){
				return array(
                    'parameter_id' => $item['parameter_id'],
                    'profile_id' => $item['profile_id'],
                    'profile_id' => $item['profile_id'],
					'value' => $item['value'],
					'created_at' => date("Y-m-d H:i:s")
				);
			})->all();
			
			DB::table('logn_parameters_profiles')->insert($dados);
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
				->where('parameter_profile_id','!=',null)
				->where('value','!=',null)
				->each(function ($item,$k){
					ParameterProfile::find($item['parameter_profile_id'])->update([
                    'value' => $item['value'],
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
						->where('parameter_profile_id','!=',null)
						->where('value',null)
						->map(function ($item,$k){
							return $item['parameter_profile_id'];
						})->all();
			
			DB::table('logn_parameters_profiles')->whereIn('parameter_profile_id',$dados)->delete();
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