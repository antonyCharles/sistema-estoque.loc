<?php

namespace App\Repositories;

use DateTime;
use Exception;
use App\Models\ContaPagar;
use App\Helpers\MonetarioHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use App\Repositories\Repository;
use App\Repositories\Interfaces\ITipoPagtoRepository;
use App\Repositories\Interfaces\IContaPagarRepository;

class ContaPagarRepository extends Repository implements IContaPagarRepository
{
	private $tipoPagtoRepository;


	public function __construct(ITipoPagtoRepository $tipoPagtoRepository)
	{
		$this->tipoPagtoRepository = $tipoPagtoRepository;
	}

	public function getAll() : Collection
	{
		try{
			return ContaPagar::all();
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
	
	public function getId(int $id) : ContaPagar
	{
		try{
			return ContaPagar::find($id);
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
			$dados['cp_valorconta'] = MonetarioHelper::fromatarValorDB($dados['cp_valorconta']);

			ContaPagar::create($dados);
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

	public function insertForNotaFiscalCompra(int $notaFiscal, float $valornf, int $tpgCodigo) : bool
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

	private function insertVariaveis(float $valornf, float $notaFiscal, DateTime $dtVencimento) : void
	{
		try
		{
			$contaPagar = new ContaPagar;
			$contaPagar->cp_valorconta = $valornf;
			$contaPagar->nf_codigo = $notaFiscal;
			$contaPagar->cp_datavencimento = $dtVencimento->format('Y-m-d');
			
			$contaPagar->save();
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

	public function update(int $id, array $dados) : bool
	{
		try
		{
			$dados['cp_valorconta'] = MonetarioHelper::fromatarValorDB($dados['cp_valorconta']);

			$func = ContaPagar::findOrFail($id);
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

	public function delete(int $id, string $campo = 'cp_codigo') : bool
	{
		try
		{
			ContaPagar::where($campo, '=', $id)->delete();
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