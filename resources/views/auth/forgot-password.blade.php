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
                <h2 class="text-center">{{ __('Password Reset') }}</h2>
                <p class="text-muted text-center fw-lighter">{{ __('Enter your email to reset your password.') }}</p>

                <div class="p-3 m-2 bg-danger bg-gradient text-center rounded-4">
                    <span class="bi bi-exclamation-triangle-fill display-5"></span><br>
                    If you didn't use real email, we can't recovery your account.
                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Enter your Email') }}</label> <span class="text-danger">*</span>

                        <input id="email" type="email" class="form-control fw-lighter @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback mt-2" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-4 my-2">
                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Confirm') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
