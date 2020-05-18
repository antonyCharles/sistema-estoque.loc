<?php

namespace App\Repositories;

use Exception;
use App\Models\ItensCompra;
use App\Helpers\MonetarioHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use App\Repositories\Repository;
use App\Repositories\Interfaces\IProdutoRepository;
use App\Repositories\Interfaces\IItensCompraRepository;

class ItensCompraRepository extends Repository implements IItensCompraRepository
{
	private $produtoRepository;

	public function __construct(IProdutoRepository $produtoRepository)
	{
		$this->produtoRepository = $produtoRepository;
	}

	public function getAll() : Collection
	{
		try{
			return ItensCompra::all();
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
	
	public function getId(int $id) : ItensCompra
	{
		try{
			return ItensCompra::find($id);
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

	public function getItensCompraByCompraId(int $compraId) : ItensCompra
	{
		try{
			return ItensCompra::with('produto')->where('com_codigo',$compraId)->get();
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

	public function createListItensCompraforCompra(array $dados, Collection $itensCompras) : float
	{
		$result = 0;
		try{
			$listProdutos = $this->produtoRepository->getInListId($dados['pro_codigo']);

			for($i = 0; $i < count($dados['pro_codigo']); $i++)
			{
				$pro = $listProdutos->firstWhere('pro_codigo',$dados['pro_codigo'][$i]);

				if($pro == null)
					throw new Exception(trans('msgErros.produtoNotExit',['id' => $dados['pro_codigo'][$i]]));


				$valorTotal = ($pro->pro_precocusto * $dados['com_quantidade'][$i]) - MonetarioHelper::fromatarValorDB($dados['com_desconto'][$i]);
				$result += $valorTotal;

				$item = new ItensCompra;
				$item->pro_codigo = $pro->pro_codigo;
				$item->itc_embalagem = $pro->pro_embalagem;
				$item->itc_qtde = $dados['com_quantidade'][$i];
				$item->itc_valorun = $pro->pro_precocusto;
				$item->itc_desc = MonetarioHelper::fromatarValorDB($dados['com_desconto'][$i]);
				$item->itc_valortotal = $valorTotal;

				$itensCompras->push($item);
			}
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}

		return $result;
	}

	public function insertForCompra(int $com_codigo, Collection $listItensCompra) : void
	{
		try
		{
			$dados = array();
			foreach($listItensCompra->all() as $i)
			{
				array_push($dados,array(
					"pro_codigo" => $i->pro_codigo,
					"itc_embalagem" => $i->itc_embalagem,
					"itc_qtde" => $i->itc_qtde,
					"itc_valorun" => $i->itc_valorun,
					"itc_desc" => $i->itc_desc,
					"itc_valortotal" => $i->itc_valortotal,
					"com_codigo" => $com_codigo,
				));
			}

			DB::table('tb_itenscompra')->insert($dados);
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	public function update(int $id, array $dados) : bool
	{
		try
		{
			$dados['itc_valorun'] = MonetarioHelper::fromatarValorDB($dados['itc_valorun']);
			$dados['itc_valortotal'] = MonetarioHelper::fromatarValorDB($dados['itc_valortotal']);
			
			$func = ItensCompra::findOrFail($id);
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

	public function delete(int $id, string $campo = 'itc_codigo') : bool
	{
		try
		{
			ItensCompra::where($campo, '=', $id)->delete();
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