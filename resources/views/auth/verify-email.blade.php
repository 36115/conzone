@extends('layouts.guest')
@section('page') Verify Your Email @endsection
@section('content')

<style>
    .verify-container {
        max-width: 500px;
        margin: 50px auto;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="verify-container">
            <div class="bg-body-tertiary border p-4">
                <h2 class="text-center">{{ __('Verify Your Email Address') }}</h2>

                <div class="text text-center m-3">
                    <span class="bi bi-envelope-fill display-5 color-succes"></span>
                </div>

                <div class="text-muted text-center fw-lighter">
                    Just Click on the link in that email to complete your registion.
                    If you don't see it, you may need to <b>check your spam</b> 
                    folder. <br><br> You can resent it, If you didn't receive your email.
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success" role="alert">
                        {{ __('Sent verify link to your email again!') }}
                    </div>
                @endif

                <form class="text-center pt-2" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-link">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form class="text-center pt-2" method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="btn btn-danger rounded-pill">
                        {{ __('Log Out') }}
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
