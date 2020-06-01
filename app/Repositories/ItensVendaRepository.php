<?php

namespace App\Repositories;

use Exception;
use App\Models\ItensVenda;
use App\Helpers\MonetarioHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use App\Repositories\Repository;
use App\Repositories\Interfaces\IProdutoRepository;
use App\Repositories\Interfaces\IItensVendaRepository;

class ItensVendaRepository extends Repository implements IItensVendaRepository
{
	private $produtoRepository;

	public function __construct(IProdutoRepository $produtoRepository)
	{
		$this->produtoRepository = $produtoRepository;
	}

	public function getAll() : Collection
	{
		try{
			return ItensVenda::all();
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
	
	public function getId(int $id) : ItensVenda
	{
		try{
			return ItensVenda::find($id);
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

	public function getItensVendaByVendaId(int $vendaId) : ItensVenda
	{
		try{
			return ItensVenda::with('produto')->where('ven_codigo',$vendaId)->get();
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

	public function createListItensVendaforVenda(array $dados, Collection $itensVendas) : float
	{
		$result = 0;
		try{
			$listProdutos = $this->produtoRepository->getInListId($dados['pro_codigo']);

			for($i = 0; $i < count($dados['pro_codigo']); $i++)
			{
				$pro = $listProdutos->firstWhere('pro_codigo',$dados['pro_codigo'][$i]);

				if($pro == null)
					throw new Exception(trans('msgErros.produtoNotExit',['id' => $dados['pro_codigo'][$i]]));

				if($pro->pro_estoque < $dados['ven_quantidade'][$i])
					throw new Exception(trans('msgErros.quantProduto',['produto' => $pro->pro_descricao, 'quantidade' => $pro->pro_estoque]));


				$valorTotal = ($pro->pro_precovenda * $dados['ven_quantidade'][$i]) - MonetarioHelper::fromatarValorDB($dados['ven_desconto'][$i]);
				$result += $valorTotal;

				$item = new ItensVenda;
				$item->pro_codigo = $pro->pro_codigo;
				$item->itv_embalagem = $pro->pro_embalagem;
				$item->itv_qtde = $dados['ven_quantidade'][$i];
				$item->itv_valorun = $pro->pro_precovenda;
				$item->itv_desc = MonetarioHelper::fromatarValorDB($dados['ven_desconto'][$i]);
				$item->itv_valortotal = $valorTotal;

				$itensVendas->push($item);
			}
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}

		return $result;
	}

	public function insertForVenda(int $ven_codigo, Collection $listItensVenda) : void
	{
		try
		{
			$dados = array();
			foreach($listItensVenda->all() as $i)
			{
				array_push($dados, array(
					"pro_codigo" => $i->pro_codigo,
					"itv_embalagem" => $i->itv_embalagem,
					"itv_qtde" => $i->itv_qtde,
					"itv_valorun" => $i->itv_valorun,
					"itv_desc" => $i->itv_desc,
					"itv_valortotal" => $i->itv_valortotal,
					"ven_codigo" => $ven_codigo,
				));
			}

			DB::table('tb_itensvenda')->insert($dados);
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	public function insert(array $dados) : bool
	{
		try
		{
			$dados['itv_valorun'] = MonetarioHelper::fromatarValorDB($dados['itv_valorun']);
			$dados['itv_valortotal'] = MonetarioHelper::fromatarValorDB($dados['itv_valortotal']);

			ItensVenda::create($dados);
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
			$dados['itv_valorun'] = MonetarioHelper::fromatarValorDB($dados['itv_valorun']);
			$dados['itv_valortotal'] = MonetarioHelper::fromatarValorDB($dados['itv_valortotal']);
			
			$func = ItensVenda::findOrFail($id);
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

	public function delete(int $id, string $campo = 'itv_codigo') : bool
	{
		try
		{
			ItensVenda::where($campo, '=', $id)->delete();
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