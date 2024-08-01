<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private readonly UserServices $userServices
    )
    {
    }

    public function createUser(Request $request)
    {
        return $this->userServices->store($request);
    }

    public function listUsers()
    {
        return $this->userServices->index();
    }

    public function login(Request $request)
    {
        return $this->userServices->login($request);
    }

    public function logout()
    {
        return $this->userServices->logout();
    }

    public function updateUser(Request $request, $user)
    {
        return $this->userServices->updateUser($request, $user);
    }

    public function deleteUser($user)
    {
        return $this->userServices->deleteUser($user);
    }
}
