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
})->name("dashboard");

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

Route::prefix('api')
    ->name('api.')
    ->group(function () {
        Route::get('/guest/list', [GuestController::class, 'list'])
            ->name('guest.list');

        Route::get('/room-sample/list', [RoomSampleController::class, 'list'])
            ->name('room-sample.list');

        Route::get('/room/list', [RoomController::class, 'list'])
            ->name('room.list');

        Route::get('/room/available', [RoomController::class, 'getAvailableRooms'])
            ->name('room.available');
    });

Route::resource('booking', BookingController::class)
    ->parameters([
        'booking' => 'model',
    ])
    ->except(['edit', 'update']);

Route::resource('guest', GuestController::class)
    ->parameters([
        'guest' => 'model',
    ]);

Route::resource('room-sample', RoomSampleController::class)
    ->parameters([
        'room-sample' => 'model',
    ]);

Route::resource('room', RoomController::class)
    ->parameters([
        'room' => 'model',
    ]);

Route::get('/image/{modelName}/{modelId}/{property}', [ImageController::class, 'show'])
    ->name('image.show');

