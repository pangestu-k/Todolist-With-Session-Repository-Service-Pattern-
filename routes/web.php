<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Route;




Route::get('/', [HomeController::class, 'index']);

Route::view('/template','template');

Route::controller(\App\Http\Controllers\UserController::class)->group(function(){
    Route::get('login', 'login')->middleware(OnlyGuestMiddleware::class);
    Route::post('login', 'doLogin')->middleware(OnlyGuestMiddleware::class);
    Route::post('logout', 'doLogout')->middleware(OnlyMemberMiddleware::class);
});

Route::controller(\App\Http\Controllers\TodolistController::class)
->middleware(OnlyMemberMiddleware::class)->group(function(){
    Route::get('todolist', 'getAllData');
    Route::post('todolist', 'saveData');
    Route::post('todolist/{id}/delete', 'removeData');
});
