<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MovieTorrents') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <!-- Select2 css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <!-- Lightbox css -->
    <link rel="stylesheet" href="/css/lightbox.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/errors.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div class="wrapper">
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            mOvIeToRrEnTs
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ url('/login') }}">Login</a></li>
                                <li><a href="{{ url('/register') }}">Register</a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        <img style="width:40px;height:40px;border-radius: 50%" src="/images/users/{{Auth::user()->profile_picture}}" alt="">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{route('getProfile',['user_id'=>Auth::id()])}}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                                        @foreach(Auth::user()->roles as $role)
                                            @if($role)
                                                <li><a href="{{route('getUsers')}}"><i class="fa fa-users" aria-hidden="true"></i> Users</a></li>
                                                <li><a href="{{route('getMovies')}}"><i class="fa fa-film" aria-hidden="true"></i> Movies</a></li>
                                                <li><a href="{{route('getActors')}}"><i class="fa fa-user-circle" aria-hidden="true"></i> Actors</a></li>
                                                <li><a href="{{route('getGenres')}}"><i class="fa fa-video-camera" aria-hidden="true"></i> Genres</a></li>
                                            @endif
                                        @endforeach
                                        <li>
                                            <a href="{{ url('/logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="fa fa-lg fa-sign-out" aria-hidden="true"></i>Logout
                                            </a>

                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            @include('/errors/errorsinfo')
            @yield('content')
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="footer text-center">
                <p>&copy; MovieTorrents {{date('Y')}}.</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="https://use.fontawesome.com/31274ff3ad.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Select2 js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- lightbox -->
    <script src="/js/lightbox.min.js"></script>
    <script src="/js/scripts.js"></script>
    @yield('script')
</body>
</html>
