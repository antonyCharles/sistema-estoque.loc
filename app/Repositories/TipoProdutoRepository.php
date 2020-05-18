<?php

namespace App\Repositories;

use Exception;
use App\Models\TipoProduto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use App\Repositories\Repository;
use App\Repositories\Interfaces\ITipoProdutoRepository;

class TipoProdutoRepository extends Repository implements ITipoProdutoRepository
{
	public function getAll() : Collection
	{
		try{
			return TipoProduto::all();
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
	
	public function getId(int $id) : TipoProduto
	{
		try{
			return TipoProduto::find($id);
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

	public function GetTipoProdutoAllSelect() : Collection
    {
		try{
			return TipoProduto::pluck('tpp_descricao','tpp_codigo');
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
			TipoProduto::create($dados);
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
			$func = TipoProduto::findOrFail($id);
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

	public function delete(int $id, string $campo = 'tpp_codigo') : bool
	{
		try
		{
			TipoProduto::where($campo, '=', $id)->delete();
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