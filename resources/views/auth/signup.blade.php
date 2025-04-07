@extends('app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-background p-4">
        <div class="w-full max-w-md">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-2xl font-semibold text-center">Register</h2>
                    <p class="text-sm text-muted text-center mt-1">Create a new account to get started.</p>
                </div>

                <div class="card-body">
                    <form action="{{ route('Auth.createUser') }}" method="POST" class="form-container">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <input id="name" type="text" name="name" class="form-input" placeholder="Your Name" required>
                            @error('name')
                            <p class="text-destructive text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" class="form-input" placeholder="your@email.com" required>
                            @error('email')
                            <p class="text-destructive text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password" class="form-input" placeholder="••••••••" required>
                            @error('password')
                            <p class="text-destructive text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="btn btn-primary btn-block">
                                Register
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <p class="text-sm">
                        Already have an account?
                        <a href="{{ route('Auth.login') }}" class="text-primary">
                            Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
