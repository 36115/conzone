@extends('layouts.app')
@section('page') Security @endsection
@section('content')
<div class="row justify-content-center">
    <h2 class="mb-3">{{ __('Account Settings') }}</h2>
    <nav class="nav border-bottom border-opacity-50 p-2"> 
        {{-- <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a> --}}
        <a class="nav-link active border-3 border-primary-subtle border-bottom" href="{{ route('profile.security') }}">Security</a> 
    </nav>
    <div class="row justify-content-center mt-3 mb-4">
        <div class="col-md-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="col-md-5">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
