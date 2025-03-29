<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserService $userService)
    {
        // ($userService->listUsers()); 
        return view('user.index', ['users' => $userService->listUser()]);
    }

    public function first(UserService $userService)
    {
        return collect($userService->listUser())->first();
    }

    public function show(UserService $userService, $id)
    {
        $user = collect($userService->listUser())->filter(function ($item) use ($id) {
            return $item['id'] == $id;
        })->first();

        return $user;

    }
}