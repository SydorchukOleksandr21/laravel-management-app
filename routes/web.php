<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GuestController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name("main");

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Route::resource("auth", AuthController::class);
//
//
//Route::get("signin", fn() => to_route("auth.create"));
//Route::get("signout", fn() => to_route("auth.delete"));

Route::prefix('auth')
    ->name('auth.')
    ->controller(AuthController::class)
    ->group(function () {
        Route::get('login', 'login')->name('login');
        Route::get('signup', 'signup')->name('signup');

        Route::post('login', 'loginUser')->name('loginUser');
        Route::post('signup', 'createUser')->name('createUser');

        Route::delete('logout', 'logout')->name('logout')->middleware(AuthMiddleware::class);
    });

Route::resource('booking', BookingController::class);
Route::resource('guest', GuestController::class);
