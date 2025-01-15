<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


$movies = [];

for ($i = 0; $i < 10; $i++) {
    $movies[] = [
        'title' => 'Movie ' . $i,
        'release_date' => now()->subDays($i),
        'genre' => 'Action'
    ];
}

Route::group(
    [
        'middleware' => ['isAuth'],
        'prefix' => 'movie',
        'as' => 'movie.'
    ],
    function () use ($movies) {

        Route::get('/', function () use ($movies) {
            return $movies;
        });


        Route::get('/{id}', function ($id) use ($movies) {
            return $movies[$id];
        })->middleware(['isMembership']);



        Route::post('/', function () use ($movies) {

            $movies[] = [
                'title' => request('title'),
                'genre' => request('genre'),
                'release_date' => request('release_date')
            ];

            return $movies;
        });

        Route::put('/{id}', function ($id) use ($movies) {

            $movies[$id]['title'] = request('title');
            $movies[$id]['genre'] = request('genre');

            return $movies;
        });


        Route::delete('/{id}', function ($id) use ($movies) {
            unset($movies[$id]);

            return $movies;
        });

        Route::get('/pricing', function () {
            return 'Tolong Bayar';
        });

        Route::get('/login', function () {
            return 'Login';
        })->name('login-page');
    }
);
