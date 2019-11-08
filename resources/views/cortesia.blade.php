<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- Main style -->
	<link rel="stylesheet" type="text/css" href="css/cardio.css">
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Cortesía</title>
</head>
<body style="width: 100%; border: #8abd51 5px solid; border-radius:15px;">
				<div style="padding: 10px; float: left; width: 5%; background:#8abd51; padding:2%; text-align: center;">
				<h2 style="width:20px; word-wrap: break-word; text-align:center;color:#fff; text-align:center; font-family: 'Helvetica Neue', sans-serif; font-size: 24px; font-weight: bold;">ECOTICKETS</h2>
				</div>
                <div style="padding-top:5%; padding-bottom: 10%; background:#dddddd; float: left; width: 45%; text-align: justify; border-bottom: dashed 2px #8abd51; border-right: dashed 2px #8abd51;">
					<ul style="color:#000; text-align:center;">
						<h2 style="font-family: 'Helvetica Neue', sans-serif;">{{ $ElementosArray["evento"] ->Nombre_Evento }}</h2>
						<b>Lugar del evento:</b>
						<p>{{ $ElementosArray["evento"] ->Lugar_Evento }}</p>
						<b>Fecha del evento:</b>
						<p>{{ $ElementosArray["evento"] ->Fecha_Evento }}</p>
					</ul>				
				</div>
				<div style="padding-top:5%; float: right; width: 45%; text-align: justify;">
					<input type="hidden" id="nombreEvento" value="{{$ElementosArray["evento"] ->Nombre_Evento}}">
						<img src="data:image/png;base64,{!! $ElementosArray["qr"]!!}">
				</div>
<script src="js/Evento/eventoPago.js"></script>
<script src="js/Plugins/Qrcode/qrcode.js"></script>
<script src="js/Plugins/Jquery/jquery-3.1.1.js"></script>
</body>
</html>