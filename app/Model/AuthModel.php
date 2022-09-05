<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AuthModel extends Model
{
    protected $table = 'user_access';

    protected $fillable = [
        'id_usuario',
        'jwt_token',
        'data_expiracao'
    ];
}
