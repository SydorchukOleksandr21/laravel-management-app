<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RoomSampleController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name("main");

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Route::resource("Auth", AuthController::class);
//
//
//Route::get("signin", fn() => to_route("Auth.create"));
//Route::get("signout", fn() => to_route("Auth.delete"));

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

Route::resource('room-sample', RoomSampleController::class);
Route::get('/room-sample/{roomSample}/image', [RoomSampleController::class, 'showImage'])
    ->name('room-sample.image');

Route::get('/image/{imageModel}/{modelId}/{property}', [RoomSampleController::class, 'show'])
    ->name('image.show');

