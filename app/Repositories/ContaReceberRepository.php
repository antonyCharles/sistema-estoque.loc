<?php

namespace App\Repositories;

use Exception;
use DateTime;
use App\Models\ContaReceber;
use App\Helpers\MonetarioHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use App\Repositories\Repository;
use App\Repositories\Interfaces\ITipoPagtoRepository;
use App\Repositories\Interfaces\IContaReceberRepository;

class ContaReceberRepository extends Repository implements IContaReceberRepository
{
	private $tipoPagtoRepository;

	public function __construct(ITipoPagtoRepository $tipoPagtoRepository)
	{
		$this->tipoPagtoRepository = $tipoPagtoRepository;
	}

	public function getAll() : Collection
	{
		try{
			return ContaReceber::all();
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
	
	public function getId(int $id) : ContaReceber
	{
		try{
			return ContaReceber::find($id);
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
			$dados['cr_valorconta'] = MonetarioHelper::fromatarValorDB($dados['cr_valorconta']);

			ContaReceber::create($dados);
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

	public function insertForNotaFiscalVenda(int $notaFiscal, float $valornf, int $tpgCodigo) : bool
	{
		try
		{
			$tipoPagto = $this->tipoPagtoRepository->getId($tpgCodigo);

			if($tipoPagto == null)
				throw new Exception(trans('msgErros.tpNaoIdentificado',['id' -> $tpgCodigo]));

			$date = new DateTime();

			if($tipoPagto->tpg_qtde == 0)
			{
				$dateVenc = $date->modify("+5 day");
				$this->insertVariaveis($valornf, $notaFiscal, $dateVenc);
			}
			else if($tipoPagto->tpg_qtde > 0)
			{
				for($i = 0; $i < $tipoPagto->tpg_qtde; $i++)
				{
					$dateVenc = $date->modify("+1 months");
					$this->insertVariaveis(($valornf / $tipoPagto->tpg_qtde), $notaFiscal, $dateVenc);
				}
			}
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

	private function insertVariaveis(float $valornf, int $notaFiscal, DateTime $dtVencimento) : void
	{
		try
		{
			$contaReceber = new ContaReceber;
			$contaReceber->cr_valorconta = $valornf;
			$contaReceber->nf_codigo = $notaFiscal;
			$contaReceber->cr_datavencimento = $dtVencimento->format('Y-m-d');
			
			$contaReceber->save();
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

	public function update(int $id,$dados) : bool
	{
		try
		{
			$dados['cr_valorconta'] = MonetarioHelper::fromatarValorDB($dados['cr_valorconta']);

			$func = ContaReceber::findOrFail($id);
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

	public function delete(int $id, string $campo = 'cr_codigo') : bool
	{
		try
		{
			ContaReceber::where($campo, '=', $id)->delete();
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