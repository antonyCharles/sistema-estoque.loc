<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Repositories\Interfaces\IPasswordResetRepository;
use App\Repositories\Interfaces\IFuncionarioRepository;

class ResetPasswordController extends Controller
{
    private $repository;
    private $userRepository;

    public function __construct(
        IPasswordResetRepository $repository,
        IFuncionarioRepository $userRepository
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function resetPassword(string $token)
    {
        try
        {
            $passwordReset = $this->requestPasswordReset($token);
        }
        catch(Exception $e)
        {
            return redirect()->to('login')->withErrors($e->getMessage());
        }

        return View('auth.resetPassword')->with('token',$token);
    }

    public function resetPasswordPost(Request $request, string $token)
    {
        try
        {
            $request->validate([
                'password' => 'required',
                'passwordCheck' => 'required|same:password',
            ]);

            $passwordReset = $this->requestPasswordReset($token);

            $result = $this->userRepository->updateUserPassword($passwordReset->email, $request->password);

            if($result)
                $this->requestRemovePasswordReset($passwordReset->email);

            return redirect()->to('login')->with(['msg-redirect-sucesso' => trans('message.successResetPassword')]);
        }
        catch(Exception $e)
        {
            $msg = $e->getMessage();
        }

        return redirect()->action('Auth\ResetPasswordController@resetPasswordPost',$token)->withInput()->withErrors($msg);
    }

    private function requestPasswordReset(string $token)
    {
        $passwordReset = $this->repository->getPasswordResetsByToken($token);

        if(!$passwordReset)
            throw new Exception(trans('excPasswordReset.tokenInvalid'));

        return $passwordReset;
    }

    private function requestRemovePasswordReset(string $email)
    {
        try
        {
            $result = $this->repository->removePasswordReset($email);
        }
        catch(Exception $e)
        {
            
        }
    }
}
