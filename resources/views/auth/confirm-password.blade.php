@extends('layouts.guest')
@section('page') Confirm Password @endsection
@section('content')

<style>
    .confirm-container {
        max-width: 500px;
        margin: 50px auto;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="comfirm-container">
            <div class="bg-body-tertiary border p-4">

                <h2 class="text-center">{{ __('Comfirm Password') }}</h2>

                <div class="p-3 m-2 text-center display-1">
                    <span class="bi bi-lock-fill"></span>
                </div>

                <p class="text-muted text-center fw-lighter">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Enter your Password') }}</label> <span class="text-danger">*</span>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control fw-lighter @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback mt-2" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
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
