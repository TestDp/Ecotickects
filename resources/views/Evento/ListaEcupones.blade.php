<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Ecupones</title>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
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
</head>

<body>
<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> 311 723 41 63</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> info@ecotickets.co</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> Rionegro - Antioquia</a></li>
            </ul>
            <ul class="header-links pull-right">
                <li><a href="#"><i class="fa fa-user-o"></i> Inicia Sesión</a></li>
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="#" class="logo">
                            <img src="Cssecupones/img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form>
                            <select class="input-select">
                                <option value="0">Categorías</option>
                                <option value="1">Comidas</option>
                                <option value="1">Ropa</option>
                            </select>
                            <input class="input" placeholder="Ingresa tú búsqueda">
                            <button class="search-btn">Buscar</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href="#">INICIO</a></li>
                <li><a href="{{ url('/') }}">ECOTICKETS</a></li>
                <li><a href="#">COMIDAS</a></li>
                <li><a href="#">ROPA</a></li>
                <li><a href="#">TECNOLOGÍA</a></li>
                <li><a href="#">CONTACTO</a></li>
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Ecupones Destacados</h3>
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
                                        <h4 class="product-price">$7.000 <del class="product-old-price">$10.000</del></h4>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
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
<!-- /SECTION -->

<!-- STORE -->
	<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<div class="row">
				<!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Ecupones | Sé feliz y cuida el medio ambiente</h3>
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
					<div id="store" class="col-md-12">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Ordenar por:
									<select class="input-select">
										<option value="0">Popularidad</option>
										<option value="1">Fecha</option>
									</select>
								</label>

								<label>
									Mostrar:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row">
							<!-- product -->
							@foreach($ListaEcupones["cupones"] as $cupon)
							<div class="col-md-4 col-xs-6">							
								<div class="product">
									<div class="product-img">
										<img src={{ $ListaEcupones["rutaImagenes"].$cupon->FlyerEvento}}>
										<div class="product-label">
											<span class="sale">{{ $cupon->Nombre_Evento }}</span></br>
											<span class="new">Vence en: {{ $cupon->Plazo }} días</span>
										</div>
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="#">{{ $cupon->Lugar_Evento }}</a></h3>
										<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<div class="add-to-cart">
                                        @if($cupon->esPago)
                                            <button class="add-to-cart-btn"><a href="{{url('FormularioAsistentePago', ['idEvento' => $cupon->id ])}}"><i class="fa fa-shopping-cart"></i> Obtener cupón</a></button>
                                        @else
                                            <button class="add-to-cart-btn"><a href="{{url('FormularioAsistente', ['idEvento' => $cupon->id ])}}"><i class="fa fa-shopping-cart"></i> Obtener cupón</a></button>
                                        @endif
                                    </div>
								</div>
							</div>
							@endforeach
							<!-- /product -->		
					<div class="clearfix visible-sm visible-xs"></div>
						</div>
						
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty">Mostrando 20-100 cupones</span>
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
			</div>
		</div>
	</div>

<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Ecupones</h3>
                        <p>Somos un producto Ecotickets y también una forma simple de proteger el planeta.</p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i>Orgullosamente Rionegreros</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>311 723 41 63</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>info@ecotickets.co</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Categorías</h3>
                        <ul class="footer-links">
                            <li><a href="#">Comidas</a></li>
                            <li><a href="#">Ropa</a></li>
                            <li><a href="#">Tecnología</a></li>
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-4 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Más información</h3>
                        <ul class="footer-links">
                            <li><a href="#">Ecotickets</a></li>
                            <li><a href="#">Contáctanos</a></li>
                            <li><a href="#">Tratamiento de datos</a></li>
                            <li><a href="#">Términos y condiciones</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
</footer>
<!-- /FOOTER -->
<!-- Holder for mobile navigation -->
<div class="mobile-nav">
    <ul>
    </ul>
    <a href="#" class="close-link"><i class="arrow_up"></i></a>
</div>

<!-- jQuery Plugins -->
		<script src="Cssecupones/js/jquery.min.js"></script>
		<script src="Cssecupones/js/bootstrap.min.js"></script>
		<script src="Cssecupones/js/slick.min.js"></script>
		<script src="Cssecupones/js/nouislider.min.js"></script>
		<script src="Cssecupones/js/jquery.zoom.min.js"></script>
		<script src="Cssecupones/js/main.js"></script>
		<script src="{{ asset('js/Evento/eventos.js') }}"></script>
</body>
</html>
