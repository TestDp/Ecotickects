<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ECOTICKETS | DPSOLUCIONES</title>
	<meta name="description" content="" />
	<meta name="keywords" content="html template, css, free, one page, gym, fitness, web design" />
	<meta name="author" content="Luka Cvetinovic for Codrops" />
	<!-- Favicons (created with http://realfavicongenerator.net/)-->
	<link rel="apple-touch-icon" sizes="57x57" href="img/favicons/favicon.png">
	<link rel="apple-touch-icon" sizes="60x60" href="img/favicons/favicon.png">
	<link rel="icon" type="image/png" href="img/favicons/favicon.png" sizes="32x32">
	<link rel="icon" type="image/png" href="img/favicons/favicon.png" sizes="16x16">
	<link rel="manifest" href="img/favicons/manifest.json">
	<link rel="shortcut icon" href="img/favicons/favicon.png">
	<meta name="msapplication-TileColor" content="#00a8ff">
	<meta name="msapplication-config" content="img/favicons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<!-- Normalize -->
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<!-- Owl -->
	<link rel="stylesheet" type="text/css" href="css/owl.css">
	<!-- Animate.css -->
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.1.0/css/font-awesome.min.css">
	<!-- Elegant Icons -->
	<link rel="stylesheet" type="text/css" href="fonts/eleganticons/et-icons.css">
	<!-- Main style -->
	<link rel="stylesheet" type="text/css" href="css/cardio.css">
</head>

<body>
	<div class="preloader">
		<img src="img/loader.gif" alt="Preloader image">
	</div>
	<nav style="position:absolute !important;" class="navbar">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="img/logo.png" data-active-url="img/logo-active.png" alt=""></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			@if (Route::has('login'))
				<ul class="nav navbar-nav navbar-right main-nav">
					@auth
                        <li><a href="{{ url('/home') }}">Home</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                     <!--<li><a href="{{ route('register') }}">Registrarse</a></li>-->
                    @endauth
				</ul>
			@endif
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	<header id="intro">
		<div class="container">
			<div class="table">
				<div class="header-text">
					<div class="row">
						<div class="col-md-12 text-center">
							<h3 class="light black">Desarrollado por DPSoluciones.</h3>
							<h1 class="black typed">Una forma simple de proteger el planeta.</h1>
							<span class="typed-cursor">|</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
<section>
		<div class="cut cut-top"></div>
		<div class="container">
			<div class="row intro-tables">
				<div class="col-md-6">
					<div class="intro-table intro-table-hover">
						<h3 class="white heading hide-hover">EVENTOS</h3>

					</div>
				</div>	
				<div class="col-md-6">
					<div class="intro-table intro-table-hover">
						<h3 class="white heading hide-hover">CUPONES</h3>

					</div>
				</div>
			</div>
		</div>
	</section>
	
	
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center-mobile">
					<h3 class="white">Crea tu cuenta y adquiere tu licencia anual!</h3>
					<h5 class="light regular light-white">Administración, gestión y estadísticas de tus eventos.</h5>
					<a href="http://dpsoluciones.co/nuestros-servicios/" target="_blank" class="btn btn-blue ripple trial-button">Ver más</a>
				</div>
			
			</div>
			<div class="row bottom-footer text-center-mobile">
				<div class="col-sm-8">
					<p>Todos los derechos reservados 2018. Desarrollado por <a href="http://www.dpsoluciones.co/" target="_blank">DPS</a></p>
				</div>
				<div class="col-sm-4 text-right text-center-mobile">
					<ul class="social-footer">
						<li><a href="https://web.facebook.com/dpsolucionesrionegro/?_rdc=1&_rdr" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://twitter.com/dpsolucionesrio" target="_blank"><i class="fa fa-twitter"></i></a></li>
						<li><a href="https://www.instagram.com/dpsolucionesrio/" target="_blank"><i class="fa fa-instagram"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!-- Holder for mobile navigation -->
	<div class="mobile-nav">
		<ul>
		</ul>
		<a href="#" class="close-link"><i class="arrow_up"></i></a>
	</div>
	<!-- Scripts -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/typewriter.js"></script>
	<script src="js/jquery.onepagenav.js"></script>
	<script src="js/main.js"></script>
</body>

</html>
