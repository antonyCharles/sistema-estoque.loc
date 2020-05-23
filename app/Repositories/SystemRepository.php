<?php

namespace App\Repositories;

use App\Models\System;
use App\Repositories\Interfaces\ISystemRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SystemRepository implements ISystemRepository
{
	public function getFirstSystem() : System
	{
        try
        {
            $system =  System::with('roles')->first();
        }
        catch(QueryException $e)
        {
            throw new Exception(trans('exceptions.querySelect',['message' =>  $e->getMessage()]));
        }
        catch(Exception $e)
        {
            throw new Exception(trans('exceptions.generic',['message' =>  $e->getMessage()]));
		}
		
		return $system;
	}
	
    public function updateSystem(array $dados) : bool
	{
		try
		{
			$dados['updated_at'] = date("Y-m-d H:i:s");
			$system = System::first();
			$system->update($dados);
		}
		catch(QueryException $e)
		{
			throw new Exception(trans('exceptions.QueryUpdate',['message' =>  $e->getMessage()]));
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.generic',['message' =>  $e->getMessage()]));
		}

		return true;
	}
}