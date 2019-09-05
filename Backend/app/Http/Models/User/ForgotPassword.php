<?php

namespace App\Http\Models\User;

use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{

    protected $table = 'forgot_password';

    protected $fillable = [
        'email', 'hash', 'attempts                                                                                '
    ];

}
