<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>About Us | {{config('app.name')}}</title>

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

    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    .hero-section {
        background: url('https://images.unsplash.com/photo-1511512578047-dfb367046420?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center;
        background-size: cover;
        height: 650px;
        position: relative;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .card {
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }
</style>
<body>
    <div id="app">
        @include('layouts.navigation')

        <main>
            <div class="hero-section d-flex align-items-center justify-content-center text-white">
                <div class="hero-content text-center">
                    <h1 class="display-4 fw-bold"><img width="500" src="@include ('layouts/brand')"></h1>
                    <p class="text-body lead mb-4">The ultimate gaming community for gamers!</p>
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-pill px-4">Join Now</a> <a id="about" href="#about" class="btn btn-outline-light btn-lg rounded-pill px-4">Learn More</a>
                </div>
            </div>

            <div class="container my-5">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="section-title">Why Join ConZone?</h2>
                        <p class="mb-4">ConZone is more than just a forum - it's a thriving community of gamers from all platforms. Whether you're a PC enthusiast, console loyalist, or mobile gamer, you'll find your place here.</p>
                    </div>
                </div>
            </div>

            <div class="bg-body-tertiary py-5">
                <div class="container">
                    <h2 class="mb-5">Our Features</h2>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="bi bi-people-fill fs-1 text-primary mb-3"></i>
                                    <h5 class="card-title">Vibrant Community</h5>
                                    <p class="card-text">Connect with gamers from around the world and share your passion.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="bi bi-newspaper fs-1 text-primary mb-3"></i>
                                    <h5 class="card-title">Latest Gaming News</h5>
                                    <p class="card-text">Stay updated with the newest releases, patches, and gaming events.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="bi bi-controller fs-1 text-primary mb-3"></i>
                                    <h5 class="card-title">Multi-Platform Support</h5>
                                    <p class="card-text">Discuss games across PC, console, and mobile platforms all in one place.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container my-5">
                <div class="text-center">
                    <h2 class="section-title">Ready to join the conversation?</h2>
                    <p class="lead mb-4">Don't miss out on the latest discussions, news, and gaming insights. Join ConZone today and be part of our growing community!</p>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill px-4">Register Now</a>
                    <p class="text my-4">Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a></p>
                </div>
            </div>
        </main>
        @include ('layouts/footer')
    </div>
</body>
</html>
