<?php

namespace App\Http\Middleware;

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(
    [
        'middleware' => ['isAuth'],
        'prefix' => 'movie',
        'as' => 'movie.'
    ],
    function () {

        Route::get('/', [MovieController::class, 'index']);


        Route::get('/{id}', [MovieController::class, 'show']);

        Route::post('/', [MovieController::class, 'store']);


        Route::put('/{id}',[MovieController::class, 'update']);

        Route::delete('/{id}',[MovieController::class, 'destroy'] );
    });
