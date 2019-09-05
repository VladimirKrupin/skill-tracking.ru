<?php

namespace App\Http\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Build the message.
     *
     * @return $this
     */
    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        return $this->view('emails.user.forgot-password')
            ->subject(__('forgot.forgot-subject'));
    }
}
