<?php

namespace App\Repositories;

use Exception;
use App\Models\Produto;
use App\Repositories\Repository;
use App\Helpers\MonetarioHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use App\Repositories\Interfaces\IProdutoRepository;

class ProdutoRepository extends Repository implements IProdutoRepository
{
	public function getAll() : Collection
	{
		try{
			return Produto::with('tipoProduto')->get();
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

	public function GetAllEmEstoque() : Collection
	{
		try{
			return Produto::with('tipoProduto')->where('pro_estoque' ,'>', 0)->get();
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
	
	public function getId(int $id) : Produto
	{
		try{
			return Produto::find($id);
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

	public function getInListId(array $listaId) : Collection
	{
		try{
			return DB::table('tb_produtos')->whereIn('pro_codigo', $listaId)->get();
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

	public function GetProdutoAllSelect() : Collection
	{
		try{
			return Produto::pluck('pro_descricao','pro_codigo');
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
			$dados['pro_precocusto'] = MonetarioHelper::fromatarValorDB($dados['pro_precocusto']);
			$dados['pro_precovenda'] = MonetarioHelper::fromatarValorDB($dados['pro_precovenda']);
			$dados['pro_ipi'] = MonetarioHelper::fromatarValorDB($dados['pro_ipi']);

			Produto::create($dados);
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
			$prod = Produto::findOrFail($id);

			$dados['pro_precocusto'] = MonetarioHelper::fromatarValorDB($dados['pro_precocusto']);
			$dados['pro_precovenda'] = MonetarioHelper::fromatarValorDB($dados['pro_precovenda']);
			$dados['pro_ipi'] = MonetarioHelper::fromatarValorDB($dados['pro_ipi']);

			$prod->update($dados);
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

	public function addQuantidadeList(Collection $lista) : void
	{
		try
		{
			foreach($lista->all() as $i)
			{
				$prod = Produto::findOrFail($i->pro_codigo);
				$quantNova = $prod->pro_estoque + $i->itc_qtde;

				DB::table('tb_produtos')
					->where('pro_codigo', $i->pro_codigo)
					->update(['pro_estoque' => $quantNova]);
			}
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	public function removeQuantidadeList(Collection $lista) : void
	{
		try
		{
			foreach($lista->all() as $i)
			{
				$prod = Produto::findOrFail($i->pro_codigo);
				$quantNova = $prod->pro_estoque - $i->itv_qtde;

				DB::table('tb_produtos')
					->where('pro_codigo', $i->pro_codigo)
					->update(['pro_estoque' => $quantNova]);
			}
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	public function delete(int $id, string $campo = 'pro_codigo') : bool
	{
		try
		{
			Produto::where($campo, '=', $id)->delete();
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