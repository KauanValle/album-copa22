<?php


namespace App\Http\Service;


use App\Http\Repository\UserRepository;
use App\Http\Resource\BadRequestResource;
use App\Http\Resource\UserResource;
use App\Model\ErrorModel;
use App\Model\User;
use http\Env\Request;
use http\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserService
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new UserRepository();
    }

    public function getUserByEmail($email)
    {
        return $this->repo->getUserByEmail($email);
    }

    public function getAllUser()
    {
        return $this->repo->getAllUser();
    }

    public function salvarUsuario($request)
    {
        $usuario = $this->getUserByEmail($request['email']);

        if($usuario){
            $error = new ErrorModel();
            $error->message = 'Email já existe!';

            return $error;
        }else{
            $usuarioModel = new User();
            $usuarioModel->fill($request);
            $usuarioModel->save();

            return $usuarioModel;
        }


    }
}
