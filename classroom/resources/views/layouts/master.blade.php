<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Css Style -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('lib/bootstrap/css/bootstrap.min.css')}}">

    <!-- owl_carousel -->
    <link rel="stylesheet" href="{{asset('lib/owl_carousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('lib/owl_carousel/assets/owl.theme.default.min.css')}}">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

    <!-- animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
</head>
<body id="dashboard">
<div id="app">
    <div class="wrapper">

        <!------------------------- Sidebar ------------------------->
        <nav id="sidebar" class="overflow-auto">
            <div class="sidebar-header text-center">
                <h5><i class="fas fa-book-open"></i> Classroom</h5>
            </div>

            <ul class="list-unstyled components">
                <li class="active list">
                    <a href="{{ route('control')}}"><i class="fa fa-home pr-2"></i> Home</a>
                </li>
                <li class="list">
                    <a href="{{ route('profile.show', ['id' => Auth::user()->id]) }}"><i class="fas fa-portrait pr-2"></i> Profile</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown ">
                        <i class="fas fa-book pr-2"></i>My Classroom</a>

                    <ul class="collapse list-unstyled" id="pageSubmenu">

                        @foreach (Auth::user()->classroom as $item)
                            <li>
                            <a href="{{ route('classroom.show', ['id' => $item->cls_id]) }}">{{$item->cls_name}}</a>
                            </li>
                        @endforeach

                    </ul>
                </li>
                <li class="list">
                    <a href="{{ route('chat') }}"><i class="fas fa-user-friends"></i> Paring</a>
                </li>

                <li class="list">
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt pr-2"></i> {{ __('Logout') }}</a>
                </li>
            </ul>
        </nav>

        <div id="content">
            <!------------------------- Navbar ------------------------->
            <nav class="navbar navbar-expand-lg sticky-top">
                <div class="container-fluid">

                    <div id="sidebarCollapse" class="d-none d-lg-block">
                        <div class="iconbar">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <a class="navbar-brand pl-2 font-weight-bold" href="{{ route('control')}}">My Classroom</a>

                    <div class="row  d-xl-none d-lg-none">
                        <div class="col">
                                @if(Auth::user()->profile->prf_img)
                                    <img src="{{asset('storage')}}/{{Auth::user()->profile->prf_img}}" class="avatar" alt="Avatar">
                                @else
                                    <img src="{{asset('images/user.jpg')}}" class="avatar" alt="Avatar">
                                @endif
                        </div>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">

                            @yield('nav')

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-avatar" href="#" role="button" id="navbarDropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if(Auth::user()->profile->prf_img)
                                    <img src="{{asset('storage')}}/{{Auth::user()->profile->prf_img}}" class="avatar" alt="Avatar">
                                    @else
                                    <img src="{{asset('images/user.jpg')}}" class="avatar" alt="Avatar">
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-right animate slideIn border-0 shadow w-100 mt-2 bg-theme"
                                    aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href="#"><i class="fas fa-cog pr-2"></i> Setting</a> --}}
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt pr-2"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!------------------------- Content ------------------------->
            <div id="room" class="container-fluid mt-4 mb-4 pb-4">
                {{-- <img class="bg-dashboard" src="{{ asset('images/Rectangle/wave_2.svg')}}" alt=""> --}}
                @yield('content')
            </div>

            <!------------------------- Footer ------------------------->
            <footer class="p-3 d-none d-xl-block">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6">
                            <small> Anutchai Chutipascharoen © 2020. </small>
                        </div>
                        <div class="col-xl-6 text-right">
                            <small> Designed by Piyawat Loekthanom </small>
                        </div>
                    </div>
                </div>
            </footer>

            <!------------------------- Moblie-bar ------------------------->
            <div class="d-block d-lg-none moblie-bar p-2">
                <div class="container-fluid text-center">
                    @yield('mobile-bar')
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap core JavaScript -->
    {{-- <script src="{{asset('lib/jquery/jquery.min.js')}}"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="{{asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- owl_carousel core JavaScript -->
    <script src="{{asset('lib/owl_carousel/owl.carousel.min.js')}}"></script>

    <!-- Style core JavaScript -->
    <script src="{{asset('js/main.js')}}"></script>

    <!-- WOW -->
    <script src="{{asset('lib/wow/wow.min.js')}}"></script>
    <script>
        new WOW().init();
    </script>
</body>

</html>
