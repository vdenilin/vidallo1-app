<?php
namespace App\Services;

class UserService
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }


    public function listUser()
    {
        return $this->user;
    }
}

