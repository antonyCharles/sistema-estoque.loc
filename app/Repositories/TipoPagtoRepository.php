<?php

namespace App\Repositories;

use Exception;
use App\Models\TipoPagto;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use App\Repositories\Interfaces\ITipoPagtoRepository;

class TipoPagtoRepository extends Repository implements ITipoPagtoRepository
{
	public function getAll() : Collection
	{
		try{
			return TipoPagto::all();
		}
		catch (QueryException $e)
		{
			throw new Exception(trans('msgErros.QuerySelect',['message' =>  $e->getMessage()]));
		}
		catch(\Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
	}
	
	public function getId(int $id) : TipoPagto
	{
		try{
			return TipoPagto::find($id);
		}
		catch (QueryException $e)
		{
			throw new Exception(trans('msgErros.QuerySelect',['message' =>  $e->getMessage()]));
		}
		catch(\Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
	}

	public function GetTipoPagtoAllSelect() : Collection
	{
		try{
			return TipoPagto::pluck('tpg_descricao','tpg_codigo');
		}
		catch (QueryException $e)
		{
			throw new Exception(trans('msgErros.QuerySelect',['message' =>  $e->getMessage()]));
		}
		catch(\Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
	}

	public function insert(array $dados) : bool
	{
		try
		{
			TipoPagto::create($dados);
		}
		catch (QueryException $e)
		{
			throw new Exception(trans('msgErros.QueryInsert',['message' =>  $e->getMessage()]));
		}
		catch(\Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
		
		return true;
	}

	public function update(int $id, array $dados) : bool
	{
		try
		{
			$func = TipoPagto::findOrFail($id);
			$func->update($dados);
		}
		catch (QueryException $e)
		{
			throw new Exception(trans('msgErros.QueryUpdate',['message' =>  $e->getMessage()]));
		}
		catch(\Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}

		return true;
	}

	public function delete(int $id, string $campo = 'tpg_codigo') : bool
	{
		try
		{
			TipoPagto::where($campo, '=', $id)->delete();
		}
		catch (QueryException $e)
		{
			if("23000" == $e->getCode())
				throw new Exception(trans('msgErros.QueryDeleteForeachKey'));
				
			throw new Exception(trans('msgErros.QueryDelete',['message' =>  $e->getMessage()]));
		}
		catch(\Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}

		return true;
	}
}