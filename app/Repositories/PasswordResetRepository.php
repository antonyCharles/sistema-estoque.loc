<?php

namespace App\Repositories;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Repositories\Interfaces\IPasswordResetRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PasswordResetRepository implements IPasswordResetRepository
{
    public function getPasswordResetsByToken(string $token) : PasswordReset
	{
		try
		{
			$result = PasswordReset::where('token',$token)->first();
		}
		catch(Exception $e)
		{
			throw new Exception(trans('excPasswordReset.selectPasswordReset'));
		}

		return $result;
	}

    public function insertPasswordReset(string $email) : PasswordReset
    {
        try
		{
			$result = PasswordReset::create([
                        'email' => $email,
                        'token' => Str::random(60),
                        'created_at' => Carbon::now()
                    ]);
		}
		catch(Exception $e)
		{
			throw new Exception(trans('excPasswordReset.registerPasswordReset'));
		}

		return $result;
    }

	public function removePasswordReset($value, $column = 'email') : bool
	{
		try
		{
			PasswordReset::where($column,'=',$value)->delete();
		}
		catch(Exception $e)
		{
			return false;
		}

		return true;
	}
}