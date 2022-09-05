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

    public function getUserByEmail($email)
    {
        return $this->model->newQuery()
            ->where('email', $email)
            ->first();
    }
}
