<?php

namespace App\Repositories;

use Exception;
use App\Models\Compra;
use App\Models\ItensCompra;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use App\Repositories\Repository;
use App\Repositories\Interfaces\ICompraRepository;
use App\Repositories\Interfaces\IProdutoRepository;
use App\Repositories\Interfaces\IItensCompraRepository;
use App\Repositories\Interfaces\IContaPagarRepository;
use App\Repositories\Interfaces\INotaFiscalRepository;

class CompraRepository extends Repository implements ICompraRepository
{
	private $produtoRepository;
	private $itensCompraRepository;
	private $contaPagarRepository;
	private $notaFiscalRepository;

	public function __construct(
		IProdutoRepository $produtoRepository,
		IItensCompraRepository $itensCompraRepository,
		IContaPagarRepository $contaPagarRepository,
		INotaFiscalRepository $notaFiscalRepository
	)
    {
		$this->produtoRepository = $produtoRepository;
		$this->itensCompraRepository = $itensCompraRepository;
		$this->contaPagarRepository = $contaPagarRepository;
		$this->notaFiscalRepository = $notaFiscalRepository;
	}

	public function getAll() : Collection
	{
		try{
			return Compra::with('tipopagto','fornecedor')->get();
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
	
	public function getId(int $id) : Compra
	{
		try{
			return Compra::with('itenscompras','notafiscal')->find($id);
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

	public function createCompraCompleta(array $dados) : int
	{
		try
		{
			$itensCompras = collect();
			$dados['com_valortotal'] = $this->itensCompraRepository->createListItensCompraforCompra($dados,$itensCompras);

			if(isset($dados['com_criar_notafiscal']) && $dados['com_criar_notafiscal'] == 'S')
			{
				$dados['nf_codigo'] = $this->notaFiscalRepository->insertForCompra($dados['com_valortotal'], 0, 0, $dados['tpg_codigo']);
			}

			$compra = $this->insert($dados);

			$this->itensCompraRepository->insertForCompra($compra->com_codigo,$itensCompras);

			$this->produtoRepository->addQuantidadeList($itensCompras);
		}
		catch(Exception $e)
		{
			if(isset($compra) && $compra->com_codigo != null)
			{
				$this->itensCompraRepository->delete($compra->com_codigo,'com_codigo');
				$this->delete($compra->com_codigo,'com_codigo');
			}

			if($dados['com_criar_notafiscal'] == 'S' && $dados['nf_codigo'] != null)
			{
				$this->contaPagarRepository->delete($dados['nf_codigo'],'nf_codigo');
				$this->notaFiscalRepository->delete($dados['nf_codigo']);
			}

			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
		
		return $compra->com_codigo;
	}

	private function insert(array $dados) : Compra
	{
		try
		{
			$compra = Compra::create($dados);
		}
		catch(QueryException $e)
		{
			throw new Exception(trans('msgErros.QueryInsert',['message' =>  $e->getMessage()]));
		}
		catch(Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
		
		return $compra;
	}

	public function update(int $id, array $dados) : bool
	{
		try
		{
			$compra = Compra::findOrFail($id);
			$compra->update($dados);
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

	public function delete(int $id, string $campo = 'com_codigo') : bool
	{
		try
		{
			Compra::where($campo, '=', $id)->delete();
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