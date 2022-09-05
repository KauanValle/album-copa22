<?php


namespace App\Http\Repository;


use App\Model\AuthModel;
use Illuminate\Cache\Repository;

class AuthRepository
{
    public $model;

    public function __construct()
    {
        $this->model = new AuthModel();
    }

    public function getTokenByUserId($id)
    {
        return $this->model->newQuery()
            ->where('id_usuario', $id)
            ->orderBy('created_at', 'desc')
            ->first();
    }

}
