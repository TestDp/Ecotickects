<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ECOTICKETS | DPSOLUCIONES</title>
	<!-- CSRF Token -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<!-- Favicons (created with http://realfavicongenerator.net/)-->
	<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicons/favicon.png') }}">
	<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicons/favicon.png') }}">
	<link rel="icon" type="image/png" href="{{ asset('img/favicons/favicon.png') }}" sizes="32x32">
	<link rel="icon" type="image/png" href="{{ asset('img/favicons/favicon.png') }}" sizes="16x16">
	<link rel="manifest" href="{{ asset('img/favicons/manifest.json') }}">
	<link rel="shortcut icon" href="{{ asset('img/favicons/favicon.png') }}">
	<meta name="msapplication-TileColor" content="#00a8ff">
	<meta name="msapplication-config" content="{{ asset('img/favicons/browserconfig.xml') }}">
	<meta name="theme-color" content="#ffffff">
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113476867-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-113476867-1');
</script>

	<!-- Normalize -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
	<!-- Owl -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/owl.css') }}">
	<!-- Animate.css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.1.0/css/font-awesome.min.css') }}">
	<!-- Elegant Icons -->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/eleganticons/et-icons.css') }}">
	<!-- Main style -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{asset('js/Plugins/data-table/datatables.css')}}" rel="stylesheet">
</head>
<body>



        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
									<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}" data-active-url="{{ asset('img/logo-active.png') }}" alt=""></a>
                </div>

                <ul class="list-unstyled components">
                    <p>{{ Auth::user()->name }}</p>
                    <li>
                        <a href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="active">
                        <a href="#">Mis Eventos</a>
                    </li>
                    <li>
                        <a href="#">Todos los eventos</a>
                    </li>
                    <li>
                        <a href="#">Todos los cupones</a>
                    </li>
					<li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar Sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span>Ocultar menú</span>
                            </button>
                        </div>

                        
                    </div>
                </nav>
					@yield('content')
            </div>
        </div>





        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
         </script>
    </body>
</html>
