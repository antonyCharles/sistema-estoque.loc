<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Services\SendPasswordResetService;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {
        return View('auth.forgotPassword');
    }

    public function forgotPasswordPost(Request $request)
    {
        try
        {
            $request->validate(['email' => 'required|email']);
            
            $servicePasswordReset = new SendPasswordResetService($request->email);
    
            if($servicePasswordReset->execute())
                return redirect()->to('login')->with(['msg-redirect-sucesso' => trans('message.successSendResetPassword')]);
            else
                throw new Exception(trans('excPasswordReset.notPasswordReset'));

        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('Auth\ForgotPasswordController@forgotPasswordPost')->withInput()->withErrors($msg);
    }
}
