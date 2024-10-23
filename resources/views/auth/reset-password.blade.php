@extends('layouts.guest')
@section('page') Confirm Password @endsection
@section('content')

<style>
    .reset-container {
        max-width: 500px;
        margin: 50px auto;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="reset-container">
            <div class="bg-body-tertiary border p-4">
                <h2 class="text-center">{{ __('Reset Your Password') }}</h2>

                <div class="p-3 m-2 text-center display-1">
                    <span class="bi bi-arrow-repeat"></span>
                </div>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>

                        <input id="email" type="email" class="form-control fw-lighter @error('email') is-invalid @enderror" name="email" value="{{ old('email', $request->email) }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>

                        <div class="input-group">
                            <input id="password" type="password" class="form-control fw-lighter @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>

                        <div class="input-group">
                            <input id="password-confirm mt-2" type="password" class="form-control fw-lighter" name="password_confirmation" required>

                            <div class="input-group-append">
                                <span class="input-group-text border bg-body-secondary rounded-start-0 rounded-end-pill">
                                    <a class="toggle-password link-body-emphasis" href=""><i class="bi bi-eye-slash text-body-emphasis" aria-hidden="true"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Reset Password') }}
                        </button>
                    </div>

                </form>
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
