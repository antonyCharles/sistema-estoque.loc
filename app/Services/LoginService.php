<?php

namespace App\Services;

use Auth;
use Exception;
use DateTime;
use App\Services\Service;
use App\Models\RoleProfile;
use Illuminate\Support\Facades\Cache;


class LoginService extends Service
{

	public function credentialsValidate(string $email, string $password)
	{
		try
		{
			$credentials = [
				'email' => trim($email),
				'password'=> trim($email) . trim($password),
				'status' => 'A'
			];

			return Auth::attempt($credentials);
		}
		catch(Exception $e)
		{
			return false;
		}

		return false;
	}
}