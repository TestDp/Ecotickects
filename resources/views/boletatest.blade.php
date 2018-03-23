<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<title>ticket</title>
</head>
<body style="background: #8abd51 url(http://dpsoluciones.co/wp-content/uploads/2018/03/Boleta-back.png) no-repeat center center; background-size: cover;">

<div id="qrBoleta" style="width:800px;height:200px;">

</div>

	<div style="border: solid 5px #fff;" class="container">
		<div style="text-align: center;" class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="owl-twitter owl-carousel">
					<div class="item text-center">
						<img src="{{ asset('img/icono.png') }}">
						<h1 style="color:#fff; font-family: sans-serif;">{{ $ElementosArray["evento"] ->Nombre_Evento }}</h1>
						<h1 style="color:#fff; font-family: sans-serif;">{{ $ElementosArray["evento"] ->Fecha_Evento }}</h1>
						<h1 style="color:#fff; font-family: sans-serif;">{{ $ElementosArray["evento"] ->Lugar_Evento }}</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<input type="hidden" id="pinboleta" value="{{$ElementosArray["pinEvento"]}}">
			<input type="hidden" id="nombreEvento" value="{{$ElementosArray["evento"] ->Nombre_Evento}}">
			<div style="text-align: center;" class="col-md-12">
				<div id="qrBoleta">

				</div>
			</div>
		</div>
	</div>

<script src="js/Evento/eventoPago.js"></script>
<script src="js/Plugins/Qrcode/qrcode.js"></script>
<script src="js/Plugins/Jquery/jquery-3.1.1.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        generarQRCodePago($('#nombreEvento').val(),$('#pinboleta').val());
    });
</script>
</body>
</html>
