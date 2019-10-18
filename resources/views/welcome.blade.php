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
	
		<!-- Animate.css -->
	<link rel="stylesheet" href="css/EventosEco/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/EventosEco/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/EventosEco/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/EventosEco/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/EventosEco/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/EventosEco/owl.carousel.min.css">
	<link rel="stylesheet" href="css/EventosEco/owl.theme.default.min.css') }}">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/EventosEco/style.css">
	
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
				<a class="navbar-brand" href="#"><img style="height: auto !important;" src="img/logo.png" data-active-url="img/logo-active.png" alt=""></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			@if (Route::has('login'))
				<ul class="nav navbar-nav navbar-right main-nav">
				<!--<li><a  onclick="ActualizarEventosFecha()" href="#eventos" ><b>EVENTOS</b></a></li>-->
				<li><a href="#eventos"><b>Eventos</b></a></li>
				<li><a href="#eco"><b>¿Por qué Ecotickets?</b></a></li>
				<li><a href="#aliados"><b>#EstamosCuidandoElPlaneta</b></a></li>
				<li><a href="{{ url('/Cupones') }}"><b>Ecupones</b></a></li>
			@auth
                        <li><a href="{{ url('/home') }}">Home</a></li>
                    @else
                        <li><a style="padding: 17px 15px !important;" href="{{ route('login') }}" class="btn btn-blue">Iniciar Sesión</a></li>
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
							<h1 class="black typed">Una forma simple de proteger el planeta.</h1><span class="typed-cursor">|</span>
							<h3 class="light black">Administra tu evento sosteniblemente</h3>
							<a href="#" class="btn btn-blue ripple trial-button">PUBLICA TU EVENTO</a>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
<section style="padding-top:3%;" id="eventos">
	<div class="container">
		<div class="row text-center title">
			<h2 style="color:#74b12e; font-size: 28px; font-weight: 800;">#EllosCuidanElPlaneta</h2>
			<h4 class="light muted">Son nuestros aliados en el cuidado del medio ambiente.<span class="open-blink"></span></h4>
			<h2 style="color:#74b12e; font-size: 28px; font-weight: 800;">Destacados</h2>
		</div>
		<div class="gtco-section">
			<div class="gtco-container">
				<div class="row row-pb-md">
					<div class="col-md-12">
						<ul id="gtco-portfolio-list">

							@foreach($ListaEventosDestacados["eventosDestacados"] as $eventoDestacado)

								<li class="one-third animate-box" data-animate-effect="fadeIn">
									<div class="team text-center">
										<div class="cover" style="background:url('{{ $ListaEventosDestacados["rutaImagenes"].$eventoDestacado->FlyerEvento}}'); background-size:cover;">
											<div class="overlay text-center">
												@if($eventoDestacado->esPago)
													<h3 class="white"><a style="color:#fff !important;" href="{{url('FormularioAsistentePago', ['idEvento' => $eventoDestacado->id ])}}">{{ $eventoDestacado->Nombre_Evento }}</a></h3>
												@else
													<h3 class="white"><a style="color:#fff !important;" href="{{url('FormularioAsistente', ['idEvento' => $eventoDestacado->id ])}}">{{ $eventoDestacado->Nombre_Evento }}</a></h3>
												@endif
											</div>
										</div>
										<img src="img/logo.jpg" alt="Team Image" class="avatar">
										<div class="title">
											@if($eventoDestacado->esPago)
												<a href="{{url('FormularioAsistentePago', ['idEvento' => $eventoDestacado->id ])}}"><h4>{{ $eventoDestacado->Nombre_Evento }}</h4></a>
											@else
												<a href="{{url('FormularioAsistente', ['idEvento' => $eventoDestacado->id ])}}"><h4>{{ $eventoDestacado->Nombre_Evento }}</h4></a>
											@endif
											<h5 class="muted regular"><b>Fecha: </b>{{ $eventoDestacado->Fecha_Evento }}</h5>
											<h5 class="muted regular"><b>Lugar: </b>{{ $eventoDestacado->Lugar_Evento }}</h5>
											<h5 class="muted regular"><b>Ciudad: </b>{{ $eventoDestacado->ciudad->Nombre_Ciudad }}</h5>
											<h5 style="display:none;" class="muted regular"><b>Departamento: </b>{{ $eventoDestacado->ciudad->departamento->Nombre_Departamento }}</h5>

										</div>
										@if($eventoDestacado->esPago)
											<div class="add-to-cart"><button style="border: 1px #8abd51 solid; background-color:#8abd51; width:100%; border-radius: 25px;" class="add-to-cart-btn"><a style="color:#fff !important; font-weight:700;" href="{{url('FormularioAsistentePago', ['idEvento' => $eventoDestacado->id ])}}"><i class="fa fa-shopping-cart"></i> COMPRAR</a></button></div>
										@else
											<div class="add-to-cart"><button style="border: 1px #8abd51 solid; background-color:#8abd51; width:100%; border-radius: 25px;" class="add-to-cart-btn"><a style="color:#fff !important; font-weight:700;" href="{{url('FormularioAsistente', ['idEvento' => $eventoDestacado->id ])}}"><i class="fa fa-list"></i> REGÍSTRATE</a></button></div>
										@endif
										@if($eventoDestacado->activarTienda ==1)
											<a href="{{url('Tienda', ['idEvento' => $eventoDestacado->id ])}}"><h5 style="border: 1px #8abd51 solid; background-color:#8abd51; padding: 3%;">Tienda</h5></a>
										@endif
									</div>
								</li>
							@endforeach

						</ul>
					</div></div></div></div>

	</div>




	<div class="container">
			<div class="row text-center title">
				<h2 style="color:#74b12e; font-size: 28px; font-weight: 800;">Proximos Eventos</h2>
			</div>
		<div class="gtco-section">
		<div class="gtco-container">
			<div class="row row-pb-md">
				<div class="col-md-12">
					<ul id="gtco-portfolio-list">

						@foreach($ListaEventos["eventos"] as $evento)

					<li class="one-third animate-box" data-animate-effect="fadeIn">
						<div class="team text-center">
							<div class="cover" style="background:url('{{ $ListaEventos["rutaImagenes"].$evento->FlyerEvento}}'); background-size:cover;">
								<div class="overlay text-center">
									@if($evento->esPago)
										<h3 class="white"><a style="color:#fff !important;" href="{{url('FormularioAsistentePago', ['idEvento' => $evento->id ])}}">{{ $evento->Nombre_Evento }}</a></h3>
									@else
										<h3 class="white"><a style="color:#fff !important;" href="{{url('FormularioAsistente', ['idEvento' => $evento->id ])}}">{{ $evento->Nombre_Evento }}</a></h3>
									@endif
								</div>
							</div>
							<img src="img/logo.jpg" alt="Team Image" class="avatar">
							<div class="title">
								@if($evento->esPago)
									<a href="{{url('FormularioAsistentePago', ['idEvento' => $evento->id ])}}"><h4>{{ $evento->Nombre_Evento }}</h4></a>
								@else
									<a href="{{url('FormularioAsistente', ['idEvento' => $evento->id ])}}"><h4>{{ $evento->Nombre_Evento }}</h4></a>
								@endif
								<h5 class="muted regular"><b>Fecha: </b>{{ $evento->Fecha_Evento }}</h5>
								<h5 class="muted regular"><b>Lugar: </b>{{ $evento->Lugar_Evento }}</h5>
								<h5 class="muted regular"><b>Ciudad: </b>{{ $evento->ciudad->Nombre_Ciudad }}</h5>
								<h5 style="display:none;" class="muted regular"><b>Departamento: </b>{{ $evento->ciudad->departamento->Nombre_Departamento }}</h5>
												
							</div>						
								@if($evento->esPago)
									<div class="add-to-cart"><button style="border: 1px #8abd51 solid; background-color:#8abd51; width:100%; border-radius: 25px;" class="add-to-cart-btn"><a style="color:#fff !important; font-weight:700;" href="{{url('FormularioAsistentePago', ['idEvento' => $evento->id ])}}"><i class="fa fa-shopping-cart"></i> COMPRAR</a></button></div>
								@else
									<div class="add-to-cart"><button style="border: 1px #8abd51 solid; background-color:#8abd51; width:100%; border-radius: 25px;" class="add-to-cart-btn"><a style="color:#fff !important; font-weight:700;" href="{{url('FormularioAsistente', ['idEvento' => $evento->id ])}}"><i class="fa fa-list"></i> REGÍSTRATE</a></button></div>
								@endif
								@if($evento->activarTienda ==1)
									<a href="{{url('Tienda', ['idEvento' => $evento->id ])}}"><h5 style="border: 1px #8abd51 solid; background-color:#8abd51; padding: 3%;">Tienda</h5></a>
								@endif
						</div>
					</li>
						@endforeach

					</ul>
				</div></div></div></div>
				
				</div>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="Cssecupones/css/bootstrap.min.css">

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="Cssecupones/css/slick.css"/>
	<link type="text/css" rel="stylesheet" href="Cssecupones/css/slick-theme.css"/>

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="Cssecupones/css/nouislider.min.css"/>

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="Cssecupones/css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="Cssecupones/css/style.css"/>


	<link rel="manifest" href="img/favicons/manifest.json">
	<link rel="shortcut icon" href="img/favicons/favicon.png">
	<meta name="msapplication-TileColor" content="#00a8ff">
	<meta name="msapplication-config" content="img/favicons/browserconfig.xml">
    <!-- SECTION -->
    <div style="padding-bottom:5%;" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 style="color:#74b12e; font-size: 28px; font-weight: 800; text-align:center;">Ecupones | Sé feliz y cuida el medio ambiente</h2>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab1">Restaurantes</a></li>
                                <li><a data-toggle="tab" href="#tab1">Almacenes</a></li>
                                <li><a data-toggle="tab" href="#tab1">Tiendas</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <!-- product -->
									@foreach($ListaEcupones["cupones"] as $cupon)
										<div class="product">
											<div class="product-img">
												<img src={{ $ListaEcupones["rutaImagenes"].$cupon->FlyerEvento}}>
												<div class="product-label">
													<span class="sale">{{ $cupon->Nombre_Evento }}</span></br>
													<span class="new">Vence en: {{ $cupon->Plazo }} días</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">Comidas</p>
												<h3 class="product-name"><a href="#">{{ $cupon->Lugar_Evento }}</a></h3>
											</div>
											<div class="add-to-cart">
												@if($cupon->esPago)
													<button class="add-to-cart-btn"><a href="{{url('FormularioAsistentePago', ['idEvento' => $cupon->id ])}}"><i class="fa fa-shopping-cart"></i> Obtener cupón</a></button>
												@else
													<button class="add-to-cart-btn"><a href="{{url('FormularioAsistente', ['idEvento' => $cupon->id ])}}"><i class="fa fa-shopping-cart"></i> Obtener cupón</a></button>
												@endif
											</div>
										</div>
										<!-- /product -->
									@endforeach
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
	<a style="text-align:center; margin:0% 30% 2% 30%; display:block;" href="{{ url('/Cupones') }}" class="btn btn-blue ripple trial-button">VER MÁS CUPONES</a>
    <!-- /SECTION -->





	</section>
		<section id="eco" class="section">
				<div class="container">
			<div class="row text-center title">
				<h2 style="color:#ffffff; font-size: 28px; font-weight: 700; text-align:center;">Muchas facilidades al alcance de tus manos</h2>
				<h4 class="light muted">¿Y tus eventos ya se transformaron digitalmente?</h4>
			</div>
			<div class="row services">
				<div class="col-md-4">
					<div class="service">
						<div class="icon-holder">
							<img src="img/icons/heart-blue.png" alt="" class="icon">
						</div>
						<h4 class="heading">¿Quieres salvar el planeta?</h4>
						<p class="description">Comunícate con nosotros y te explicaremos el "porque" Ecotickets cuida el medio ambiente.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="service">
						<div class="icon-holder">
							<img src="img/icons/guru-blue.png" alt="" class="icon">
						</div>
						<h4 class="heading">¡Acceso ágil y fluido!</h4>
						<p class="description">Ecotickets APP te permite registrar y controlar el acceso a tus eventos de una forma fácil y rápida.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="service">
						<div class="icon-holder">
							<img src="img/icons/weight-blue.png" alt="" class="icon">
						</div>
						<h4 class="heading">¡En los datos está el poder!</h4>
						<p class="description">Controla todas las estadísticas de tus eventos. Toda la información a tu alcance en cualquier momento.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	
			<section id="aliados" class="section">
				<div class="container">
			<div class="row text-center title">
				<h2 style="color:#000000; font-size: 28px; font-weight: 800;">Ellos confían en nosotros</h2>
				<h4 class="light muted">#EstamosCuidandoElPlaneta</h4>
			</div>
			<div class="row">
				<div class="col-md-3">
					<img style="display:block; margin:auto;" width="50%" src="img/lovers.png"></img>
				</div>
				<div class="col-md-3">
				<img style="display:block; margin:auto;" width="50%" src="img/colasistencia.png"></img>
				</div>
				<div class="col-md-3">
				<img style="display:block; margin:auto;" width="50%" src="img/sena.png"></img>
				</div>
				<div class="col-md-3">
				<img style="display:block; margin:auto;" width="50%" src="img/ccoa.png"></img>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					
				</div>
				<div class="col-md-3">
				<img style="display:block; margin:auto;" width="50%" src="img/mute.png"></img>
				</div>
				<div class="col-md-3">
				<img style="display:block; margin:auto;" width="50%" src="img/asocomunal.png"></img>
				</div>
				<div class="col-md-3">
				
				</div>
			</div>				
			</div>	
					<!-- boton soporte -->
			<ul id="boton-soporte">
				<li><a href="https://api.whatsapp.com/send?phone=573117234163&text=Escribo%20desde%20Ecotickets..." target="_blank"><img src="img/soporte.png" alt="" /></a></li>
			</ul>
			</section>
	
	
	<footer id="contacto">
		<div class="container">
			<div class="row">
			<div class="col-sm-3 text-center-mobile">
			<img src="img/logo.png" data-active-url="img/logo-active.png" alt="" style="width:100%;">
			</div>
				<div class="col-sm-6 text-center-mobile">
					<h3 class="white">¡Comunícate con nosotros y salvemos el planeta!</h3>
					<h5 class="light regular light-white">Administración, gestión y estadísticas de tus eventos.</h5>
				</div>
			<div class="col-sm-3 text-center-mobile">
			<a href="http://dpsoluciones.co/" target="_blank" class="btn btn-white-fill">CONTÁCTANOS</a>
			</div>
			</div>
			<div class="row bottom-footer text-center-mobile">
				<div class="col-sm-3">
					<p style="color:#fff; text-align:center;">Una forma simple de proteger el planeta</p>
				</div>
				<div class="col-sm-6">
					<p style="color:#fff; text-align:center;">Desarrollado por <a href="http://www.dpsoluciones.co/" target="_blank"><img src="https://dpsoluciones.co/logoDPS.png"></a></p>
				</div>
				<div class="col-sm-3 text-right text-center-mobile">
					<ul class="social-footer">
						<li><b style="color:#fff;">Síguenos</b></li>
						<li><a href="https://www.facebook.com/Ecotickets/" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://www.instagram.com/ecotickets/" target="_blank"><i class="fa fa-instagram"></i></a></li>
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
	<script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/typewriter.js"></script>
	<script src="js/jquery.onepagenav.js"></script>
	<script src="js/main.js"></script>
	<script src="{{ asset('js/Evento/eventos.js') }}"></script>

	<script src="Cssecupones/js/jquery.min.js"></script>
	<script src="Cssecupones/js/bootstrap.min.js"></script>
	<script src="Cssecupones/js/slick.min.js"></script>
	<script src="Cssecupones/js/nouislider.min.js"></script>
	<script src="Cssecupones/js/jquery.zoom.min.js"></script>
	<script src="Cssecupones/js/main.js"></script>




</body>

</html>
