<?php
use Illuminate\Support\Facades\Route;

Route::get('routes', function () {
    $routes = Route::getRoutes();

    
    return view("routes_tabel")->with("routes",$routes);
});
