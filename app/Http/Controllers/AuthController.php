<?php

namespace App\Http\Controllers;

use App\Http\Controllers\base\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function signup()
    {
        return view('auth.signup');
    }


    public function loginUser(LoginRequest $request, AuthService $authService): RedirectResponse
    {
        if ($authService->attemptLogin($request->validated())) {
            return redirect()->intended(route('dashboard'));
        }

        Log::warning('Failed login attempt', ['email' => $request->input('email')]);

        return back()->withErrors(['email' => __('Auth.failed')]);

//        $request->validate([
//            "email" => "required|email",
//            "password" => "required"
//        ]);
//
//        $credentials = $request->only(["email", "password"]);
//        $remember = $request->filled("remember");
//
//        if(Auth::attempt($credentials, $remember))
//        {
//            return redirect()->intended("/");
//        }
//
//        return redirect()->back()->with("error", "Invalid credentials");
    }

    public function createUser(SignupRequest $request, AuthService $authService): RedirectResponse
    {
        if (!$request->validated()) {
            //return validation errors automatically
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return $this->loginUser($request, $authService);
    }


    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect("/");
    }
}
