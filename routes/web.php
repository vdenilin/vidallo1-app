<?php
use App\Http\Controllers\UserController;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/test-container', function (Request $request ){
    $input=$request->input ('key');
    return $input;
});



Route::get('/test-provider', function (UserService $userService ){
    dd ($userService->listUser());
});


Route::get('/test-user', [UserController::class,'index' ]);


Route::get('/test-facade', function (UserService $userService ){
    dd(Response::json($userService->listUser()));
});