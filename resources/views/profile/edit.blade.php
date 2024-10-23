@extends('layouts.app')
@section('page') Profile Edit @endsection
@section('content')
<div class="row justify-content-center">
    <h2 class="mb-3">{{ __('Profile Edit') }}</h2>
    <div class="mb-4">
        @include('profile.partials.update-profile-information-form')
    </div>
</div>
@endsection
