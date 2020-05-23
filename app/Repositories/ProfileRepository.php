<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Repositories\Interfaces\IProfileRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProfileRepository implements IProfileRepository
{

    public function getProfilesAll() : Collection
	{
        try
        {
            $profiles = Profile::all();
        }
        catch(Exception $e)
        {
            throw new Exception(trans('exceptions.querySelect', ['message' => $e->getMessage()]));
		}
		
		return $profiles;
	}
	
	public function getProfilesAllByActive() : Collection
	{
        try
        {
            $profiles =  Profile::where('status','A')->orderBy('name')->get();
        }
        catch(Exception $e)
        {
            throw new Exception(trans('exceptions.querySelect', ['message' => $e->getMessage()]));
		}
		
		return $profiles;
	}
	
	public function GetProfilesAllSelect() : Collection
	{
		try
		{
			$profiles =  Profile::where('status','A')->orderBy('name')->pluck('name','profile_id');
		}
		catch(\Exception $e)
		{
			throw new Exception(trans('msgErros.querySelect',['message' =>  $e->getMessage()]));
		}

		return $profiles;
	}

	public function getProfileById(int $id) : Profile
	{
		try
		{
			$profile = Profile::with('rolesprofile')->find($id);
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.querySelect', ['message' => $e->getMessage()]));
		}

		return $profile;
	}

	public function insertProfile(array $dados) : bool
	{
		try
		{
			$dados['created_at'] = date("Y-m-d H:i:s");
			
			Profile::create($dados);
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.queryInsert', ['message' => $e->getMessage()]));
		}

		return true;
	}

	public function updateProfile(int $id, array $dados) : bool
	{
		try
		{
			$dados['updated_at'] = date("Y-m-d H:i:s");
			$profile = Profile::find($id);
			$profile->update($dados);
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.queryUpdate', ['message' => $e->getMessage()]));
		}

		return true;
	}

	public function deleteProfile(int $id, string $field = 'profile_id') : bool
	{
		try
		{
			Profile::where($field, '=', $id)->delete();
		}
		catch(QueryException $e)
		{
			if("23000" == $e->getCode())
				throw new Exception(trans('exceptions.queryDeleteForeachKey'));
				
			throw new Exception($e->getMessage());
		}
		catch(Exception $e)
		{
			throw new Exception(trans('exceptions.queryDelete', ['message' => $e->getMessage()]));
		}

		return true;
	}
}