<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ticket</title>
</head>
<body style="border: #8abd51 8px solid; border-radius: 15px;">
<div style="background:#8abd51; padding-top:3%; padding-bottom:3%; text-align: center;">
	<h1 style="color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 50px; font-weight: bold; letter-spacing: -1px; line-height: 1; text-align: center;">{{ $ElementosArray["evento"] ->Nombre_Evento }}</h1>
</div>

<div style="background:#e9ebee; border: #8abd51 8px solid; border-style: dashed; text-align: center;">
	<h1 style="color: #111; font-family: 'Open Sans', sans-serif; font-size: 20px; font-weight: 700; text-align: center;">Hora</h1>
	<h1 style="color: #111; font-family: 'Open Sans', sans-serif; font-size: 20px; font-weight: 300; text-align: center;" >{{ $ElementosArray["evento"] ->Fecha_Evento }}</h1>
	<h1 style="color: #111; font-family: 'Open Sans', sans-serif; font-size: 20px; font-weight: 700; text-align: center;">Lugar</h1>
	<h1 style="color: #111; font-family: 'Open Sans', sans-serif; font-size: 20px; font-weight: 300; text-align: center;">{{ $ElementosArray["evento"] ->Lugar_Evento }}</h1>
</div>

	<div>
	<div style="background: #8abd51 url(http://dpsoluciones.co/wp-content/uploads/2018/03/Boleta-back.png) no-repeat center center; background-size: cover; padding-top:10%; padding-bottom:10%; text-align: center;" class="row">
		<input type="hidden" id="nombreEvento" value="{{$ElementosArray["evento"] ->Nombre_Evento}}">
		<img src="data:image/png;base64,{!! $ElementosArray["qr"]!!}">
	</div>
</div>
<script src="js/Evento/eventoPago.js"></script>
<script src="js/Plugins/Qrcode/qrcode.js"></script>
<script src="js/Plugins/Jquery/jquery-3.1.1.js"></script>
</body>
</html>