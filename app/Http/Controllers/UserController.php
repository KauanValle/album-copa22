<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
    }

    public function decode(Request $request)
    {

    }
}
