<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RoomController;
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

Route::resource('guest', GuestController::class)->parameters([
    'guest' => 'model',
]);

Route::get('/room-sample/list', [RoomSampleController::class, 'list'])
    ->name('room-sample.list');

Route::resource('room-sample', RoomSampleController::class)->parameters([
    'room-sample' => 'model',
]);

Route::get('/room/list', [RoomController::class, 'list'])
    ->name('room.list');

Route::resource('room', RoomController::class)->parameters([
    'room' => 'model',
]);

Route::get('/image/{modelName}/{modelId}/{property}', [ImageController::class, 'show'])
    ->name('image.show');

