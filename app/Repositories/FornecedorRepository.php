<?php

namespace App\Repositories;

use Exception;
use App\Models\Fornecedor;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use App\Repositories\Interfaces\IFornecedorRepository;

class FornecedorRepository extends Repository implements IFornecedorRepository
{
	public function getAll() : Collection
	{
		try{
			return Fornecedor::all();
		}
		catch(QueryException $e)
		{
			throw new Exception(trans('msgErros.QuerySelect',['message' =>  $e->getMessage()]));
		}
		catch(Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
	}
	
	public function getId(int $id) : Fornecedor
	{
		try{
			return Fornecedor::find($id);
		}
		catch(QueryException $e)
		{
			throw new Exception(trans('msgErros.QuerySelect',['message' =>  $e->getMessage()]));
		}
		catch(Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
	}

	public function GetFornecedorAllSelect() : Collection
	{
		try{
			return Fornecedor::pluck('for_nome','for_codigo');
		}
		catch(QueryException $e)
		{
			throw new Exception(trans('msgErros.QuerySelect',['message' =>  $e->getMessage()]));
		}
		catch(Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
	}

	public function insert(array $dados) : bool
	{
		try
		{
			Fornecedor::create($dados);
		}
		catch(QueryException $e)
		{
			throw new Exception(trans('msgErros.QueryInsert',['message' =>  $e->getMessage()]));
		}
		catch(Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
		
		return true;
	}

	public function update(int $id, array $dados) : bool
	{
		try
		{
			$func = Fornecedor::findOrFail($id);
			$func->update($dados);
		}
		catch(QueryException $e)
		{
			throw new Exception(trans('msgErros.QueryUpdate',['message' =>  $e->getMessage()]));
		}
		catch(Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}

		return true;
	}

	public function delete(int $id, string $campo = 'for_codigo') : bool
	{
		try
		{
			Fornecedor::where($campo, '=', $id)->delete();
		}
		catch(QueryException $e)
		{
			if("23000" == $e->getCode())
				throw new Exception(trans('msgErros.QueryDeleteForeachKey'));
				
			throw new Exception(trans('msgErros.QueryDelete',['message' =>  $e->getMessage()]));
		}
		catch(Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}

		return true;
	}
}