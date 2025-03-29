<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\ProductController;
use App\Services\ProductService;



Route::get('/', function () {
    return view('welcome', ['name' => 'vidallo1-app']);
});

Route::get('/users', [UserController::class, 'index']);

Route::resource('products', ProductController::class);


// service container
Route::get('/test-container', function (Request $request) {
    $input = $request->input('key');
    return $input;
});
//service provider
Route::get('/test-provider', function (UserService $userService) {
    return $userService->listuser();
    //dd($userService->listusers());

});
//service provider
Route::get('/test-users', [UserController::class, 'index']);

//facades
Route::get('/test-facade', function (UserService $userService) {
    return Response::json($userService->listuser());
    //dd(Response::json($userService->listusers()));
});



// routing -> parameters
Route::get('/post/{post}/comment/{comment}', function (string $postId, string $comment) {
    return "Post ID: " . $postId . "- Comment: " . $comment;
});

Route::get('/post/{id}', function (string $id) {
    return $id;
})->where('id', '[0-9]+');

Route::get('/search/{search}', function (string $search) {
    return $search;
})->where('search', '.*');

//named route or route alias
Route::get('/test/route', function () {
    return route('test-route');
})->name('test-route');


// //middleware
// Route::middleware(['user-middleware'])->group(function (){
//     Route::get('route-middleware-group/first', function(Request $request){
//         echo 'first';
//     });

//     Route::get('route-middleware-group/second', function(Request $request){
//         echo 'second';
//     });
// });


//route -> controller
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::get('/users/first', 'first');
    Route::get('/users/{id}', 'show');
});

//csrf
Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
    return view('token');
});

Route::post('/token', function (Request $request) {
    return $request->all();
});

/*
//controller -> middleware
Route::get('/users', [UserController::class, 'index'])->middleware('user-middleware');

//resource
Route::resource('products', ProductController::class);
*/

//view with data
Route::get('/product-list', function (ProductService $productService) {
    $data['products'] = $productService->listproducts();
    return view('products.list', $data);
});