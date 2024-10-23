@extends('layouts.guest')
@section('page') Login @endsection
@section('content')

<style>
    .login-container {
        max-width: 500px;
        margin: 50px auto;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="login-container">
            <div class="bg-body-tertiary border p-4">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <h2 class="text-center mb-4">Login to ConZone</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="login" class="form-label">{{ __('Username/Email') }}</label>

                        <input id="login" type="text" class="form-control fw-lighter @error('login') is-invalid @enderror" name="login" placeholder="Username or Email" value="{{ old('login') }}" required autocomplete="login" autofocus>

                        @error('login')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>

                        <div class="input-group">
                            <input id="password" type="password" class="form-control fw-lighter @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                            <div class="input-group-append">
                                <span class="input-group-text border bg-body-secondary rounded-start-0 rounded-end-pill">
                                    <a class="toggle-password link-body-emphasis" href=""><i class="bi bi-eye-slash text-body-emphasis" aria-hidden="true"></i></a>
                                </span>
                            </div>

                            @error('password')
                                <span class="invalid-feedback mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-check pt-2">
                        <label for="remember" class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="form-check-label pt-2">
                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Log in') }}
                        </button>

                        @if (Route::has('password.request'))
                            <div class="py-2 text-center">
                                <a class="text-primary" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            </div>
                        @endif
                    </div>

                </form>
                
                <hr>
                <div class="text-center">
                    <p>Don't have an account? <a href="{{ route('register') }}" class="text-primary">Register</a></p>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection
