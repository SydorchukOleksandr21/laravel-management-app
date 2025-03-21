@extends('app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-background p-4">
        <div class="w-full max-w-md">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-2xl font-semibold text-center">Login</h2>
                    <p class="text-sm text-muted text-center mt-1">Welcome back! Please login to your account.</p>
                </div>

                <div class="card-body">
                    <form  method="POST" class="form-container">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" class="form-input" placeholder="your@email.com" required autofocus>
                            @error('email')
                            <p class="text-destructive text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="flex items-center justify-between mb-1">
                                <label for="password" class="form-label">Password</label>
                                @if (Route::has('password.request'))
                                    <a class="text-sm text-primary">
                                        Forgot Password?
                                    </a>
                                @endif
                            </div>
                            <input id="password" type="password" name="password" class="form-input" placeholder="••••••••" required>
                            @error('password')
                            <p class="text-destructive text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center mt-4">
                            <input id="remember" type="checkbox" name="remember" class="form-checkbox">
                            <label for="remember" class="ml-2 text-sm">Remember me</label>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="btn btn-primary btn-block">
                                Login
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <p class="text-sm">
                        Don't have an account?
                        <a class="text-primary">
                            Create an account
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
