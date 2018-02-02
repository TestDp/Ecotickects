<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ECOTICKETS | DPSOLUCIONES</title>
	<!-- CSRF Token -->
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
</head>
<body>
<section style="background:#ffffff !important; padding-top:40px !important;" id="pricing" class="section">
		<div class="container">
			<div class="row title text-center">
			<img src="{{ asset('img/logo.png') }}">
				<h2 class="black">BIEVENIDO A </h2>
					<b style="font-size:16px;">Lugar: </b></br>
					<b style="font-size:16px;">Fecha: </b></br>
					<b style="font-size:16px;">Hora: </b></br>
					<b style="font-size:16px;">Ciudad: </b>
				</br></br>
				<h4 class="light blck">Presenta tu SmartPhone con el <b>CÓDIGO QR</b> adjunto</br>	
		en la entrada del evento y disfruta de uno de los mejores</br>
		festivales de música electrónica del oriente Antioqueño.</br></p>
		<b style="font-size:16px;">*No es necesario imprimirlo presenta tu SmartPhone</br>
		cuidemos el medio ambiente.</b></h4>
			</div>
		</div>
	</section>
    

<label> </label>


 <script src="{{asset('plugins/qrcode/qrcode.js')}}"></script>
 <script src="{{asset('js/Evento/evento.js')}}"></script>

 </body>
</html>

 