<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Disponibilidad Academica') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/jquery-ui.css" />
    <link rel="stylesheet" href="/css/bootstrap.css" />
    <link rel="stylesheet" href="/css/app.css" />
    <link rel="stylesheet" href="/css/estilo.css" />

    <style>
        #map-canvas  {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        #map-canvas {
            width:100%;
            height:400px;
        }
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!--<script
            src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous"></script>-->

</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
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
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b3/UNMSM_Escudo_y_Nombre_2.png/120px-UNMSM_Escudo_y_Nombre_2.png"  height="100%" style="display: inline"/>
                    <span style="font-size: 14px; font-weight: bold;">{{ config('app.name', 'Disponibilidad') }}</span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <!--<ul class="nav navbar-nav">
                    {{ getHostByName(getHostName()) }}
                </ul>-->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Iniciar sesion</a></li>

                        {{--<li><a href="{{ url('/register') }}">Registrarse</a></li>--}}

                    @else
                        @if(Auth::user()->hasRoleByName(['user','admin']))
                        <li><a href="{{ url('/dashboard') }}">Registrar visita</a></li>
                        @endif

                        @if(Auth::user()->hasRoleByName(['admin']))
                        <li><a href="{{ url('/users') }}">Usuarios</a></li>
                        @endif

                        @if(Auth::user()->hasRoleByName(['clerk','admin']))
                        <li><a href="{{ url('/visitas/') }}">Lista de visitas</a></li>
                        @endif

                        @if(Auth::user()->hasRoleByName(['user','admin']))
                        <li><a href="{{ url('/visitas/me') }}">Mis visitas</a></li>
                        @endif



                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Cerrar sesion
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
    <div id="wrap">
    @yield('content')
    </div>
    <footer class="footer">
        <div class="container-footer">
            <div class="row">
                <div class="col-md-12">
                    2019 - Calidad de Software - FISI.
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->


    <script type='text/javascript' src="/js/jquery-1.12.4.js"></script>
    <script type='text/javascript' src="/js/bootstrap.js"></script>

    <script type='text/javascript' src="/js/jquery-ui.js"></script>
    <script type='text/javascript' src="/js/moment-with-locales.js"></script>

    <script type='text/javascript' src="/js/jquery.validate.js"></script>
    <script type='text/javascript' src="/js/additional-methods.js"></script>

    <script type="text/javascript">
        jQuery.extend(jQuery.validator.messages, {
            required: "Este campo es necesario.",
            remote: "Mejora este campo.",
            email: "Ingresa un email correcto.",
            url: "Ingresa un URL valido.",
            date: "Ingresar un fecha adecuada",
            dateISO: "Ingresar un fecha adecuada (ISO).",
            number: "Ingresa un numero valido.",
            digits: "Ingresa solo digitos.",
            creditcard: "Ingresa un numero de credito correcto.",
            equalTo: "Ingresa los mismos valores.",
            accept: "Ingresa un valor valida.",
            maxlength: jQuery.validator.format("Ingresa como maximo {0} caracteres."),
            minlength: jQuery.validator.format("Ingresa como minimo {0} caracteres."),
            rangelength: jQuery.validator.format("Ingresa un valor entre {0} y {1} caracteres."),
            range: jQuery.validator.format("Ingresa un valor entre {0} y {1}."),
            max: jQuery.validator.format("Ingresa un valor menor a {0}."),
            min: jQuery.validator.format("Ingresa un valor mayor a {0}.")
        });
    </script>
    <!-- <script src="/js/app.js"></script> -->

    @yield('js')
    @if( getHostByName(getHostName()) !== "127.0.1.1")

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-90103628-1', 'auto');
        ga('send', 'pageview');

    </script>

    <!-- Start of StatCounter Code for Dreamweaver -->
    <script type="text/javascript">
        var sc_project=11215030;
        var sc_invisible=1;
        var sc_security="4fd03f83";
        var scJsHost = (("https:" == document.location.protocol) ?
            "https://secure." : "http://www.");
        document.write("<sc"+"ript type='text/javascript' src='" +
            scJsHost+
            "statcounter.com/counter/counter.js'></"+"script>");
    </script>
    <noscript><div class="statcounter">
            <a title="web analytics" href="http://statcounter.com/" target="_blank">
                <img class="statcounter"
                     src="//c.statcounter.com/11215030/0/4fd03f83/1/" alt="web analytics">
            </a></div>
    </noscript>
    <!-- End of StatCounter Code for Dreamweaver -->
    @endif

</body>
</html>
