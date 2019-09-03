<?php

namespace App\Http\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationSuccess extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Build the message.
     *
     * @return $this
     */
    public $login;
    public $password;

    public function __construct($login,$password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function build()
    {
        return $this->view('emails.registration-success')
            ->subject(__('register.register_success'));
    }
}
