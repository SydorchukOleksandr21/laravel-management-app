<?php

use App\Http\Controllers\AuthController;
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


Route::prefix("/auth")->name("auth.")
    ->group(function () {
    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::get("/signup", [AuthController::class, "signup"])->name("signup");

    Route::post("/loginUser", [AuthController::class, "loginUser"])->name("loginUser");
    Route::post("/createUser", [AuthController::class, "createUser"])->name("createUser");

    Route::delete("/logout", [AuthController::class, "logout"])->name("logout");
});

