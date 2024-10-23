<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @if (isset($thread_title))
            {{ $thread_title }} |
        @elseif (Request::is('topic/*/*/thread/create'))
            @yield('page') | 
        @elseif (Request::is('thread/*/*/reply/*/edit'))
        @yield('page') | 
        @elseif (isset($category))
            {{ $category->title }} |
        @else
            @yield('page') | 
        @endif

        ConZone
    </title>

    <!-- Primary Meta Tags -->
    <meta name="title" content="ConZone" />
    <meta name="description" content="The ultimate gaming community for gamers!" />
    <meta name="keywords" content="forum, gamer, thread">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="ConZone Group">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://metatags.io/" />
    <meta property="og:title" content="ConZone" />
    <meta property="og:description" content="The ultimate gaming community for gamers!" />
    <meta property="og:image" content="https://metatags.io/images/meta-tags.png" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://metatags.io/" />
    <meta property="twitter:title" content="ConZone" />
    <meta property="twitter:description" content="The ultimate gaming community for gamers!" />
    <meta property="twitter:image" content="https://metatags.io/images/meta-tags.png" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ url('favicon/site.webmanifest') }}">

    <!-- Scripts -->
    @vite(['resources/forum/blade-bootstrap/js/forum.js', 'resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('layouts.navigation')

        <main class="container my-5 py-4">
            @include ('forum::partials.alerts')

            <div class="row mb-2">
                <div class="col-lg-9">
                    @include ('forum::partials.breadcrumbs')
                    @yield('content')
                </div>
                    @include ('forum::layouts.sidebar')
            </div>
        </main>
        
        <div class="mask"></div>
        @include ('layouts/footer')
    </div>
</body>
</html>
