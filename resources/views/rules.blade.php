<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Forum Rules | {{config('app.name')}}</title>
    
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
                    <h1 class="display-4 fw-bold">Forum Rules</h1>
                    <p class="text-body lead mb-4">Guidelines for a respectful and enjoyable community.</p>
                </div>
            </div>

            <div class="container my-5">
                <h2 class="text-center mb-5">Rules</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 rule-card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-chat-quote text-primary me-2"></i>Respect Others</h5>
                                <p class="card-text">Treat all members with respect. No hate speech, personal attacks, or harassment will be tolerated.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 rule-card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-shield-check text-primary me-2"></i>Keep It Clean</h5>
                                <p class="card-text">No explicit, offensive, or inappropriate content. Keep discussions family-friendly.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 rule-card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-signpost-split text-primary me-2"></i>Stay On Topic</h5>
                                <p class="card-text">Post in the appropriate sections. Off-topic posts may be moved or removed.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 rule-card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-pencil-square text-primary me-2"></i>No Spamming</h5>
                                <p class="card-text">Avoid repeated posts, excessive self-promotion, or any form of spamming.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 rule-card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-lock text-primary me-2"></i>Protect Privacy</h5>
                                <p class="card-text">Do not share personal information about yourself or others without consent.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 rule-card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-currency-dollar text-primary me-2"></i>No Illegal Activities</h5>
                                <p class="card-text">Do not discuss or promote any illegal activities, including piracy or cheating.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 rule-card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-link-45deg text-primary me-2"></i>Use Appropriate Links</h5>
                                <p class="card-text">Only share links to safe and relevant content. No malicious or misleading links.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 rule-card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-person-badge text-primary me-2"></i>Respect Moderators</h5>
                                <p class="card-text">Follow moderator instructions. If you disagree, use appropriate channels to appeal.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 rule-card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-flag text-primary me-2"></i>Report Issues</h5>
                                <p class="card-text">If you see a post that violates these rules, please report it to the moderators.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-5 text-center">
                    <p>By participating in the ConZone, you agree to abide by these rules. Failure to do so may result in warnings, post removal, or account suspension.</p>
                </div>
            </div>

        </main>
        @include ('layouts/footer')
    </div>
</body>
</html>
