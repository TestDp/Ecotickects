<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ticket</title>
</head>
<body>
<div id="qrBoleta" style="width:800px;height:200px;">

</div>
<div class="container">
<div class="row">
	<input type="hidden" id="pinboleta" value="{{$ElementosArray["pinEvento"]}}">
	<input type="hidden" id="nombreEvento" value="{{$ElementosArray["evento"] ->Nombre_Evento}}">
	<div class="col-md-6">

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
