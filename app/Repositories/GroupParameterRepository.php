<?php

namespace App\Repositories;

use App\Models\GroupParameter;
use App\Repositories\Interfaces\IGroupParameterRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GroupParameterRepository implements IGroupParameterRepository
{
    public function getGroupsParametersAll() : Collection
	{
        try
        {
            $groupsParameters =  GroupParameter::all();
        }
        catch(Exception $e)
        {
            throw new Exception(trans('exceptions.querySelect', ['message' => $e->getMessage()]));
		}
		
		return $groupsParameters;
	}
	
	public function getGroupsParametersAllByActive() : Collection
	{
        try
        {
            $groupsParameters =  GroupParameter::with('parameters')->where('status','A')->orderBy('name')->get();
        }
        catch(Exception $e)
        {
            throw new Exception(trans('exceptions.querySelect', ['message' => $e->getMessage()]));
		}
		
		return $groupsParameters;
	}
	
	public function GetGroupsParametersAllSelect() : Collection
	{
		try
		{
			return GroupParameter::where('status','A')->pluck('name','group_parameter_id');
		}
		catch(\Exception $e)
		{
			throw new Exception(trans('msgErros.querySelect',['message' =>  $e->getMessage()]));
		}
	}

	public function getGroupParameterById(int $id)  : GroupParameter
	{
		try
		{
			$groupParameter = GroupParameter::find($id);
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.querySelect', ['message' => $e->getMessage()]));
		}

		return $groupParameter;
    }
    
	public function insertGroupParameter(array $dados) : bool
	{
		try
		{
			$dados['created_at'] = date("Y-m-d H:i:s");
			GroupParameter::create($dados);
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.queryInsert', ['message' => $e->getMessage()]));
		}

		return true;
	}

	public function updateGroupParameter(int $id, array $dados) : bool
	{
		try
		{
			$dados['updated_at'] = date("Y-m-d H:i:s");
			$groupParameter = GroupParameter::find($id);
			$groupParameter->update($dados);
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.queryUpdate', ['message' => $e->getMessage()]));
		}

		return true;
	}

	public function deleteGroupParameter(int $id, string $field = 'group_parameter_id') : bool
	{
		try
		{
			GroupParameter::where($field, '=', $id)->delete();
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