<?php

namespace App\Http\Controllers;

use App\Http\Resource\BadRequestResource;
use App\Http\Resource\UserResource;
use App\Http\Service\UserService;
use App\Model\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class UserController extends Controller
{
    public $service;
    public $userResource;
    public $errorResource;

    public function __construct()
    {
        $this->service = new UserService();
        $this->userResource = new UserResource();
        $this->errorResource = new BadRequestResource();
    }

    public function create(Request $request)
    {
        $args = $request->only(['name', 'email', 'password']);

        $args['password'] = bcrypt($request->password);
        $usuario = $this->service->salvarUsuario($args);

        if($usuario['message']){
            $code = 400;
            $attr = $this->errorResource;
        }else{
            $code = 201;
            $attr = $this->userResource;
        }

        return response()->json($attr->toResource($usuario, $code));
    }

    public function getAllUsers()
    {
        return response()->json($this->userResource->toResource($this->service->getAllUser(), 200));
    }
}
