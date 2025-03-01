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




//Routing->Parameter

Route::get('/post/{post}/comment/{comment}',function (string $postId, string $comment){
    return "Post ID:" . $postId . "- Comment: ". $comment;
});


Route::get('/post/{id}', function (string $id) {
    return $id;
})->where('id', '[0-9]+');


Route::get('/search/{search}', function (string $search) {
    return $search;
})->where('search', '.*');


//Name Rout or Route Allias

Route::get('/test/route', function (){
    return route ('test-route');
})-> name ('test-route');


//Route-> Middleware Group

Route::middleware(['user-middleware'])->group (function (){
    
Route::get ('route-middleware-group/first', function (Request $request){
    echo'first';
});

Route::get ('route-middleware-group/second', function (Request $request){
    echo'second';
});
});



//Route-> Controller

Route::controller( UserController::class)->group (function (){
    Route::get('/users', 'index');
    Route::get('/users/first', 'first');
    Route::get('/users/{id}', 'show');
    });


    Route::get('/token', function(Request $request) {
        return view('token');
    });
    
    Route::post('/token', function(Request $request) {
        return $request->all();
    });
    