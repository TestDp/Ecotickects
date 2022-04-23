<!DOCTYPE html>
<html class="wide" lang="en">
  <head>
    <title>Ecotickets | Tickets Digitales</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="facebook-domain-verification" content="b6mr1ad6hpr4tmo3pz48jtppzjc82z" />
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
  </head>
  <body>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container">
          <div class="cssload-speeding-wheel"></div>
        </div>
        <p>Cargando...</p>
      </div>
    </div>
    <div class="page">
      <!-- Section Header Default-->
      <header class="section page-header">
        <!--RD Navbar-->
        <div class="rd-navbar-wrap">
          <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="76px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1" data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></div>
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                <!--RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!--RD Navbar Toggle-->
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <!--RD Navbar Brand-->
                  <div class="rd-navbar-brand">
                    <!--Brand--><a class="brand" href="{{ url('/') }}"><img class="brand-logo-dark" src="images/logo-default.png" srcset="images/logo-default@2x.png 2x" alt="Ecotickets"/><img class="brand-logo-light" src="images/logo-inverse.png" srcset="images/logo-inverse@2x.png 2x" alt="Ecotickets"/></a>
                  </div>
                </div>
                <!-- Rd Navbar Navigation-->
                <div class="rd-navbar-main-element">
                  <div class="rd-navbar-nav-wrap">
				  @if (Route::has('login'))
                    <ul class="rd-navbar-nav">
                      <li class="rd-nav-item active"><a class="rd-nav-link" href="{{ url('/') }}">Inicio</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="#eventos">Eventos</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="#beneficios">Beneficios</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="#destacados">Destacados</a>
                      </li>
                      <li class="rd-nav-item"><a class="rd-nav-link" href="#ecotickets">Ecotickets</a>
                      </li>
                    </ul>
                  </div>
                </div>
				@auth
				<li class="rd-nav-item active"><a class="rd-nav-link" href="{{ url('/home') }}">Volver al admin</a>
                      </li>
					  @else
                <!-- RD Navbar Collapse-->
                <div class="rd-navbar-collapse"><a class="button button-primary" href="{{ route('login') }}" data-triangle=".button-overlay"><span>Iniciar sesión</span><span class="button-overlay"></span></a>
                </div>
				@endauth
				@endif
              </div>
            </div>
          </nav>
        </div>
      </header>
	  
    
      <section id="eventos" style="padding-top:60px !important;" class="section section-lg bg-default text-center">
        <div class="container">
			<img src="images/icon-hoja.jpg"></img>
          <h6>Evaluación DJ´S</h6>
          <h3>LOVERS FESTIVAL 2022</h3>
		  <iframe src="https://docs.google.com/forms/d/e/1FAIpQLScpMS_2WbAWGZQa728p1qSN2sr8en8pCQ3ekiOhNN0dUeWoXg/viewform?embedded=true" width="100%" height="1170" frameborder="0" marginheight="0" marginwidth="0">Cargando…</iframe>
 
        </div>
      </section>
	  
	        <!-- Raices-->

      <section id="beneficios" style="padding: 200px 0px !important; background-image: url('images/back-grey.png'); background-size: cover;" class="section section-lg bg-default text-center">
        <div class="container">
          <h6>VINIMOS PARA QUEDARNOS CON</h6>
          <h3>raíces más fuertes</h3>
          <div class="row row-30">
            <div class="col-md-3">
              <div>
                <div class="news-img"><img src="images/Cuidado-del-medio-ambiente.png" alt=""/></div>
                <h4 class="news-title"><a href="single-news.html">Solidaridad con el medio ambiente</a></h4>
                <p style="text-align:center;" class="news-text">Tu obtienes una boleta virtual, así, evitamos la impresión de boletas físicas.</p>
              </div>
            </div>
			<div class="col-md-3">
              <div>
                <div class="news-img"><img src="images/control-virtual.png" alt=""/></div>
                <h4 class="news-title"><a href="single-news.html">Control en tiempo real</a></h4>
                <p style="text-align:center;" class="news-text">Ecotickets APP te permite registrar y controlar el acceso a tus eventos, la procedencia de las boletas, cuánta gente faltó, y mucho más, de una forma fácil y rápida.</p>
              </div>
            </div>
			<div class="col-md-3">
              <div>
                <div class="news-img"><img src="images/estadisticas.png" alt=""/></div>
                <h4 class="news-title"><a href="single-news.html">Estadísticas con raíces</a></h4>
                <p style="text-align:center;" class="news-text">Controla todas las estadísticas de tus eventos. Toda la información a tu alcance en cualquier momento.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div>
                <div class="news-img"><img src="images/ahorra-tu-tiempo-icono.png" alt=""/></div>
                <h4 class="news-title"><a href="single-news.html">Ahorra tu tiempo</a></h4>
                <p style="text-align:center;" class="news-text">Administra tu propio evento de manera ágil y segura; sin perder tiempo en conteos físicos, todo está en la plataforma.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
	  
      <!-- Section Biggest 2019 Digital Conference-->
      <section id="ecotickets" class="section section-lg bg-default wow fadeIn">
        <div class="container">
          <div class="row row-30 justify-content-center">
            <div class="col-md-10 col-lg-6 col-xl-5">
              <h6>SOMOS ECOTICKETS</h6>
              <h3 class="heading-lg-postfix-15">Una forma simple de cuidar el planeta</h3>
              <p>Un equipo de ingenieros de la Universidad de Antioquia emprendedores, soñadores y que piensan que si se puede cambiar el mundo decidieron idear una forma de aportar algo al planeta, desde la tecnología y sus conocimientos, es por eso que en el año 2017 nace ECOTICKETS que es una plataforma de administración digital de eventos sostenible que hasta el día de hoy ha logrado evitar la tala de aproximadamente 100 árboles al evitar la impresión de tickets físicos.</p>
              <!-- List Inline-->
			<a class="button button-primary" href="https://www.instagram.com/ecotickets/" TARGET="_blank" data-triangle=".button-overlay"><span>¿QUIERES ALIARTE CON NOSOTROS?</span><span class="button-overlay"></span></a>
            </div>
            <div class="col-md-10 col-lg-6 col-xl-7 text-md-right">
              <!-- Image Box-->
              <div class="images-box">
                <div class="images-box-item images-box-item-right">
                  <div class="wow fadeScale"><img src="images/home-1-01-470x590.jpg" alt="" width="470" height="590"/>
                  </div>
                </div>
                <div class="images-box-item images-box-item-left">
                  <div class="wow fadeScale"><img src="images/home-1-02-270x257.jpg" alt="" width="270" height="257"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
	  
	  
      <!-- Section Our Testimonials-->
      <section class="section parallax-js section-lg bg-default text-center">
        <div class="container">
          <h6>ESTO ES LO QUE DICEN</h6>
          <h3>NUESTROS ALIADOS</h3>
          <div class="row row-30 justify-content-center">
            <div class="col-md-10 col-lg-8">
              <div class="slick-slider child-slick-slider" id="child-carousel" data-for=".carousel-parent" data-arrows="true" data-loop="false" data-dots="false" data-swipe="true" data-items="3" data-sm-items="3" data-md-items="3" data-lg-items="3" data-xl-items="3" data-slide-to-scroll="1">
                <div class="item"><a><img src="images/JULI.jpg" alt="" width="80" height="80"/></a></div>
                <div class="item"><a><img src="images/testimonial-thumb-02-80x80.jpg" alt="" width="80" height="80"/></a></div>
                <div class="item"><a><img src="images/testimonial-thumb-03-80x80.jpg" alt="" width="80" height="80"/></a></div>
              </div>
              <div class="slick-slider carousel-parent" data-arrows="false" data-loop="true" data-autoplay="true" data-dots="false" data-swipe="true" data-items="1" data-child="#child-carousel" data-for="#child-carousel">
                <div class="item">
                  <div class="testimonial">
                    <div class="wow fadeIn">
                      <!-- Testimonial-->
                      <p class="testimonial-text heading-4">Encontrarnos con Ecotickets evolucionó nuestro sistema de venta de tickets! Facilitaron los procesos para el ingreso a nuestros eventos, una plataforma súper amigable y el mejor equipo de soporte técnico para acompañarnos en todo el proceso! Gracias chicos por tan increíble plataforma.</p>
                      <ul class="list-inline">
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                      </ul>
                      <div class="testimonial-footer"><a class="testimonial-name" href="#">Juli Molsalve DJ</a> <span class="testimonial-cite">-  MUTE MEDELLÍN</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="testimonial">
                    <div class="wow fadeIn">
                      <!-- Testimonial-->
                      <p class="testimonial-text heading-4">Las personas y empresas que nos dedicamos a la producción de espectáculos públicos de las artes escénicas, sabemos lo importante que es para la organización y para el usuario, la forma en que se adquieren las entradas. Poder de la mano de Ecotickets, transformar el manejo tradicional de boletería (papel) al manejo a través de las nuevas tecnologías (digital), ha permitido mejorar la experiencia de usuario y la toma de decisiones con base en la información.</p>
                      <ul class="list-inline">
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                        <li><span class="icon icon-sm icon-secondary fa-star-half-empty"></span></li>
                      </ul>
                      <div class="testimonial-footer"><a class="testimonial-name" href="#">Juan Carlos Gil</a> <span class="testimonial-cite">-  LOVERS FESTIVAL</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="testimonial">
                    <div class="wow fadeIn">
                      <!-- Testimonial-->
                      <p class="testimonial-text heading-4">Los Ecotickets tienen la capacidad de convertir una tarea ardua y compleja, en una simple acción, rapida, efectiva y confiable!👌👌 Para el caso de la organización que represente, era una tarea dispendiosa validar uno a uno los 260 integrantes de la organización, para validar si se tenia o no un quórum para tomar las decisiones, pero al momento de adquirir Ecotickets, esta tarea paso a hacer un solo click, y ya teniamos la validación de los asistentes, y no solo eso, tambien la facilidad de obtener reportes por un periodo de tiempo, historial por integrante, puntualidad, etc. La mejor decisión fue adquirir este maravilloso servicio</p>
                      <ul class="list-inline">
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                        <li><span class="icon icon-sm icon-secondary fa-star"></span></li>
                      </ul>
                      <div class="testimonial-footer"><a class="testimonial-name" href="#">Alexis Alvarán</a> <span class="testimonial-cite">-  ASOCOMUNAL MARINILLA</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="layer layer-01">
          <svg width="126" height="126" viewbox="0 0 126 126" fill="none" xmlns="http://www.w3.org/2000/svg">
            <mask id="mask0" maskunits="userSpaceOnUse" x="0" y="0" width="126" height="126">
              <path d="M126 63C126 97.7939 97.7939 126 63 126C28.2061 126 0 97.7939 0 63C0 28.2061 28.2061 0 63 0C97.7939 0 126 28.2061 126 63Z"></path>
            </mask>
            <g mask="url(#mask0)">
              <path d="M61.2694 -27.0047L-26.9917 61.2563L-22.5793 65.6687L65.6817 -22.5924L61.2694 -27.0047Z"></path>
              <path d="M71.0589 -17.2147L-17.2021 71.0464L-12.7898 75.4587L75.4712 -12.8023L71.0589 -17.2147Z"></path>
              <path d="M80.8724 -7.39484L-7.38867 80.8662L-2.97632 85.2786L85.2847 -2.98249L80.8724 -7.39484Z"></path>
              <path d="M90.6785 2.42205L2.41748 90.6831L6.82983 95.0955L95.0909 6.83441L90.6785 2.42205Z"></path>
              <path d="M100.485 12.215L12.2236 100.476L16.636 104.888L104.897 16.6274L100.485 12.215Z"></path>
              <path d="M110.298 22.0353L22.0371 110.296L26.4495 114.709L114.711 26.4476L110.298 22.0353Z"></path>
              <path d="M120.095 31.8322L31.8335 120.093L36.2458 124.506L124.507 36.2445L120.095 31.8322Z"></path>
              <path d="M129.901 41.6452L41.6401 129.906L46.0525 134.319L134.314 46.0575L129.901 41.6452Z"></path>
              <path d="M139.698 51.4421L51.4365 139.703L55.8489 144.115L144.11 55.8544L139.698 51.4421Z"></path>
              <path d="M149.521 61.2721L61.2598 149.533L65.6721 153.946L153.933 65.6845L149.521 61.2721Z"></path>
            </g>
          </svg>
        </div>
        <div class="layer layer-02">
          <svg width="95" height="65" viewbox="0 0 95 65" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="2.50049" cy="62.5005" r="2.5"></circle>
            <circle cx="20.5005" cy="62.5005" r="2.5"></circle>
            <circle cx="38.5005" cy="62.5005" r="2.5"></circle>
            <circle cx="56.5005" cy="62.5005" r="2.5"></circle>
            <circle cx="74.5005" cy="62.5005" r="2.5"></circle>
            <circle cx="92.5005" cy="62.5005" r="2.5"></circle>
            <circle cx="2.50049" cy="42.5005" r="2.5"></circle>
            <circle cx="20.5005" cy="42.5005" r="2.5"></circle>
            <circle cx="38.5005" cy="42.5005" r="2.5"></circle>
            <circle cx="56.5005" cy="42.5005" r="2.5"></circle>
            <circle cx="74.5005" cy="42.5005" r="2.5"></circle>
            <circle cx="92.5005" cy="42.5005" r="2.5"></circle>
            <circle cx="2.50049" cy="22.5005" r="2.5"></circle>
            <circle cx="20.5005" cy="22.5005" r="2.5"></circle>
            <circle cx="38.5005" cy="22.5005" r="2.5"></circle>
            <circle cx="56.5005" cy="22.5005" r="2.5"></circle>
            <circle cx="74.5005" cy="22.5005" r="2.5"></circle>
            <circle cx="92.5005" cy="22.5005" r="2.5"></circle>
            <circle cx="2.50049" cy="2.50049" r="2.5"></circle>
            <circle cx="20.5005" cy="2.50049" r="2.5"></circle>
            <circle cx="38.5005" cy="2.50049" r="2.5"></circle>
            <circle cx="56.5005" cy="2.50049" r="2.5"></circle>
            <circle cx="74.5005" cy="2.50049" r="2.5"></circle>
            <circle cx="92.5005" cy="2.50049" r="2.5"></circle>
          </svg>
        </div>
        <div class="layer layer-03">
          <svg width="26" height="18" viewbox="0 0 26 18" xmlns="http://www.w3.org/2000/svg">
            <path d="M13 0L25.1244 18H0.875645L13 0Z"></path>
          </svg>
        </div>
        <div class="layer layer-04">
          <svg width="83" height="83" viewbox="0 0 83 83" xmlns="http://www.w3.org/2000/svg">
            <rect y="41.0122" width="58" height="58" transform="rotate(-45 0 41.0122)"></rect>
          </svg>
        </div>
        <div class="layer layer-05">
          <svg width="103" height="103" viewbox="0 0 103 103" xmlns="http://www.w3.org/2000/svg">
            <circle cx="60.9647" cy="98.604" r="2.5" transform="rotate(-45 60.9647 98.604)"></circle>
            <circle cx="73.6928" cy="85.876" r="2.5" transform="rotate(-45 73.6928 85.876)"></circle>
            <circle cx="86.4208" cy="73.1479" r="2.5" transform="rotate(-45 86.4208 73.1479)"></circle>
            <circle cx="99.1483" cy="60.4204" r="2.5" transform="rotate(-45 99.1483 60.4204)"></circle>
            <circle cx="46.8226" cy="84.4619" r="2.5" transform="rotate(-45 46.8226 84.4619)"></circle>
            <circle cx="59.5507" cy="71.7339" r="2.5" transform="rotate(-45 59.5507 71.7339)"></circle>
            <circle cx="72.2787" cy="59.0059" r="2.5" transform="rotate(-45 72.2787 59.0059)"></circle>
            <circle cx="85.0062" cy="46.2783" r="2.5" transform="rotate(-45 85.0062 46.2783)"></circle>
            <circle cx="32.6806" cy="70.3198" r="2.5" transform="rotate(-45 32.6806 70.3198)"></circle>
            <circle cx="45.4086" cy="57.5918" r="2.5" transform="rotate(-45 45.4086 57.5918)"></circle>
            <circle cx="58.1366" cy="44.8638" r="2.5" transform="rotate(-45 58.1366 44.8638)"></circle>
            <circle cx="18.5385" cy="56.1777" r="2.5" transform="rotate(-45 18.5385 56.1777)"></circle>
            <circle cx="31.2665" cy="43.4497" r="2.5" transform="rotate(-45 31.2665 43.4497)"></circle>
            <circle cx="4.39637" cy="42.0356" r="2.5" transform="rotate(-45 4.39637 42.0356)"></circle>
          </svg>
        </div>
        <div class="layer layer-06">
          <div class="layer-06-inner">
            <svg width="18" height="18" viewbox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
              <circle cx="9" cy="9" r="9"></circle>
            </svg>
          </div>
        </div>
        <div class="layer layer-07">
          <div class="layer-07-inner">
            <svg width="18" height="18" viewbox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
              <circle cx="9" cy="9" r="9"></circle>
            </svg>
          </div>
        </div>
        <div class="layer layer-08">
          <svg width="127" height="91" viewbox="0 0 127 91" xmlns="http://www.w3.org/2000/svg">
            <line x1="24.544" y1="0.646447" x2="113.639" y2="89.7419"></line>
            <line x1="36.6392" y1="0.646447" x2="125.735" y2="89.7419"></line>
            <line x1="0.353553" y1="0.646447" x2="89.449" y2="89.7419"></line>
            <line x1="12.4488" y1="0.646447" x2="101.544" y2="89.7419"></line>
          </svg>
        </div>
        <div class="layer layer-09">
          <svg width="122" height="122" viewbox="0 0 122 122" xmlns="http://www.w3.org/2000/svg">
            <mask id="mask1" maskunits="userSpaceOnUse" x="17" y="17" width="87" height="87">
              <path d="M91.2168 30.4054C108.009 47.198 108.009 74.4241 91.2168 91.2166C74.4242 108.009 47.1981 108.009 30.4056 91.2166C13.613 74.4241 13.613 47.198 30.4056 30.4054C47.1981 13.6129 74.4242 13.6129 91.2168 30.4054Z"></path>
            </mask>
            <g mask="url(#mask1)">
              <path d="M16.5371 18.2077V103.402H20.7962V18.2077H16.5371Z"></path>
              <path d="M25.9868 18.2078V103.402H30.2459V18.2078H25.9868Z"></path>
              <path d="M35.4624 18.2107V103.405H39.7215V18.2107H35.4624Z"></path>
              <path d="M44.9331 18.2161V103.411H49.1922V18.2161H44.9331Z"></path>
              <path d="M54.3921 18.2097V103.404H58.6511V18.2097H54.3921Z"></path>
              <path d="M63.8677 18.2126V103.407H68.1267V18.2126H63.8677Z"></path>
              <path d="M73.3242 18.2131V103.408H77.5833V18.2131H73.3242Z"></path>
              <path d="M82.7935 18.216V103.411H87.0525V18.216H82.7935Z"></path>
              <path d="M92.2495 18.2165V103.411H96.5086V18.2165H92.2495Z"></path>
              <path d="M101.735 18.2199V103.415H105.994V18.2199H101.735Z"></path>
            </g>
          </svg>
        </div>
        <div class="layer layer-10">
          <svg width="53" height="48" viewbox="0 0 53 48" xmlns="http://www.w3.org/2000/svg">
            <path d="M21.5295 5.85179L52.1481 36.4704L10.3223 47.6776L21.5295 5.85179Z"></path>
          </svg>
        </div>
      </section>
	  
	  	        <!-- Ellos confian en nosotros-->
      <section class="parallax-container section" data-parallax-img="images/bg-parallax-04-1894x1170.jpg">
        <div class="parallax-content section-lg context-dark text-center">
          <div class="container">
            <h6>ELLOS CONFÍAN</h6>
            <h3>En Nosotros</h3>
            <div class="row row-30 row-lg-50 justify-content-center">
              <div class="col-sm-5 col-lg-3">
                <div class="wow">
                  <div>
                    <!-- Sponsor--><a class="sponsor" href="#" data-triangle=".sponsor-overlay">
                      <div class="sponsor-overlay"></div>
                      <div class="sponsor-img"><img src="images/lovers.png" alt="" width="120" height="120"/>
                      </div></a>
                  </div>
                </div>
              </div>
              <div class="col-sm-5 col-lg-3">
                <div class="wow">
                  <div>
                    <!-- Sponsor--><a class="sponsor" href="#" data-triangle=".sponsor-overlay">
                      <div class="sponsor-overlay"></div>
                      <div class="sponsor-img"><img src="images/colasistencia.png" alt="" width="120" height="120"/>
                      </div></a>
                  </div>
                </div>
              </div>
              <div class="col-sm-5 col-lg-3">
                <div class="wow">
                  <div>
                    <!-- Sponsor--><a class="sponsor" href="#" data-triangle=".sponsor-overlay">
                      <div class="sponsor-overlay"></div>
                      <div class="sponsor-img"><img src="images/sena.png" alt="" width="120" height="120"/>
                      </div></a>
                  </div>
                </div>
              </div>
              <div class="col-sm-5 col-lg-3">
                <div class="wow">
                  <div>
                    <!-- Sponsor--><a class="sponsor" href="#" data-triangle=".sponsor-overlay">
                      <div class="sponsor-overlay"></div>
                      <div class="sponsor-img"><img src="images/mute.png" alt="" width="120" height="120"/>
                      </div></a>
                  </div>
                </div>
              </div>
			  <div class="col-sm-5 col-lg-3">
              </div>
			  <div class="col-sm-5 col-lg-3">
                <div class="wow">
                  <div>
                    <!-- Sponsor--><a class="sponsor" href="#" data-triangle=".sponsor-overlay">
                      <div class="sponsor-overlay"></div>
                      <div class="sponsor-img"><img src="images/camara.jpg" alt="" width="120" height="120"/>
                      </div></a>
                  </div>
                </div>
              </div>
			  <div class="col-sm-5 col-lg-3">
                <div class="wow">
                  <div>
                    <!-- Sponsor--><a class="sponsor" href="#" data-triangle=".sponsor-overlay">
                      <div class="sponsor-overlay"></div>
                      <div class="sponsor-img"><img src="images/asocomunal.jpg" alt="" width="120" height="120"/>
                      </div></a>
                  </div>
                </div>
              </div>
			  <div class="col-sm-5 col-lg-3">
              </div>
            </div>
          </div>
        </div>
      </section>

      
	    <!-- Section Pre Footer-->
      <section class="section section-lg bg-gray-900">
        <div class="container">
          <div class="row row-30">
            <div class="col-xs-10 col-lg-4 align-self-center"><a class="brand" href="{{ url('/') }}"><img class="brand-logo-light" src="{{ asset('images/logo-inverse-big.png') }}" srcset="{{ asset('images/logo-inverse-big@2x.png 2x') }}" alt="Ecotickets"></a></div>
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
    <script src="{{ asset('js/core.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>