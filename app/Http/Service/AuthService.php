<?php


namespace App\Http\Service;


use App\Http\Repository\AuthRepository;
use App\Model\AuthModel;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class AuthService
{
    public $repo;
    public function __construct()
    {
        $this->repo = new AuthRepository();
    }

    public function logarNaApi($credenciais)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $userService = new UserService();
        $id = $userService->getUserByEmail($credenciais['email'])['id'];
        $getToken = $this->repo->getTokenByUserId($id);

        if($getToken)
        {
            $expirationTime = $this->getExpirationTime($getToken['jwt_token']);
            if($expirationTime > date('Y-m-d H:i:s'))
            {
                $token = $getToken['jwt_token'];
            }else{
                $token = $this->logar($credenciais);

                if(!$token)
                {
                    return response()->json(['error' => 'Unauthorized'], 401);
                }

                $this->salvarAcesso($token, $id);
            }
        }else
        {
            $token = $this->logar($credenciais);
            if(!$token)
            {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $this->salvarAcesso($token, $id);
        }

        return $token;
    }

    public function logar($credenciais)
    {
        return auth('api')->attempt($credenciais);
    }

    public function salvarAcesso($token, $id)
    {
        $model = new AuthModel();
        $model->id_usuario = $id;
        $model->jwt_token = $token;
        $model->data_expiracao = $this->getExpirationTime($token);

        $model->save();
    }

    public function getExpirationTime($tokenJwt)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $token = new Token($tokenJwt);

        $payload = JWTAuth::decode($token);
        return date('Y-m-d H:i:s', $payload->get('exp'));
    }
}
