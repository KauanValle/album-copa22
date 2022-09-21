<?php


namespace App\Http\Repository;


use App\Model\User;

class UserRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function getAllUser()
    {
        return $this->model::all();
    }

    public function getUserByEmail($email)
    {
        return $this->model->newQuery()
            ->where('email', $email)
            ->first();
    }
}
