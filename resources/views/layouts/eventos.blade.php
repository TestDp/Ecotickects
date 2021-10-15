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
	
		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '209280301173565');
		fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=209280301173565&ev=PageView&noscript=1"
		/></noscript>
<!-- End Facebook Pixel Code -->
	
		<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

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
	<link rel="stylesheet" type="text/css" href="{{ asset('css/cardio.css') }}">
	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{asset('js/Plugins/data-table/datatables.css')}}" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{ asset('css/EventosEco/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('css/EventosEco/icomoon.css') }}">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="{{ asset('css/EventosEco/themify-icons.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{ asset('css/EventosEco/bootstrap.css') }}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{ asset('css/EventosEco/magnific-popup.css') }}">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="{{ asset('css/EventosEco/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/EventosEco/owl.theme.default.min.css') }}">

	<!-- Theme style  -->
	<link rel="stylesheet" href="{{ asset('css/EventosEco/style.css') }}">

	<!-- Modernizr JS -->
	<script src="{{ asset('js/EventosEco/modernizr-2.6.2.min.js') }}"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div id="capa_loading" class="capa_loading" style="display:none;">Procesando...</div>
<div id="_loading" class="_loading" style="display:none;">
	<img class="img_loading" src="{{ asset('img/loader.gif') }}" />

	<br>
	<br>
</div>
<div class="preloader">
	<img src="{{ asset('img/loader.gif') }}" alt="Preloader image">
</div>
<nav style="top: 0px !important; margin-bottom: 0px !important;" class="navbar navbar-default navbar-static-top">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/logo-active-negro.png') }}" data-active-url="{{ asset('img/logo-active-negro.png') }}" alt=""></a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right main-nav">
				<!-- Authentication Links -->
				@guest
					<li><a href="{{ route('login') }}" class="btn btn-blue">Inicio de Sesión</a></li>
				<!--   <li><a href="{{ route('register') }}">Registrarse</a></li>-->
				@else
					<li><a href="{{ url('/home') }}">Home</a></li>
				@endguest
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>


<section id="eco" class="section">
	<div class="container">
		@yield('content')
	</div>
	<!-- boton soporte -->
	<ul style="display:none;" id="boton-soporte">
		<li><a href="https://api.whatsapp.com/send?phone=573117234163&text=Escribo%20desde%20Ecotickets..." target="_blank"><img src="{{ asset('img/soporte.png') }}" alt="" /></a></li>
	</ul>
</section>
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
<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/typewriter.js')}}"></script>
<script src="{{asset('js/jquery.onepagenav.js') }}"></script>
<script src="{{asset('js/main.js') }}"></script>
<script src="{{asset('js/Plugins/jqueryValidate/jquery.validate.js')}}"></script>

<!-- jQuery Easing -->
<script src="{{ asset('js/EventosEco/jquery.easing.1.3.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('js/EventosEco/bootstrap.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('js/EventosEco/jquery.waypoints.min.js') }}"></script>
<!-- Carousel -->
<script src="{{ asset('js/EventosEco/owl.carousel.min.js') }}"></script>
<!-- countTo -->
<script src="{{ asset('js/EventosEco/jquery.countTo.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('js/EventosEco/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/EventosEco/magnific-popup-options.js') }}"></script>
<!-- Main -->
<script src="{{ asset('js/EventosEco/main.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



</body>
</html>
