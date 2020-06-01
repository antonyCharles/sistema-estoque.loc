<?php

namespace App\Repositories;

use Exception;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use App\Repositories\Repository;
use App\Repositories\Interfaces\IItensVendaRepository;
use App\Repositories\Interfaces\INotaFiscalRepository;
use App\Repositories\Interfaces\IContaReceberRepository;
use App\Repositories\Interfaces\IProdutoRepository;
use App\Repositories\Interfaces\IVendaRepository;

class VendaRepository extends Repository implements IVendaRepository
{
	private $itensVendaRepository;
	private $notaFiscalRepository;
	private $contaReceberRepository;
	private $produtoRepository;


	public function __construct(
		IItensVendaRepository $itensVendaRepository,
		INotaFiscalRepository $notaFiscalRepository,
		IContaReceberRepository $contaReceberRepository,
		IProdutoRepository $produtoRepository
	)
	{
		$this->itensVendaRepository = $itensVendaRepository;
		$this->notaFiscalRepository = $notaFiscalRepository;
		$this->contaReceberRepository = $contaReceberRepository;
		$this->produtoRepository = $produtoRepository;
	}

	public function getAll() : Collection
	{
		try{
			return Venda::all();
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
	
	public function getId(int $id) : Venda
	{
		try{
			return Venda::with('itensvendas','notafiscal','funcionario')->find($id);
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

	public function createVendaCompleta(array $dados) : int
	{
		try
		{
			$itensVendas = collect();
			$dados['ven_valortotal'] = $this->itensVendaRepository->createListItensVendaforVenda($dados,$itensVendas);

			if($dados['ven_criar_notafiscal'] == 'S')
			{
				$dados['nf_codigo'] = $this->notaFiscalRepository->insertForVenda($dados['ven_valortotal'], 0, 0, $dados['tpg_codigo']);
			}
			$venda = $this->insert($dados);

			$this->itensVendaRepository->insertForVenda($venda->ven_codigo,$itensVendas);
			$this->produtoRepository->removeQuantidadeList($itensVendas);
		}
		catch(Exception $e)
		{
			if(isset($venda) && $venda->ven_codigo != null)
			{
				$this->itensVendaRepository->delete($venda->ven_codigo,'ven_codigo');
				$this->delete($venda->ven_codigo,'ven_codigo');
			}

			if($dados['ven_criar_notafiscal'] == 'S' && $dados['nf_codigo'] != null)
			{
				$this->contaReceberRepository->delete($dados['nf_codigo'],'nf_codigo');
				$this->notaFiscalRepository->delete($dados['nf_codigo']);
			}

			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
		
		return $venda->ven_codigo;
	}

	private function insert(array $dados) : Venda
	{
		try
		{
			$venda = Venda::create($dados);
		}
		catch(QueryException $e)
		{
			throw new Exception(trans('msgErros.QueryInsert',['message' =>  $e->getMessage()]));
		}
		catch(Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
		
		return $venda;
	}

	public function update(int $id, array $dados) : bool
	{
		try
		{
			$venda = Venda::findOrFail($id);
			$venda->update($dados);
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

	public function delete(int $id, string $campo = 'ven_codigo') : bool
	{
		try
		{
			Venda::where($campo, '=', $id)->delete();
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