<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct(LoginService $serv)
    {
        $this->service = $serv;
        $this->data = [];
    }

    public function login()
    {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function loginPost(LoginRequest $request)
    {
        $sLogin = new LoginService();

        if($sLogin->credentialsValidate($request->email, $request->password))
		{
			return redirect()->route('dashboard');
		}
		else
		{
			return redirect()->back()->withErrors(trans('excLogin.incEmailPassword'));
		}
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
