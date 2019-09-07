<?php

namespace App\Http\Models\User;

use Illuminate\Database\Eloquent\Model;

class RegisterConfirmation extends Model
{

    protected $table = 'register_confirmation';

    protected $fillable = [
        'email', 'hash'
    ];

}
