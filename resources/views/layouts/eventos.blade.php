<!DOCTYPE html>
<html class="wide" lang="{{ app()->getLocale() }}">
<head>
<title>Ecotickets | Tickets Digitales</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
	<style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
	
		<!-- Modernizr JS -->
	<script src="{{ asset('js/EventosEco/modernizr-2.6.2.min.js')}}"></script>
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
</head>
<body>
    <div class="ie-panel"><a><img src="{{asset('images/ie8-panel/warning_bar_0000_us.jpg')}}" height="42" width="820" alt=""></a></div>

    <div class="page">

	        <!-- Breadcrumbs-->
      <section class="breadcrumbs-custom bg-image context-dark" style="background-image: url({{asset('images/bg-parallax-04-1894x1170.jpg')}});">
        <div class="container">
		<div>
			<a class="brand" href="{{ url('/') }}"><img class="brand-logo-dark" src="{{asset('images/logo-default.png')}}" srcset="{{asset('images/logo-default@2x.png')}} 2x" alt="Ecotickets"/><img class="brand-logo-light" src="{{asset('images/logo-inverse.png')}}" srcset="{{asset('images/logo-inverse@2x.png')}} 2x" alt="Ecotickets"/></a>
        </div>
          <ul class="breadcrumbs-custom-path">
            <li><a href="{{ url('/') }}">Volver al Inicio</a></li>
            <li><a>Diligencia tus datos y adquiere tu Ecoticket</a></li>
          </ul>
        </div>
      </section>
     <section id="eco" class="section section-lg bg-default">
        <div class="container">
		@yield('content')
		</div>
	</section>
	
	    <!-- Section Pre Footer-->
      <section class="section section-lg bg-gray-900">
        <div class="container">
          <div class="row row-30">
            <div class="col-xs-10 col-lg-4 align-self-center"><a class="brand" href="{{ url('/') }}"><img class="brand-logo-light" src="{{asset('images/logo-inverse-big.png')}}" srcset="{{asset('images/logo-inverse-big@2x.png')}} 2x" alt="Ecotickets"></a></div>
            <div class="col-xs-10 col-sm-6 col-lg-4">
              <h5><span class="big font-weight-sbold">INFORMACIÓN</span></h5>
                      <ul class="list-marked">
                        <li><a href="#">Contáctanos</a></li>
                        <li><a href="#">PQRS</a></li>
                        <li><a href="#">Preguntas frecuentes</a></li>
                      </ul>
            </div>
            <div class="col-xs-10 col-sm-6 col-lg-4">
              <h5><span class="big font-weight-sbold">POLÍTICAS ECOTICKETS</span></h5>
					<ul class="list-marked">
                        <li><a href="#">HABEAS DATA</a></li>
                        <li><a href="#">Política de Reembolso</a></li>
                        <li><a href="#">Política de Privacidad</a></li>
                        <li><a href="#">Términos y Condiciones</a></li>
                    </ul>
                <ul class="list-inline list-inline-xs">
                  <li data-wow-delay=".2s"><a class="icon icon-rect icon-xs icon-dark fa-facebook" href="https://www.facebook.com/Ecotickets/" data-triangle=".icon-rect-overlay">
                      <div class="icon-rect-overlay"></div></a></li>
                  <li data-wow-delay=".35s"><a class="icon icon-rect icon-xs icon-dark fa-instagram" href="https://www.instagram.com/ecotickets/" data-triangle=".icon-rect-overlay">
                      <div class="icon-rect-overlay"></div></a></li>
                  <li data-wow-delay=".5s"><a class="icon icon-rect icon-xs icon-dark fa-whatsapp" href="#" data-triangle=".icon-rect-overlay">
                      <div class="icon-rect-overlay"></div></a></li>
                </ul>
            </div>
          </div>
        </div>
      </section>

      <div class="divider divider-gray-900 text-center"></div>
      <!-- Footer Classic-->
      <footer class="section footer-classic context-dark">
        <div class="container">
          <p class="rights"><span>Ecotickets</span><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>&nbsp;</span><a href="https://www.instagram.com/ecotickets/" target="_blank">#EstamosCuidandoElPlaneta</a>
          </p>
        </div>
      </footer>
</div>
<!-- Scripts -->



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

    <div class="snackbars" id="form-output-global"></div>
    <div class="block-with-svg-gradients">
      <svg xmlns="http://www.w3.org/2000/svg">
        <defs>
          <lineargradient id="svg-gradient-primary" x1="0%" y1="100%" x2="100%" y2="0%">
            <stop offset="0%" style="stop-color:rgb(130,46,168);stop-opacity:1"></stop>
            <stop offset="100%" style="stop-color:rgb(217,14,144);stop-opacity:1"></stop>
          </lineargradient>
        </defs>
      </svg>
    </div>




</body>
</html>
