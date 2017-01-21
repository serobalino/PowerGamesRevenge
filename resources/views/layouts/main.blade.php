<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="icon"        href="favicon.ico">
    <link rel="stylesheet"  href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet"  href="css/materialize.min.css" type="text/css" media="screen,projection"/>
    <link rel="stylesheet"  href="css/estilos.css" type="text/css" media="screen,projection"/>
@yield('css')


<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Bienvenid@</h4>

        <div class="row">
            <p class="red-text">
                A la primera aplicación pensada en Gammers, publica un estado para que tus amigos lo vean o crea un evento o grupo para quedar de acuerdo con tu grupo de amigos.
            </p>
        </div>
    </div>
</div>
<nav>
    <div class="nav-wrapper" role="navigation">
        <a href="{{ url('/') }}" class="brand-logo">  {{ config('app.name', 'Laravel') }}</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{ url('/eventos') }}" class=" waves-ligh">Eventos</a></li>
            <li><a href="{{ url('/grupos') }}" class=" waves-ligh">Grupos</a></li>
            <li><a href="#amigos" data-activates="slide-out" class="menuamigos waves-ligh">Amigos</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="{{ url('/eventos') }}">Eventos</a></li>
            <li><a href="{{ url('/grupos') }}">Grupos</a></li>
            <li><a href="#amigos" data-activates="slide-out" class="menuamigos">Amigos</a></li>
        </ul>
    </div>
</nav>
<ul id="slide-out" class="side-nav">
    <li><div class="userView">
            <div class="background">
                <img src="http://lorempixel.com/600/600/abstract/">
            </div>
            <a href="#!user"><img class="circle" src="http://lorempixel.com/100/100/people/"></a>
            <a href="#!name"><span class="white-text name">{{Auth::user()->name}}</span></a>
        </div></li>
    <li><a class='dropdown-button' href='#' data-activates='dropdown1'>Estado</a></li>
    <ul id='dropdown1' class='dropdown-content'>
        @if (Auth::guest())
            <li><a href="{{ url('/register') }}">Registrar</a></li>
        @else
            <li class="dropdown">

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Salir
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endif

    </ul>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Conectados</a></li>
    <ul class="collection">
        <li class="collection-item avatar">
            <img src="http://lorempixel.com/100/100/people/2" alt="" class="circle">
            <span class="title">Andreita</span>
            <a class="secondary-content"><i class="material-icons circle green"></i></a>
        </li>
        <li class="collection-item avatar">
            <img src="http://lorempixel.com/100/100/people/2" alt="" class="circle">
            <span class="title">Sebas</span>
            <a class="secondary-content"><i class="material-icons circle red"></i></a>
        </li>
        <li class="collection-item avatar">
            <img src="http://lorempixel.com/100/100/people/2" alt="" class="circle">
            <span class="title">Ricardo</span>
            <a class="secondary-content"><i class="material-icons circle gray"></i></a>
        </li>
    </ul>

    <li><a class="subheader">Jugando</a></li>
    <li><div class="divider"></div></li>
    <ul class="collection">
        <li class="collection-item avatar">
            <img src="http://lorempixel.com/100/100/people/2" alt="" class="circle">
            <span class="title">Andreita</span>
            <a class="secondary-content"><i class="material-icons circle yellow"></i></a>
        </li>
        <li class="collection-item avatar">
            <img src="http://lorempixel.com/100/100/people/2" alt="" class="circle">
            <span class="title">Sebas</span>
            <a class="secondary-content"><i class="material-icons circle yellow"></i></a>
        </li>
        <li class="collection-item avatar">
            <img src="http://lorempixel.com/100/100/people/2" alt="" class="circle">
            <span class="title">Ricardo</span>
            <a class="secondary-content"><i class="material-icons circle yellow"></i></a>
        </li>
    </ul>
</ul>
    <!-- Carousel -->
    <div id="index-banner" class="parallax-container">
        <div class="section car-index">
            <div class="valign-wrapper">
                <div class="carousel carousel-slider">
                    <div class="carousel-fixed-item ">
                        <div class="caption center-align">
                            <h3 class="valign">Games</h3>
                        </div>
                    </div>
                    <a class="carousel-item" href="#one!"><img src="http://lorempixel.com/1900/600/technics/1"></a>
                    <a class="carousel-item" href="#two!"><img src="http://lorempixel.com/1900/600/technics/2"></a>
                    <a class="carousel-item" href="#three!"><img src="http://lorempixel.com/1900/600/technics/3"></a>
                    <a class="carousel-item" href="#four!"><img src="http://lorempixel.com/1900/600/technics/4"></a>
                </div>
            </div>
        </div>
    </div>
<div class="row">
    <div class="section">
        <div class="col s3 hide-on-med-and-down">
            @yield('c1')
        </div>
        <div class="col s12 m6">
            @yield('c2')
        </div>
        <div class="col s3 hide-on-med-and-down">
            @yield('c3')
        </div>
    </div>
</div>

<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Ingenieria En Sistemas</h5>
                <p class="grey-text text-lighten-4">Nuevas Técnicas de Programación</p>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Integrantes</h5>
                <ul>
                    <li><a class="white-text" href="#!">Andrea Cañizares</a></li>
                    <li><a class="white-text" href="#!">Ricardo Gonzales</a></li>
                    <li><a class="white-text" href="#!">Sebastian Robalino</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <a class="brown-text text-lighten-3" href="http://www.puce.edu.ec">PUCE</a>
        </div>
    </div>
</footer>
<!-- Scripts -->
<script src='js/jquery.min.js'></script>
<script src='js/materialize.min.js'></script>
@yield('js')
</body>
</html>
