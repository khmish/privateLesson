<?php
use Illuminate\Support\Facades\Route;

Route::get('routes', function () {
    $routes = Route::getRoutes();

    
    return view("routes_tabel")->with("routes",$routes);
});

Route::post('user/login', [App\Http\Controllers\UserController::class,'login']);
Route::post('user/me', [App\Http\Controllers\UserController::class,'me'])->middleware(['auth:sanctum']);


Route::post('user/search', [App\Http\Controllers\UserController::class,'search']);
Route::get('user/avarageUser', [App\Http\Controllers\UserController::class,'avarageUser']);
