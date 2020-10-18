<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'What the hack') }}</title>


    <!-- Scripts
    <script src="{{ asset('js/app.js') }}" defer></script> -->
    <!-- Original laravel scripts
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

    <!-- MDB Scripts -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ URL::asset('js/mdb.min.js') }}"></script>
    <!-- Template JavaScript-->
    <script type="text/javascript" src ="{{ URL::asset('js/freelancer.min.js') }}"></script>
    <!-- DataTables addon -->
    <script type="text/javascript" src="{{ URL::asset('js/addons/datatables.min.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ URL::asset('js/addons/datatables-select.min.js') }}"></script> -->
    <script src="{{ asset('js/actions.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/shuffle.js') }}"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/mdb.min.css') }}">
    <!-- Template CSS file -->
    <link rel="stylesheet" href="{{ URL::asset('css/addons/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <!-- CSS file for customization -->
    <link rel="stylesheet" href="{{ URL::asset('css/custom-styles.css') }}">
    <!-- <link rel="stylesheet" href="{{ URL::asset('css/addons/datatables-select.min.css') }}"> -->
    <link rel="icon" href="{{ URL::asset('/images/icons/favicon.svg') }}" type="image/x-icon"/>
</head>
<body>
<div class="root">
    <div class="flyout">
        <nav data-test="navbar" class="navbar-dark elegant-color navbar navbar-expand-md fixed-top" role="navigation">
            <div class="container nav-container">

                <button type="button" id="sidebarCollapse" class="navbar-toggle">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div data-test="navbar-brand" class="navbar-brand">
                    <strong class="white-text">
                        <a href="/">
                            <span id="logo_v4">hack?</span>
                            <!-- <img src="{{URL::asset('images/pics/logo_v4.gif')}}" width="110px" href="/"> -->
                        </a>
                    </strong>
                </div>
                <div data-test="collapse" id="navbarCollapse3" class="collapse navbar-collapse">

                    <ul data-test="navbar-nav" class="navbar-nav ml-auto">
                        @if(Auth::user())
                            <a class="green-text dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a class="green-text dropdown-item" href="{{ route('main') }}">
                                {{ __('Login') }}
                            </a>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main id="landing">
            <br>
            @yield('content')
            <br>
        </main>
        <!-- Sidebar -->
        <nav id="sidebar" style="position: fixed">
            <div id="dismiss">
                <i class="fas fa-times"></i>
            </div>

                <div class="sidebar-header">
                    <h4>WhatTheHack</h4>
                </div>

                <ul class="list-unstyled components">
                    <!-- ACCOUNT -->
                    <li>
                        <a href="#accountSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            @if (Auth::user())
                                {{ Auth::user()->username }} <span class="caret"></span>
                            @else
                                Account
                            @endif
                        </a>
                        <ul class="collapse list-unstyled" id="accountSubmenu">
                                @if (Auth::user())
                                <li>
                                    <a href="{{ route('profile.show') }}">Profile</a>
                                </li>
                                <li>
                                <a  href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('main') }}">{{ __('Login') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>

                    <!-- My Classrooms -->
                    @if(Auth::user())
                        @if(Auth::user()->hasRole("student"))
                            <li>
                                <a href="/classrooms/myClassrooms">My Classrooms</a>
                            </li>
                        @endif
                    @endif

            <!-- ADMIN VIEW -->
                @if (Auth::user())
                    @if(Auth::user()->hasRole("admin"))
                        <li>
                            <a href="#challengeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Challenges</a>
                            <ul class="collapse list-unstyled" id="challengeSubmenu">
                                <li>
                                    <a href="{{route('challenges.index')}}">Show Challenges</a>
                                </li>
                                <li>
                                    <a href="{{route('challenges.create')}}">Create Challenge</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#classroomSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Classroom</a>
                            <ul class="collapse list-unstyled" id="classroomSubmenu">
                                <li>
                                    <a href="{{route('classroom.index')}}">Classroom Management</a>
                                </li>
                                <li>
                                    <a href="{{route('classroom.create')}}">Create Classroom</a>
                                </li>
                                <li>
                                    <a href="{{ route('classroom.disabled') }}">Disabled Classrooms</a>
                                </li>
                                <li>
                                    <a href="{{ route('classroom.myClassrooms') }}">My Classrooms</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('manageuser.index')}}">User Management</a>
                        </li>
                    @else
                    @endif
                    @if(Auth::user()->hasRole("teacher"))
                        <li>
                            <a href="#challengeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Challenges</a>
                            <ul class="collapse list-unstyled" id="challengeSubmenu">
                                <li>
                                    <a href="{{route('challenges.index')}}">All challenges</a>
                                </li>
                                <li>
                                    <a href="{{route('challenges.create')}}">Create Challenge</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#classroomSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Classroom</a>
                            <ul class="collapse list-unstyled" id="classroomSubmenu">
                                <li>
                                    <a href="{{ route('classroom.index') }}">Show Classrooms</a>
                                </li>
                                <li>
                                    <a href="{{route('classroom.create')}}">Create Classroom</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                        <li>
                            <a href="#rankingSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Ranking</a>
                            <ul class="collapse list-unstyled" id="rankingSubmenu">
                                <li>
                                    <a href="{{route('ranking.index')}}">Global</a>
                                </li>
                                <li>
                                    <a href="{{route('ranking.classroom')}}">Classroom</a>
                                </li>
                            </ul>
                        </li>
                @endif
                <li>
                    <a href="#aboutSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">About</a>
                    <ul class="collapse list-unstyled" id="aboutSubmenu">
                        <li>
                            <a href="{{ route('tos') }}">Terms of use</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- Sidebar -->

    </div>

    <!-- Error Message -->
    @if($errors)
        @foreach ($errors->all() as $error)
            <div id="toast-alert-container" class="toast-top-center example">
                <div id="alert" class="toast-alert alert-danger hide" role="alert" data-delay="7000" data-autohide="true" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header-alert">
                        <i class="fas fa-2x fa-exclamation-circle mr-2"></i>

                        <strong class="mr-auto">Error</strong>

                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        {{ $error }}
                    </div>
                </div>
            </div>
        @endforeach
    @endif

<!-- Success Message -->
    @if (session()->has('success'))
        <div id="toast-alert-container" class="toast-top-center example">
            <div id="success" class="toast-alert alert-success hide" role="alert" data-delay="5000" data-autohide="true" aria-live="assertive" aria-atomic="true">
                <div class="toast-header-alert">
                    <i class="far fa-2x fa-thumbs-up mr-2"></i>

                    <strong class="mr-auto">Success</strong>

                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    {{ session()->get('success') }}
                </div>
            </div>
        </div>
    @endif

    <footer data-test="footer" class="page-footer elegant-color">
        <div data-test="container" class="container text-center py-3"><a href="/tos">Terms of use</a></div>
        <div class="footer-copyright text-center py-3">
            <div data-test="container" class="container-fluid">© 2020 Copyright: WhatTheHack? Development Team
            </div>
        </div>
    </footer>
</div>
</body>
</html>
