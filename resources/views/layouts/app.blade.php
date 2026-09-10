<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="retro">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Menu') }}</title>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Tailwind CSS --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    {{-- Daisy UI CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />

    {{-- Daisy UI Themes --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/v/dt/dt-3.0.3/datatables.min.css" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes wave {

            0%,
            60%,
            100% {
                transform: rotate(0deg);
            }

            10%,
            30% {
                transform: rotate(14deg);
            }

            20% {
                transform: rotate(-8deg);
            }

            40% {
                transform: rotate(-4deg);
            }

            50% {
                transform: rotate(10deg);
            }
        }
    </style>

    @yield('style')
</head>

<body class="flex flex-col items-center">
    {{-- Navbar --}}
    <div class="navbar bg-base-100 shadow-sm z-50">
        <div class="navbar-start">
            {{-- Hamburger dropdown (small screens only) --}}
            <div class="dropdown lg:hidden">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
                <ul tabindex="-1"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                    <li><a href="{{ url('/#go-to-appitizers') }}">Appitizers</a></li>
                    <li><a href="{{ url('/#go-to-main') }}">Main</a></li>
                    <li><a href="{{ url('/#go-to-drinks') }}">Drinks</a></li>
                    <li><a href="{{ url('/#go-to-desserts') }}">Desserts</a></li>
                </ul>
            </div>

            {{-- Horizontal menu (large screens and up) --}}
            <ul class="menu menu-horizontal hidden lg:flex px-1">
                <li><a href="{{ url('/#go-to-appitizers') }}">Appitizers</a></li>
                <li><a href="{{ url('/#go-to-main') }}">Main</a></li>
                <li><a href="{{ url('/#go-to-drinks') }}">Drinks</a></li>
                <li><a href="{{ url('/#go-to-desserts') }}">Desserts</a></li>
            </ul>
        </div>
        <div class="navbar-center">
            <a class="btn btn-ghost text-xl" href="{{ route('home') }}">
                {{ config('app.name', 'Menu') }}
            </a>
        </div>
        <div class="navbar-end pe-2">
            @auth
                <ul class="menu menu-horizontal pe-4 ">
                    {{-- Small screens: collapsed dropdown --}}
                    <li class="lg:hidden">
                        <details>
                            <summary>
                                {{ Auth::user()->name }}
                            </summary>
                            <ul class="bg-base-100 rounded-t-none p-2 z-1">
                                <li>
                                    <a href="{{ route('dashboard') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 6.75a3 3 0 013-3h10.5a3 3 0 013 3v10.5a3 3 0 01-3 3H6.75a3 3 0 01-3-3V6.75z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 9h16.5M9 3.75v16.5" />
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('categories.index') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                        </svg>
                                        Categories
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('items.index') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 3v6.75a1.5 1.5 0 01-1.5 1.5H6a1.5 1.5 0 01-1.5-1.5V3M8.25 3v18M4.5 3v3.75m3.75-3.75v3.75M15.75 3c-1.243 0-2.25 1.679-2.25 3.75S14.507 10.5 15.75 10.5s2.25-1.679 2.25-3.75S16.993 3 15.75 3zm0 7.5V21" />
                                        </svg>
                                        Items
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                             document.getElementById('logout-form-sm').submit();">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </a>
                                    <form id="logout-form-sm" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </details>
                    </li>

                    {{-- Large screens: horizontal items --}}
                    <li class="hidden lg:flex">
                        <a href="{{ route('dashboard') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75a3 3 0 013-3h10.5a3 3 0 013 3v10.5a3 3 0 01-3 3H6.75a3 3 0 01-3-3V6.75z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5M9 3.75v16.5" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="hidden lg:flex">
                        <a href="{{ route('categories.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>
                            Categories
                        </a>
                    </li>
                    <li class="hidden lg:flex">
                        <a href="{{ route('items.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 3v6.75a1.5 1.5 0 01-1.5 1.5H6a1.5 1.5 0 01-1.5-1.5V3M8.25 3v18M4.5 3v3.75m3.75-3.75v3.75M15.75 3c-1.243 0-2.25 1.679-2.25 3.75S14.507 10.5 15.75 10.5s2.25-1.679 2.25-3.75S16.993 3 15.75 3zm0 7.5V21" />
                            </svg>
                            Items
                        </a>
                    </li>
                    <li class="hidden lg:flex">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                 document.getElementById('logout-form-lg').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </a>
                        <form id="logout-form-lg" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endauth

            <label class="swap swap-rotate">
                {{-- this hidden checkbox controls the state --}}
                <input type="checkbox" class="theme-controller" value="coffee" />

                {{-- sun icon --}}
                <svg class="swap-off h-10 w-10 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
                </svg>

                {{-- moon icon --}}
                <svg class="swap-on h-10 w-10 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
                </svg>
            </label>
        </div>
    </div>

    @yield('content')

    {{-- Footer --}}
    <footer class="footer relative bottom-0 sm:footer-horizontal footer-center bg-base-100 text-base-content p-4">
        <aside>
            <p>Menu © 2026 - All right reserved by Mustafa</p>
        </aside>
    </footer>

    <script src="https://cdn.datatables.net/v/dt/dt-3.0.3/datatables.min.js"></script>

    <script>
        const themeCheckbox = document.querySelector(".theme-controller");

        const savedTheme = localStorage.getItem("theme");

        if (savedTheme) {
            document.documentElement.setAttribute("data-theme", savedTheme);
            themeCheckbox.checked = savedTheme === "coffee";
        }

        themeCheckbox.addEventListener("change", function() {
            const newTheme = themeCheckbox.checked ? "coffee" : "retro";
            document.documentElement.setAttribute("data-theme", newTheme);
            localStorage.setItem("theme", newTheme);
        });
    </script>

    @yield('script')
</body>

</html>
