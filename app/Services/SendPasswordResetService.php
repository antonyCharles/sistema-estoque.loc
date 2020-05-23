<?php

namespace App\Services;

use Exception;
use App\Services\Service;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordResetMail;
use App\Repositories\Interfaces\IPasswordResetRepository;
use App\Repositories\Interfaces\IFuncionarioRepository;

class SendPasswordResetService extends Service
{
    private $email;
    private $token;
    private $passwordResetRepository;
    private $funcionarioRepository;

    public function __construct(
        string $email, 
        IPasswordResetRepository $passwordResetRepository,
        IFuncionarioRepository $funcionarioRepository
    )
    {
        $this->email = $email;
        $this->passwordResetRepository = $passwordResetRepository;
        $this->funcionarioRepository = $funcionarioRepository;
        
    }

    public function execute()
    {
        try
        {
            if($this->requestValidateUserEmail()){
                $this->requestPasswordReset();
                $this->sendEmailPasswordReset();
            }
        }
        catch(Exception $e)
        {
            if($this->token != null){
                $result = $this->passwordResetRepository->removePasswordReset($this->email);
            }

            throw new Exception($e->getMessage());
        }

        return true;
    }

    private function sendEmailPasswordReset()
    {
        try
        {
            $obj = array("link" => action('Auth\ResetPasswordController@resetPassword',['token' => $this->token]));
            
            Mail::to($this->email)->send(new ForgotPasswordResetMail($obj));
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }

    private function requestValidateUserEmail()
    {
        $user = $this->funcionarioRepository->getUserByEmail($this->email);

        if(!$user)
            throw new Exception(trans('excPasswordReset.emailNotUser'));

        return true;
    }

    private function requestPasswordReset()
    {
        $result = $this->passwordResetRepository->insertPasswordReset($this->email);

        if(!$result)
            throw new Exception(trans('excPasswordReset.notPasswordReset'));

        $this->token = $result->token;
    }
}