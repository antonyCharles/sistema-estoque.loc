<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $obj;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('charles_aclr@yahoo.com.br', trans('mail.recoverPassword'))
            ->subject(trans('mail.recoverPasswordSubject'))
            ->view('mails.forgotPasswordMail');
    }
    
}
