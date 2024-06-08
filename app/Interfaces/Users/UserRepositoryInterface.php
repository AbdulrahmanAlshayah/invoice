<?php

namespace App\Interfaces\Users;

interface UserRepositoryInterface
{
    // get User
    public function profile();

    // update User
    public function updateProfile($request);

    // show Users
    public function showUsers();

    // update user data
    public function updateUser($request);
}
