<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use App\Repositories\Repository;
use App\Helpers\MonetarioHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use App\Repositories\Interfaces\IFuncionarioRepository;

class FuncionarioRepository extends Repository implements IFuncionarioRepository
{
	public function getAll() : Collection
	{
		try{
			return User::all();
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
	
	public function getId(int $id) : User
	{
		try{
			return User::find($id);
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

	public function GetFuncionarioAllSelect() : Collection
	{
		try{
			return User::pluck('name','fun_codigo');
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

	public function getUserByEmail(string $email) : User
	{
		try
		{
			$user = User::where('email',$email)->first();

			if($user == null)
				throw new Exception("Valor nulo!");

		}
		catch(Exception $e)
		{
			throw new Exception("Nenhum usuário encontrado para o email informado!");
		}

		return $user;
	}

	public function insert(array $dados) : bool
	{
		try
		{
			$dados['fun_salario'] = MonetarioHelper::fromatarValorDB($dados['fun_salario']);
			$dados['password'] = $this->createPassword($dados['email'], $dados['password']);
			$dados['created_at'] = date("Y-m-d H:i:s");
			User::create($dados);
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
			$func = User::findOrFail($id);
			$dados['fun_salario'] = MonetarioHelper::fromatarValorDB($dados['fun_salario']);

			if(in_array('password',$dados))
			{
				throw new Exception("Não é permitido alterar senha por este metodo!");
			}

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

	public function updateUserPassword(string $email, string $password) : bool
    {
        try
        {
            $user =  User::where('email', $email)->first();
            
            if(!$user)
                throw new Exception(trans('excPasswordReset.emailNotUser'));

            $user->password = $this->createPassword($email, $password);
            $user->update();
        }
        catch(Exception $e)
        {
            throw new Exception(trans('exceptions.queryUpdate', ['message' => $e->getMessage()]));
        }

        return true;
    }

	public function delete(int $id, string $campo = 'fun_codigo') : bool
	{
		try
		{
			User::where($campo, '=', $id)->delete();
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

	private function createPassword(string $email, string $password)
    {
        return bcrypt(trim($email) . trim($password));
    }
}