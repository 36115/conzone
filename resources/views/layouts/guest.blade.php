<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page') | {{config('app.name')}}</title>

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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        @include('layouts.navigation')   

        <main class="container-xl my-5 py-4">
            @yield('content')
        </main>
        @include ('layouts/footer')
    </div>
</body>
</html>
