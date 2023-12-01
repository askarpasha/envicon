<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .sidebar {
            background-color: #f8f9fa; /* Light grey background */
            border-right: 1px solid #dee2e6; /* Add a border to the right */
        }
        .sidebar .nav-link {
            color: #333; /* Darker text for better readability */
        }
        .sidebar .nav-link:hover {
            background-color: #e9ecef; /* Light grey background on hover */
            border-radius: 0.25rem; /* Slight rounding on hover */
        }
        .sidebar .nav-link.active {
            color: #007bff; /* Bootstrap primary color for active state */
            font-weight: bold; /* Make active link bold */
        }
    </style>
    
</head>

<body>


    <div id="app">
        <!-- Existing Navbar Here -->

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Envicon - Test') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                @auth
                @if (auth()->user()->is_admin == 1)
                

                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="#">
                                    <span data-feather="home"></span>
                                    Dashboard
                                </a>
                            </li>
                            <!-- Repeat for other items -->
                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('add-user') ? 'active' : '' }}" href="{{ route('add-user') }}">
                                    <span data-feather="users"></span>
                                    Add Users
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('user-listing') ? 'active' : '' }}" href="{{ route('user-listing') }}">
                                    <span data-feather="userlisting"></span>
                                    User Listing
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('category-listing') ? 'active' : '' }}" href="{{ route('category-listing') }}">
                                    <span data-feather="productcat"></span>
                                    Products Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('products.create') ? 'active' : '' }}" href="{{ route('products.create') }}">
                                    <span data-feather="addprod"></span>
                                    Add Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">

                                    <span data-feather="products"></span>
                                    Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('stocks.index') ? 'active' : '' }}" href="{{ route('stocks.index') }}">

                                    <span data-feather="stocks"></span>
                                    Stocks
                                </a>
                            </li>
                            <!-- ... other items ... -->
                        </ul>
                    </div>
                </nav>

                @endif
                @endauth

                <!-- Main Content -->
                <main role="main" class="col-md-8 ml-sm-auto col-lg-8 p-5">

                    @yield('content')
                </main>
            </div>
        </div>
    </div>

</body>

</html>