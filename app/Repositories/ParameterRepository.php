<?php

namespace App\Repositories;

use App\Models\Parameter;
use App\Repositories\Interfaces\IParameterRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ParameterRepository implements IParameterRepository
{
    public function getParametersAll() : Collection
	{
        try
        {
            $parameters =  Parameter::all();
        }
        catch(Exception $e)
        {
            throw new Exception(trans('exceptions.querySelect', ['message' => $e->getMessage()]));
		}
		
		return $parameters;
	}
	
	public function getGParametersAllByActive() : Collection
	{
        try
        {
            $parameters =  Parameter::where('status','A')->get();
        }
        catch(Exception $e)
        {
            throw new Exception(trans('exceptions.querySelect', ['message' => $e->getMessage()]));
		}
		
		return $parameters;
	}

	public function getParameterById(int $id) : Parameter
	{
		try
		{
			$parameter = Parameter::find($id);
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.querySelect', ['message' => $e->getMessage()]));
		}

		return $parameter;
	}

	public function insertParameter(array $dados) : bool
	{
		try
		{
			$dados['created_at'] = date("Y-m-d H:i:s");
			Parameter::create($dados);
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.queryInsert', ['message' => $e->getMessage()]));
		}

		return true;
	}

	public function updateParameter(int $id, array $dados) : bool
	{
		try
		{
			$dados['updated_at'] = date("Y-m-d H:i:s");
			$parameter = Parameter::find($id);
			$parameter->update($dados);
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.queryUpdate', ['message' => $e->getMessage()]));
		}

		return true;
	}

	public function deleteParameter(int $id, string $field = 'parameter_id') : bool
	{
		try
		{
			Parameter::where($field, '=', $id)->delete();
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