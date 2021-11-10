<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Ecotickets | Administrador
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.min.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="rose" data-background-color="black">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
      <a class="navbar-brand m-0" href="{{ url('/home') }}">
        <img src="../assets/img/logo-eco.png" class="navbar-brand-img h-100" alt="main_logo">
      </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="../assets/img/logo-ct-dark.png" />
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                Hola, {{ Auth::user()->name }}
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    <i class="material-icons">logout</i>
                    <span class="sidebar-normal"> Cerrar Sesión </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item active ">
            <a class="nav-link" href="{{ url('/home') }}">
              <i class="material-icons">dashboard</i>
              <p> Inicio </p>
            </a>
          </li>
		  @if(Auth::user()->buscarRecurso('GestionEvento'))
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#formsExamples">
              <i class="material-icons">content_paste</i>
              <p> Eventos
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="formsExamples">
              <ul class="nav">
			  @if(Auth::user()->buscarRecurso('MisEventos'))
                <li class="nav-item ">
                  <a class="nav-link" href="{{ url('MisEventos') }}">
                    <i class="material-icons">date_range</i>
                    <span class="sidebar-normal"> Mis eventos </span>
                  </a>
                </li>
				@endif
				@if(Auth::user()->buscarRecurso('FormularioUsuario'))
                <li class="nav-item ">
                  <a class="nav-link" href="{{ url('FormularioUsuario') }}">
                    <i class="material-icons">send</i>
                    <span class="sidebar-normal"> Enviar Ecoticket </span>
                  </a>
                </li>
				@endif
				@if(Auth::user()->buscarRecurso('FormularioUsuario'))
                <li class="nav-item ">
                  <a class="nav-link" href="{{ url('FormularioPromotor') }}">
                    <i class="material-icons">how_to_reg</i>
                    <span class="sidebar-normal"> Registrar Promotor </span>
                  </a>
                </li>
				@endif
				@if(Auth::user()->buscarRecurso('FormularioReenviarInvitacion'))
                <li class="nav-item ">
                  <a class="nav-link" href="{{ url('FormularioReenviarInvitacion') }}">
                    <i class="material-icons">send_and_archive</i>
                    <span class="sidebar-normal"> Re-enviar Ecoticket </span>
                  </a>
                </li>
				@endif
				@if(Auth::user()->buscarRecurso('GenerarEnlacePromotor'))
                <li class="nav-item ">
                  <a class="nav-link" href="{{ url('GenerarEnlacePromotor') }}">
                    <i class="material-icons">add_link</i>
                    <span class="sidebar-normal"> Generar Enlace Promotor </span>
                  </a>
                </li>
				@endif
				@if(Auth::user()->buscarRecurso('RegistrarYEnviar'))
                <li class="nav-item ">
                  <a class="nav-link" href="{{ url('RegistrarYEnviar') }}">
                    <i class="material-icons">reply_all</i>
                    <span class="sidebar-normal"> Enviar Tickets masivamente </span>
                  </a>
                </li>
				@endif
              </ul>
            </div>
          </li>
		  @if(Auth::user()->buscarRecurso('ConfiguracionesEvento'))
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
              <i class="material-icons">settings</i>
              <p> Configuraciones
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="tablesExamples">
              <ul class="nav">
			  @if(Auth::user()->buscarRecurso('ActivarFunciones'))
                <li class="nav-item ">
                  <a class="nav-link" href="{{ url('ActivarFunciones') }}">
                    <i class="material-icons">toggle_on</i>
                    <span class="sidebar-normal"> Activar funciones </span>
                  </a>
                </li>
				@endif
              </ul>
            </div>
          </li>
		  @endif
		  @if(Auth::user()->buscarRecurso('Administrador'))
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#mapsExamples">
              <i class="material-icons">admin_panel_settings</i>
              <p> Administrador
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="mapsExamples">
              <ul class="nav">
			  	@if(Auth::user()->buscarRecurso('Usuarios'))
                <li class="nav-item ">
                  <a class="nav-link" href="{{ url('usuarios') }}">
                    <i class="material-icons">group</i>
                    <span class="sidebar-normal"> Usuarios </span>
                  </a>
                </li>
				@endif
				@if(Auth::user()->buscarRecurso('Roles'))
                <li class="nav-item ">
                  <a class="nav-link" href="{{ url('roles') }}">
                    <i class="material-icons">contacts</i>
                    <span class="sidebar-normal"> Roles </span>
                  </a>
                </li>
				@endif
				@if(Auth::user()->buscarRecurso('Sedes'))
                <li class="nav-item ">
                  <a class="nav-link" href="{{ url('sedes') }}">
                    <i class="material-icons">storefront</i>
                    <span class="sidebar-normal"> Sedes </span>
                  </a>
                </li>
				@endif
				@if(Auth::user()->buscarRecurso('Departamentos'))
				<li class="nav-item ">
                  <a class="nav-link" href="{{ url('departamentos') }}">
                    <i class="material-icons">place</i>
                    <span class="sidebar-normal"> Departamentos </span>
                  </a>
                </li>
				@endif
				@if(Auth::user()->buscarRecurso('Ciudades'))
				<li class="nav-item ">
                  <a class="nav-link" href="{{ url('ListaCiudades') }}">
                    <i class="material-icons">room</i>
                    <span class="sidebar-normal"> Ciudades </span>
                  </a>
                </li>
				@endif
              </ul>
            </div>
          </li>
		  @endif
		  @if(Auth::user()->buscarRecurso('FormularioEvento'))
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('FormularioEvento') }}">
              <i class="material-icons">add</i>
              <p class="btn btn-rose btn-block btn-fill"> CREA UN EVENTO </p>
            </a>
          </li>
		  @endif
		  @endif
        </ul>
      </div>
    </div>
    <div class="main-panel">
	      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <a class="navbar-brand" href="{{ url('/home') }}">Inicio</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
        </div>
      </nav>
    <div class="content">
        <div class="content">
          <div class="container-fluid">
				@yield('content')
			</div>
		</div>
	</div>
  </div>	

			  <!-- jQuery CDN -->

			<script src="{{asset('../js/Plugins/jqueryValidate/jquery.validate.js')}}"></script>
			<script src="{{asset('../js/Plugins/data-table/datatables.js')}}"></script>
			<!-- sweet plugins-->
			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		
		
             <!--   Core JS Files   -->
              <script src="../assets/js/core/jquery.min.js"></script>
              <script src="../assets/js/core/popper.min.js"></script>
              <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
              <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
              <!-- Plugin for the momentJs  -->
              <script src="../assets/js/plugins/moment.min.js"></script>
              <!--  Plugin for Sweet Alert -->
              <script src="../assets/js/plugins/sweetalert2.js"></script>
              <!-- Forms Validations Plugin -->
              <script src="../assets/js/plugins/jquery.validate.min.js"></script>
              <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
              <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
              <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
              <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
              <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
              <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
              <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
              <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
              <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
              <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
              <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
              <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
              <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
              <script src="../assets/js/plugins/fullcalendar.min.js"></script>
              <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
              <script src="../assets/js/plugins/jquery-jvectormap.js"></script>
              <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
              <script src="../assets/js/plugins/nouislider.min.js"></script>
              <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
              <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
              <!-- Library for adding dinamically elements -->
              <script src="../assets/js/plugins/arrive.min.js"></script>
              <!--  Google Maps Plugin    -->
              <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
              <!-- Place this tag in your head or just before your close body tag. -->
              <script async defer src="https://buttons.github.io/buttons.js"></script>
              <!-- Chartist JS -->
              <script src="../assets/js/plugins/chartist.min.js"></script>
              <!--  Notifications Plugin    -->
              <script src="../assets/js/plugins/bootstrap-notify.js"></script>
              <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
              <script src="../assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
              <!-- Material Dashboard DEMO methods, don't include it in your project! -->
              <script src="../assets/demo/demo.js"></script>
              <script>
                $(document).ready(function() {
                  $().ready(function() {
                    $sidebar = $('.sidebar');

                    $sidebar_img_container = $sidebar.find('.sidebar-background');

                    $full_page = $('.full-page');

                    $sidebar_responsive = $('body > .navbar-collapse');

                    window_width = $(window).width();

                    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                    if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                      if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                        $('.fixed-plugin .dropdown').addClass('open');
                      }

                    }

                    $('.fixed-plugin a').click(function(event) {
                      // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                      if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                          event.stopPropagation();
                        } else if (window.event) {
                          window.event.cancelBubble = true;
                        }
                      }
                    });

                    $('.fixed-plugin .active-color span').click(function() {
                      $full_page_background = $('.full-page-background');

                      $(this).siblings().removeClass('active');
                      $(this).addClass('active');

                      var new_color = $(this).data('color');

                      if ($sidebar.length != 0) {
                        $sidebar.attr('data-color', new_color);
                      }

                      if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                      }

                      if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data-color', new_color);
                      }
                    });

                    $('.fixed-plugin .background-color .badge').click(function() {
                      $(this).siblings().removeClass('active');
                      $(this).addClass('active');

                      var new_color = $(this).data('background-color');

                      if ($sidebar.length != 0) {
                        $sidebar.attr('data-background-color', new_color);
                      }
                    });

                    $('.fixed-plugin .img-holder').click(function() {
                      $full_page_background = $('.full-page-background');

                      $(this).parent('li').siblings().removeClass('active');
                      $(this).parent('li').addClass('active');


                      var new_image = $(this).find("img").attr('src');

                      if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        $sidebar_img_container.fadeOut('fast', function() {
                          $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                          $sidebar_img_container.fadeIn('fast');
                        });
                      }

                      if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $full_page_background.fadeOut('fast', function() {
                          $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                          $full_page_background.fadeIn('fast');
                        });
                      }

                      if ($('.switch-sidebar-image input:checked').length == 0) {
                        var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                      }

                      if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                      }
                    });

                    $('.switch-sidebar-image input').change(function() {
                      $full_page_background = $('.full-page-background');

                      $input = $(this);

                      if ($input.is(':checked')) {
                        if ($sidebar_img_container.length != 0) {
                          $sidebar_img_container.fadeIn('fast');
                          $sidebar.attr('data-image', '#');
                        }

                        if ($full_page_background.length != 0) {
                          $full_page_background.fadeIn('fast');
                          $full_page.attr('data-image', '#');
                        }

                        background_image = true;
                      } else {
                        if ($sidebar_img_container.length != 0) {
                          $sidebar.removeAttr('data-image');
                          $sidebar_img_container.fadeOut('fast');
                        }

                        if ($full_page_background.length != 0) {
                          $full_page.removeAttr('data-image', '#');
                          $full_page_background.fadeOut('fast');
                        }

                        background_image = false;
                      }
                    });

                    $('.switch-sidebar-mini input').change(function() {
                      $body = $('body');

                      $input = $(this);

                      if (md.misc.sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        md.misc.sidebar_mini_active = false;

                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                      } else {

                        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                        setTimeout(function() {
                          $('body').addClass('sidebar-mini');

                          md.misc.sidebar_mini_active = true;
                        }, 300);
                      }

                      // we simulate the window Resize so the charts will get updated in realtime.
                      var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                      }, 180);

                      // we stop the simulation of Window Resize after the animations are completed
                      setTimeout(function() {
                        clearInterval(simulateWindowResize);
                      }, 1000);

                    });
                  });
                });
              </script>
              <!-- Sharrre libray -->
              <script src="./assets/demo/jquery.sharrre.js"></script>
              <script>
                $(document).ready(function() {
                  // Javascript method's body can be found in assets/js/demos.js
                  md.initDashboardPageCharts();

                  md.initVectorMap();

                });
              </script>
</body>

</html>