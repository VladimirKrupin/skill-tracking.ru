<?php

namespace App\Http\Models\User;

use Illuminate\Database\Eloquent\Model;

class ChangePassword extends Model
{

    protected $table = 'change_password';

    protected $fillable = [
        'user_id'
    ];

}
