<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;


// Test Container
Route::get('/test-container', function (Request $request) {
    $input = $request->input('key');
    return $input;
});

// Test Service Provider
Route::get('/test-provider', function (UserService $userService) {
    dd($userService->listUser());
});

// Test User Controller
Route::get('/test-user', [UserController::class, 'index']);

// Test Facade
Route::get('/test-facade', function (UserService $userService) {
    return Response::json($userService->listUser()); // ✅ Fixed Response usage
});

// Route with Parameters
Route::get('/post/{post}/comment/{comment}', function (string $post, string $comment) { // ✅ Fixed postId to post
    return "Post ID: " . $post . " - Comment: " . $comment;
});

// Route with Regex Constraint
Route::get('/post/{id}', function (string $id) {
    return $id;
})->where('id', '[0-9]+');

Route::get('/search/{search}', function (string $search) {
    return $search;
})->where('search', '.*');

// Named Route (Alias)
Route::get('/test/route', function () {
    return route('test-route');
})->name('test-route');

// Middleware Group
Route::middleware(['user-middleware'])->group(function () {
    Route::get('route-middleware-group/first', function () {
        echo 'first';
    });

    Route::get('route-middleware-group/second', function () {
        echo 'second';
    });
});

// Controller Group Routes
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::get('/users/first', 'first');
    Route::get('/users/{id}', 'show');
});

// Token View & Form Submission
Route::get('/token', function () {
    return view('token');
});

Route::post('/token', function (Request $request) {
    return $request->all();
});

// Middleware in Controller
Route::get('/user', [UserController::class, 'index'])->middleware('user-middleware');

///Resource
Route::resource('products', ProductController::class);

//View with data
Route::get('/product-list', function (ProductService $productService) {
    $data['products'] = $productService->listProducts();
    return view('product.list', $data);
});