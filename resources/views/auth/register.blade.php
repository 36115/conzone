@extends('layouts.guest')
@section('page') Register @endsection
@section('content')

<style>
    .register-container {
        max-width: 700px;
        margin: 50px auto;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="register-container">
            <div class="bg-body-tertiary border p-4">
                <h2 class="text-center mb-4">Register</h2>
                <p class="text-muted text-center fw-lighter">Create your account and talk with your community.</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">{{ __('Username') }}</label> <span class="text-danger">*</span>

                        <div class="input-group">
                            <div class="input-group">
                                <span class="input-group-text border bg-body-secondary rounded-start-pill" id="handle">@</span>
                                <input id="username" type="text" class="form-control fw-lighter rounded-end-pill @error('username') is-invalid @enderror" name="username" placeholder="Username only contain letters, numbers, and underscores" value="{{ old('username') }}" required autocomplete="username" min="4" max="20" autofocus>
                            </div>
                            @error('username')
                                <span class="invalid-feedback mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label> <span class="text-danger">*</span>

                        <input id="email" type="email" class="form-control fw-lighter @error('email') is-invalid @enderror" name="email" placeholder="Use Your Real Email Address" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label> <span class="text-danger">*</span>

                        <div class="input-group">
                            <input id="password" type="password" class="form-control fw-lighter @error('password') is-invalid @enderror" name="password" placeholder="At least 8 character" required autocomplete="new-password">

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

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label> <span class="text-danger">*</span>

                        <div class="input-group">
                            <input id="password-confirm" type="password" class="form-control fw-lighter" name="password_confirmation" placeholder="Repeat your password" required>
                        
                            <div class="input-group-append">
                                <span class="input-group-text border bg-body-secondary rounded-start-0 rounded-end-pill">
                                    <a class="toggle-password link-body-emphasis" href=""><i class="bi bi-eye-slash text-body-emphasis" aria-hidden="true"></i></a>
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input rounded-pill" name="agreeTerms" required>
                            <span>I agree to <a href="/terms" class="text-muted me-2">Terms</a>and <a href="/privacy-policy" class="text-muted me-2">Privacy Policy</a><span class="text-danger">*</span></span>
                        </label>
                    </div>

                    <div class="form-check-label pt-2">
                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Register') }}
                        </button>
                    </div>
                    
                </form>

                <hr>
                <div class="text-center">
                    <p>Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a></p>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-password').forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                let passwordInput = this.closest('.input-group').querySelector('input');
                let icon = this.querySelector('i');
                
                if(passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                }
            });
        });
    });
</script>

@endsection
