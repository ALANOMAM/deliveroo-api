<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <!--navbar start-->
        <div class="  shadow p-2  bg-body-tertiary rounded">
            <!--container start-->
            <div class="container d-flex justify-content-between align-items-center">

                <!--sidenav start-->
                <div class="d-flex gap-4 align-items-center py-3">
                    <a class="text-decoration-none"><img src="{{Vite::asset('resources/img/jb2.svg')}}" style="width:200px;" alt="logo"></a>
                    @auth
                    <div data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions" class=" mt-1 menu fs-5">
                        Menu
                    </div>
                    @endauth
                </div>



                <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header">
                        <div class="nav-logo mt-4 ms-4">
                            <a class="offcanvas-title" id="offcanvasWithBothOptionsLabel"><img src="{{Vite::asset('resources/img/jbadmin.svg')}}" alt="logo"></a>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <!--link sidenav-->

                    <div class="offcanvas-body d-flex flex-column gap-4 px-5 mt-5">
                        <a class="nav-link" href="{{url('admin') }}">
                            <div class="d-flex gap-4 ps-3 my-3 align-items-center link active" id="dashboard-link">
                                <i class="fa-solid fa-house fs-3"></i>
                                {{ __('Dashboard') }}
                            </div>
                        </a>

                        <a href="{{route('admin.dishes.index')}}" class="nav-link">
                            <div class="d-flex gap-4 ps-3 align-items-center link" id="menu-link">
                                <i class="fa-solid fa-utensils fs-3"></i>
                                Il tuo menù
                            </div>
                        </a>
                    </div>

                </div>
                <!--sidenav end--->



                <!--my dropdowm start-->
                <div class="dropdown">
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <div class="d-flex gap-4">
                            <li class="nav-item">
                                <a class="nav-link fs-5" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link fs-5" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                            </li>
                        </div>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('admin') }}">{{__('Dashboard')}}</a>
                                <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a>
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
                <!--my dropdown end-->

            </div>
            <!--container end-->

        </div>
        <!--navbar end-->



        <main class="">
            @yield('content')
        </main>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const links = document.querySelectorAll('.link');

        const setActiveLink = (activeLink) => {
            links.forEach(function(link) {
                link.classList.remove('active');
            });
            activeLink.classList.add('active');
        };

        links.forEach(function(link) {
            link.addEventListener('click', function() {
                localStorage.setItem('activeLinkId', this.id);
                setActiveLink(this);
            });
        });

        const activeLinkId = localStorage.getItem('activeLinkId');
        if (activeLinkId) {
            const activeLink = document.getElementById(activeLinkId);
            if (activeLink) {
                setActiveLink(activeLink);
            }
        }
    });
</script>

</html>