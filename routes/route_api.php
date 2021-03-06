<?php
use Illuminate\Support\Facades\Route;

Route::get('routes', function () {
    $routes = Route::getRoutes();

    
    return view("routes_tabel")->with("routes",$routes);
});

Route::post('user/login', [App\Http\Controllers\UserController::class,'login']);
Route::post('user/me', [App\Http\Controllers\UserController::class,'me'])->middleware(['auth:sanctum']);

Route::post('tutor-sub/storeArray', [App\Http\Controllers\TutorSubController::class,'storeArray']);

Route::post('user/search', [App\Http\Controllers\UserController::class,'search']);
Route::get('tutor/getTutorByUser/{user}', [App\Http\Controllers\TutorController::class,'getTutorByUser']);
Route::post('review/getRating', [App\Http\Controllers\ReviewController::class,'getRating']);
