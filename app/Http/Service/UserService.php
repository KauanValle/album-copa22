<?php


namespace App\Http\Service;


use App\Http\Repository\UserRepository;

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
}
