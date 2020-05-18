<?php

namespace App\Repositories;

use Exception;
use App\Models\NotaFiscal;
use App\Helpers\MonetarioHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use App\Repositories\Repository;
use App\Repositories\Interfaces\IContaPagarRepository;
use App\Repositories\Interfaces\IContaReceberRepository;
use App\Repositories\Interfaces\INotaFiscalRepository;

class NotaFiscalRepository extends Repository implements INotaFiscalRepository
{
	private $contaPagarRepository;
	private $contaReceberRepository;

	public function __construct(
		IContaPagarRepository $contaPagarRepository,
		IContaReceberRepository $contaReceberRepository
	)
	{
		$this->contaPagarRepository = $contaPagarRepository;
		$this->contaReceberRepository = $contaReceberRepository;
	}

	public function getAll() : Collection
	{
		try{
			return NotaFiscal::all();
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
	
	public function getId(int $id) : NotaFiscal
	{
		try{
			return NotaFiscal::with(['contasReceber','contasPagar'])->find($id);
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

	public function GetNotaFiscalAllSelect() : Collection
	{
		try{
			return NotaFiscal::pluck('nf_codigo','nf_codigo');
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
			$dados['nf_valornf'] = MonetarioHelper::fromatarValorDB($dados['nf_valornf']);
			$dados['nf_taxaimpostonf'] = MonetarioHelper::fromatarValorDB($dados['nf_taxaimpostonf']);
			$dados['nf_valorimposto'] = $this->getCalcularValorImposto($dados['nf_valornf'],$dados['nf_taxaimpostonf']);

			NotaFiscal::create($dados);
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

	public function insertForCompra(float $valornf, float $taxaimpostonf, float $valorimposto, int $tpgCodigo) : int
	{
		$notaFiscal = new NotaFiscal;
		
		try
		{
			$notaFiscal->nf_valornf = MonetarioHelper::fromatarValorDB($valornf);
			$notaFiscal->nf_taxaimpostonf = MonetarioHelper::fromatarValorDB($taxaimpostonf);
			$notaFiscal->nf_valorimposto = $this->getCalcularValorImposto($valornf,$valorimposto);
			$notaFiscal->save();

			$this->contaPagarRepository->insertForNotaFiscalCompra($notaFiscal->nf_codigo, $valornf, $tpgCodigo);

			return $notaFiscal->nf_codigo;
		}
		catch(QueryException $e)
		{
			throw new Exception(trans('msgErros.QueryInsert',['message' =>  $e->getMessage()]));
		}
		catch(Exception $e)
		{
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
	}

	public function insertForVenda(float $valornf, float $taxaimpostonf, float $valorimposto, int $tpgCodigo) : int
	{
		$notaFiscal = new NotaFiscal;
		
		try
		{
			$notaFiscal->nf_valornf = MonetarioHelper::fromatarValorDB($valornf);
			$notaFiscal->nf_taxaimpostonf = MonetarioHelper::fromatarValorDB($taxaimpostonf);
			$notaFiscal->nf_valorimposto = $this->getCalcularValorImposto($valornf,$valorimposto);
			$notaFiscal->save();

			$this->contaReceberRepository->insertForNotaFiscalVenda($notaFiscal->nf_codigo, $valornf, $tpgCodigo);

			return $notaFiscal->nf_codigo;
		}
		catch(QueryException $e)
		{
			if($notaFiscal->nf_codigo != null)
				$this->delete($notaFiscal->nf_codigo);

			throw new Exception(trans('msgErros.QueryInsert',['message' =>  $e->getMessage()]));
		}
		catch(Exception $e)
		{
			if($notaFiscal->nf_codigo != null)
				$this->delete($notaFiscal->nf_codigo);
				
			throw new Exception(trans('msgErros.Generico',['message' =>  $e->getMessage()]));
		}
	}

	public function update(int $id, array $dados) : bool
	{
		try
		{
			$dados['nf_valornf'] = MonetarioHelper::fromatarValorDB($dados['nf_valornf']);
			$dados['nf_taxaimpostonf'] = MonetarioHelper::fromatarValorDB($dados['nf_taxaimpostonf']);
			$dados['nf_valorimposto'] = $this->getCalcularValorImposto($dados['nf_valornf'],$dados['nf_taxaimpostonf']);

			$func = NotaFiscal::findOrFail($id);
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

	public function delete(int $id, string $campo = 'nf_codigo') : bool
	{
		try
		{
			NotaFiscal::where($campo, '=', $id)->delete();
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

	private function getCalcularValorImposto(float $valorNf, float $taxaImposto) : float
	{
		return ($valorNf * $taxaImposto) / 100;
	}
}