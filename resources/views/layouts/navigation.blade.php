<style>
    * {
        font-family: Mitr, sans-serif !important;
    }

    #app {
        display: flex;
        flex-direction: column;
        padding-top: 70px;
        min-height: 100vh;
    }

    footer {
        margin-top: auto;
    }

    .hover {
        cursor: pointer;
    }
    
    .form-check-input {
        cursor: pointer;
    }
</style>

<nav class="navbar navbar-expand-lg bg-body border-bottom fixed-top py-4">
    <div class="container">
        <a class="navbar-brand user-select-none" href="/"><img width="200" src="@include ('layouts/brand')"></a>

        <div class="dropdown-center me-2 ms-auto">
            <button class="btn border dropdown-toggle" type="button" id="bd-theme" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-circle-half theme-icon-active me-1"></i>
                <span id="bd-theme-text">System</span>
            </button>
            <div class="dropdown-menu border my-2 dropdown-menu-end rounded-4">
                <div>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
                    <i class="bi bi-sun-fill theme-icon-active me-1"></i>
                    Light
                    </button>
                </div>
                <div>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
                    <i class="bi bi-moon-stars-fill theme-icon-active me-1"></i>
                    Dark
                    </button>
                </div>
                <div>
                    <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
                    <i class="bi bi-circle-half theme-icon-active me-1"></i>
                    System
                    </button>
                </div>
            </div>
        </div>

        <button class="navbar-toggler my-2 collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="bi bi-list-nested"></span>
        </button>

        <div class="offcanvas offcanvas-end bg-body" tabindex="-1" id="offcanvasNavbar">
            <div class="offcanvas-header py-3 pb-0">
                <a class="navbar-brand user-select-none" href="/"><img width="300" src="@include ('layouts/brand')"></a>

                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            
            <div class="offcanvas-body pt-0">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item d-flex align-items-center ms-2">
                        <a class="nav-link" aria-current="page" href="/"><i class="bi bi-house-door"></i> Home</a>
                    </li>
                    <li class="nav-item d-flex align-items-center ms-2">
                        <a class="nav-link" href="/rules"><i class="bi bi-journal-bookmark-fill"></i> Rules</a>
                    </li>
                    <li class="nav-item d-flex align-items-center ms-2">
                        <a class="nav-link" href="/about"><i class="bi bi-info-circle"></i> About Us</a>
                    </li>

                    @if (Auth::check())

                    <div class="dropdown-center">
                        
                        <a class="btn btn-primary d-flex align-items-center h6 dropdown-toggle mx-2" id="userDropdown" data-bs-toggle="dropdown">
                        <img class="rounded-circle border border-1 border-bg me-2" style="height: 2rem; width: 2rem; background-color: var(--bs-border-color); object-fit: cover;" src="@if (Auth::user()->profile_image) {{ asset(Auth::user()->profile_image) }} @else {{ 'https://ui-avatars.com/api/?name='. urlencode(Auth::user()->displayname) .'&background=random&bold=true' }} @if (!str_contains(Auth::user()->displayname, ' ')) &length=1 @endif @endif">
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-left">Hi, {{ Auth::user()->displayname }}!</span>
                                <small class="d-flex justify-content-start text-white-50 text-left"><span>@</span>{{ Auth::user()->username }}</small>
                            </div>
                        </a>
                        
                        <ul class="dropdown-menu p-2 my-2 border rounded-4">
                            <div class="p-3 px-1 py-1 mx-2">
                                <div class="d-flex align-items-center">
                                    <img class="d-flex align-items-center rounded-circle border border-1 border-secondary me-2" style="height: 2rem; width: 2rem; background-color: var(--bs-border-color); object-fit: cover;" src="@if (Auth::user()->profile_image) {{ asset(Auth::user()->profile_image) }} @else {{ 'https://ui-avatars.com/api/?name='. urlencode(Auth::user()->displayname) .'&background=random&bold=true' }} @if (!str_contains(Auth::user()->displayname, ' ')) &length=1 @endif @endif">
                                    <div class="d-inline-flex flex-column">
                                        <span class="fw-bold">{{ Auth::user()->displayname }}</span>
                                        <small class="text-muted"><span>@</span>{{ Auth::user()->username }}</small>
                                        <a id="edit-profile" class="fw-light" href="{{ route('profile.edit') }}">Edit Profile</a>
                                    </div>
                                </div>
                            </div>
                            <li><hr class="dropdown-divider"></li>
                            <li><span class="text-muted mx-2 fw-light">Options</span></li>
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Your Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('forum.recent') }}">{{ trans('forum::threads.recent') }}</a></li>
                            @auth
                                <li><a class="dropdown-item " href="{{ route('forum.unread') }}">{{ trans('forum::threads.unread_updated') }}</a></li>
                            @endauth
                            @can ('moveCategories')
                                <li><hr class="dropdown-divider"></li>
                                <li><span class="text-muted mx-2 fw-light">Admin Menu</span></li>
                                <li><a class="dropdown-item" href="{{ route('forum.category.manage') }}">{{ trans('forum::general.manage') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin') }}">Admin Dashboard</a></li>
                            @endcan
                            <li><hr class="dropdown-divider"></li>
                            <li><span class="text-muted mx-2 fw-light">Settings</span></li>
                            <li><a class="dropdown-item" href="{{ route('profile.security') }}">Security</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item hover text-danger" href=""
                                onclick="if (confirm('Do you want to logout?')) { 
                                            event.preventDefault(); 
                                            document.getElementById('logout-form').submit(); 
                                        }">
                                    {{ __('Log Out') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <style>
                                    a.text-danger.dropdown-item {
                                        transition: .2s;
                                    }

                                    a.text-danger.dropdown-item:hover {
                                        background-color: var(--bs-danger) !important;
                                        color: var(--bs-dropdown-link-active-color) !important;
                                        transition: .2s;
                                    }
                                </style>
                                
                            </li>
                        </ul>
                    </div>

                    @else
                    <a class="btn btn-primary d-flex align-items-center h6 p-3 mx-2" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login / Register
                    </a>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>

<script> 
    (() => {
        'use strict'
        const storedTheme = localStorage.getItem('theme')
        const getPreferredTheme = () => {
            if (storedTheme) {
            return storedTheme
            }
            return 'auto'
        }
        const setTheme = function (theme) {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else if (theme === 'auto') {
            document.documentElement.setAttribute('data-bs-theme', 'light')
            } else {
            document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }
        setTheme(getPreferredTheme())
        const showActiveTheme = theme => {
            const activeThemeIcon = document.querySelector('.theme-icon-active')
            const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
            const svgOfActiveBtn = btnToActive.querySelector('i').getAttribute('class')
            document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
            element.classList.remove('active')
            })
            btnToActive.classList.add('active')
            const themeSwitcher = document.querySelector('#bd-theme')
            if (themeSwitcher) {
            const themeSwitcherText = document.querySelector('#bd-theme-text')
            const activeThemeIcon = themeSwitcher.querySelector('i')
            const btnIcon = btnToActive.querySelector('i').getAttribute('class')
            const themeSwitcherLabel = `${btnToActive.textContent} (${theme})`
            activeThemeIcon.setAttribute('class', btnIcon)
            themeSwitcherText.textContent = btnToActive.textContent
            }
        }
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (storedTheme !== 'light' && storedTheme !== 'dark') {
            setTheme(getPreferredTheme())
            }
        })
        window.addEventListener('DOMContentLoaded', () => {
            showActiveTheme(getPreferredTheme())
            document.querySelectorAll('[data-bs-theme-value]')
            .forEach(toggle => {
                toggle.addEventListener('click', () => {
                const theme = toggle.getAttribute('data-bs-theme-value')
                localStorage.setItem('theme', theme)
                setTheme(theme)
                showActiveTheme(theme)
                })
            })
        })
    })()

</script>
