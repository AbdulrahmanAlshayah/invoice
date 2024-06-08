<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Interfaces\Users\UserRepositoryInterface;
use App\Models\User;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use UploadTrait;

    private $Users;

    public function __construct(UserRepositoryInterface $Users)
    {
        $this->Users = $Users;
    }
    public function profile()
    {
        return $this->Users->profile();
    }

    public function updateProfile(Request $request)
    {
        return $this->Users->updateProfile($request);
    }

    public function showUsers()
    {
        return $this->Users->showUsers();
    }
    public function updateUser(Request $request)
    {
        return $this->Users->updateUser($request);
    }
}
