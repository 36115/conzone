@extends('layouts.app')
@section('page') {{ $user->displayname }}'s Profile @endsection
@section('content')

@if (session('status') === 'profile-updated')
    <div class="alert alert-success alert-dismissible text-body-emphasis fade show rounded-pill" role="alert">
        <span class="bi bi-check-circle-fill"></span>
        {{ __('Profile Saved Success!') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('status') === 'social-media-updated')
    <div class="alert alert-success alert-dismissible text-body-emphasis fade show rounded-pill" role="alert">
        <span class="bi bi-check-circle-fill"></span>
        {{ __('Social Media Info Saved Success!') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('status') === 'profile-img-removed')
    <div class="alert alert-success alert-dismissible text-body-emphasis fade show rounded-pill" role="alert">
        <span class="bi bi-check-circle-fill"></span>
        {{ __('Profile Image Removed Success!') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('status') === 'banner-img-removed')
    <div class="alert alert-success alert-dismissible text-body-emphasis fade show rounded-pill" role="alert">
        <span class="bi bi-check-circle-fill"></span>
        {{ __('Profile Banner Removed Success!') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="d-block">
    <div class="card mt-3 mb-4">
        <div class="card-body p-0">
            <div class="position-relative">
                <img src="@if ($user->profile_banner) {{ asset($user->profile_banner) }} @else {{ asset('users/profile-banners/default.png') }} @endif" class="img-fluid user-select-none border rounded-4 w-100" style="height: 200px; object-fit: cover; border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important; background-color: var(--bs-card-bg);">
                <div class="position-absolute rounded-4 top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.65) 100%); border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important;"></div>
                    <div class="position-absolute bottom-0 start-0 p-3 d-flex align-items-end">
                        <img src="@if ($user->profile_image) {{ asset($user->profile_image) }} @else {{ 'https://ui-avatars.com/api/?name='. urlencode($user->displayname) .'&background=random&bold=true' }} @if (!str_contains($user->displayname, ' ')) &length=1 @endif @endif" class="rounded-circle user-select-none border border-3 border-white" style="width: 100px; height: 100px; object-fit: cover; background-color: var(--bs-card-bg);">
                        <div class="position-absolute top-0 start-0 w-100 h-100"></div>
                        <div class="ms-3 text-white">
                            <h3 class="mb-0 d-flex">
                                {{ $user->displayname }}
                                
                                @if (Auth::user()->username == $user->username)
                                    <span class="badge text-bg-primary user-select-none rounded-pill ms-2 fs-6">You</span>
                                @endif
                            </h3>
                            <small class="text-white-50"><span>@</span>{{ $user->username }}</small>
                        </div>
                    </div>
                </div>

                <div class="p-3">
                    <div class="d-block">
                        @if ($user->role == 'Admin')
                            <span class="badge bg-danger user-select-none rounded-pill me-2"><i class="bi bi-hammer"></i> Admin</span>
                        @elseif ($user->role == 'Moderator')
                            <span class="badge user-select-none rounded-pill me-2" style="background-color: var(--bs-orange);"><i class="bi bi-person-fill-gear"></i> Staff</span>
                        @else
                            <span class="badge bg-info user-select-none rounded-pill me-2"><i class="bi bi-person-fill"></i> User</span>
                        @endif
                    </div>

                    <p class="my-2">Joined: @if (isset($user->created_at)) {{ $user->created_at->format('M d, Y') }} @else No Data @endif</p>


                    <p class="mb-0">{{ __('About') }}</p>
                    <div class="text-muted fw-light">
                        @if ($user->bio == null)
                            <p class="text-muted fw-light">Not Set.</p>
                        @endif
                        {{ $user->bio }}
                    </div>

                    @if (Auth::user()->id == $user->id)
                        <div class="text-end mb-2">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>

    @php($userHasPosted = false)

    <div class="row g-4">
        @if ($user->social_email != 0 || isset($user->social_website) || isset($user->social_x) || isset($user->social_facebook) || isset($user->social_instagram) || isset($user->social_youtube))
            <div class="col-md-4">
                <div class="sticky-top" style="top: 130px; z-index: 0;">
                    <div class="card">
                        <div class="card-header">Social Media</div>

                        <div class="card-body">

                            @if ( $user->social_email != 0)
                                <div class="row">
                                    <p><i class="bi bi-envelope-at-fill"></i> <a class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                                </div>
                            @endif

                            @if (isset($user->social_website))
                                <div class="row">
                                    <p class="col"><i class="bi bi-globe2"></i> <a class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ $user->social_website }}">{{ preg_replace( "#^[^:/.]*[:/]+#i", "", $user->social_website) }}</a></p>
                                </div>
                            @endif

                            @if (isset($user->social_x))
                                <div class="row">
                                    <p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"></path>
                                        </svg>
                                        <a class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="https://www.x.com/{{ $user->social_x }}">x.com/{{ $user->social_x }}</a>
                                    </p>
                                </div>
                            @endif

                            @if (isset($user->social_facebook))
                                <div class="row">
                                    <p><i class="bi bi-facebook"></i> <a class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="https://www.facebook.com/{{ $user->social_facebook }}">facebook.com/{{ $user->social_facebook }}</a></p>
                                </div>
                            @endif

                            @if (isset($user->social_instagram))
                                <div class="row">
                                    <p><i class="bi bi-instagram"></i> <a class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="https://www.instagram.com/{{ $user->social_instagram }}">instagram.com/{{ $user->social_instagram }}</a></p>
                                </div>
                            @endif

                            @if (isset($user->social_youtube))
                                <div class="row">
                                    <p><i class="bi bi-youtube"></i> <a class="link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="https://www.youtube.com/{{ '@'.$user->social_youtube }}">youtube.com/<span>@</span>{{ $user->social_youtube }}</a></p>
                                </div>
                            @endif

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <h2 class="py-3">{{ $user->displayname }}'s Threads</h2>
                    <div class="list-group shadow-sm p-2">
                        @foreach ($threads as $thread)
                            @if ($thread->author_id == $user->id)
                                @include ('forum::thread.partials.list')
                                
                                @php ($userHasPosted = true)
                            @endif
                        @endforeach

                        @if (!$userHasPosted)
                            <div class="card d-flex flex-column align-items-center p-3 mt-0">
                                <p class="text-center">The user didn't post any threads.</p>
                                <i class="bi bi-chat-dots fs-5 text-center"></i>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        @else
            <div class="col">
                <h2 class="py-3">{{ $user->displayname }}'s Threads</h2>
                <div class="list-group shadow-sm">
                    @foreach ($threads as $thread)
                        @if ($thread->author_id == $user->id)
                            @include ('forum::thread.partials.list')

                            @php ($userHasPosted = true)
                        @endif
                    @endforeach

                    @if (!$userHasPosted)
                        <div class="card d-flex flex-column align-items-center p-3 mt-0">
                            <p class="text-center">The user didn't post any threads.</p>
                            <i class="bi bi-chat-dots fs-5 text-center"></i>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

</div>

@endsection
