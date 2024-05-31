<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> JustBool </title>

    <link rel="icon" href="{{Vite::asset('resources/img/jb2.svg')}}" type="logo">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>


<body>

    <div id="app">

        <div class="wrapper">

            <!--navbar start-->
            <div class="justbool-nav shadow p-2  bg-body-tertiary rounded">
                <!--container start-->
                <div class="container d-flex justify-content-between align-items-center">

                    <!--sidenav start-->
                    <div class="d-flex gap-4 align-items-center py-3">
                        <a class="text-decoration-none"><img src="{{Vite::asset('resources/img/jb2.svg')}}" style="width:150px;" alt="logo"></a>
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

                            <a href="{{route('admin.dishes.index')}}" class="nav-link link-no-active">
                                <div class="d-flex gap-4 ps-3 align-items-center link" id="menu-link">
                                    <i class="fa-solid fa-utensils fs-3"></i>
                                    Il tuo menù
                                </div>
                            </a>

                            <a href="{{route('admin.orders.index')}}" class="nav-link link-no-active">
                                <div class="d-flex gap-4 ps-3 align-items-center link" id="order-link">
                                    <i class="fa-solid fa-money-check-dollar fs-3"></i>
                                    I tuoi ordini
                                </div>
                            </a>

                            <a href="{{route('admin.')}}" class="nav-link link-no-active">
                                <div class="d-flex gap-4 ps-3 align-items-center link" id="stats-link">
                                    <i class="fa-solid fa-chart-simple fs-3"></i>
                                    Statistiche
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
                            <div class="d-flex gap-4 auth-links ">
                                <li class="nav-item d-none d-lg-inline-block">
                                    <a class="nav-link fs-5" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item d-none d-lg-inline-block">
                                    <a class="nav-link fs-5" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            </div>

                            <!-- dropdown responsive -->
                            <div class="auth-dropdown dropdown d-lg-none d-md-inline-block">
                                <button type="button" class="btn drop-menu dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-bars text-white"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('Accedi') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('Registrati') }}</a></li>
                                </ul>
                            </div>
                            @endif

                            @else
                            <li class="nav-item dropdown d-none d-lg-block">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name === null ? 'Ristoratore' : Auth::user()->name}}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('admin') }}">{{__('Dashboard')}}</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit(); resetActiveLink();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            <!-- dropdown responsive -->
                            <div class="auth-dropdown dropdown d-lg-none d-md-inline-block">
                                <button type="button" class="btn drop-menu dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-bars text-white"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ url('admin') }}">{{__('Dashboard')}}</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit(); resetActiveLink();">{{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            @endguest
                        </ul>

                    </div>
                    <!--my dropdown end-->

                </div>
                <!--container end-->

            </div>
            <!--navbar end-->



            <main class="position-relative">
                @yield('content')
            </main>

            <footer>

                <div class="top-footer"></div>

                <div class="bottom-footer">

                    <div class="container">

                        <div class="row">
            
                            <div class="title-icons-container col-12 d-flex justify-content-between py-0 py-md-4 py-lg-0">
                                <div class=" d-flex align-items-center gap-3">

                                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                                    <a href=""><i class="fa-brands fa-facebook"></i></a>
                                    <a href=""><i class="fa-brands fa-x-twitter"></i></a>

                                </div>
                                <div class="contact-info d-flex flex-column text-dark">

                                    <div class="centered-info">
                                        <strong class="title-footer">Numero verde:</strong>
                                        <a href="tel:899166177678">899-166-177-678</a>

                                    </div>
                                    <div class="centered-info">
                                        <strong class="title-footer">Email assistenza:</strong>
                                        <a href="mailto:help@justbool.com">help@justbool.com</a>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </footer>

        </div>
    </div>
</body>

<style>

/* Media query per FOOTER */
@media (max-width: 599px) {
    .title-icons-container {
        align-items: center;
        flex-direction: column;
    }

    .title-icons-container {
        margin-bottom: 10px;
        display: flex;
        align-items: center;

        i {

            font-size: 10px;
        
        }

        .contact-info {

            .centered-info {
                text-align: center;
                font-size: 12px;
            }
            
        }

    }
    
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const links = document.querySelectorAll('.link:not(.link-no-active)');

        links.forEach(function(link) {
            link.addEventListener('click', function() {
                console.log('Link cliccato:', this.id);
                localStorage.setItem('activeLinkId', this.id);
                setActiveLink(this);
            });
        });

        const activeLinkId = localStorage.getItem('activeLinkId');
        console.log('ID attivo salvato:', activeLinkId);
        if (activeLinkId) {
            const activeLink = document.getElementById(activeLinkId);
            if (activeLink) {
                setActiveLink(activeLink);
            }
        }
    });

    function setActiveLink(activeLink) {
        console.log('Impostazione link attivo:', activeLink.id);
        const links = document.querySelectorAll('.link:not(.link-no-active)');
        links.forEach(function(link) {
            link.classList.remove('active');
        });
        activeLink.classList.add('active');
    }

    function resetActiveLink() {
        if (window.location.pathname !== '/admin') {
            console.log("Current page is not the dashboard. Setting active link to dashboard...");
            const dashboardLink = document.getElementById('dashboard-link');
            if (dashboardLink) {
                setActiveLink(dashboardLink);
            }
        }
        localStorage.removeItem('activeLinkId');

    }
</script>

</html>