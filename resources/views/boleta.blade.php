@extends('layouts.eventos')

@section('content')
<section style="padding-top:40px !important;" class="section section-padded blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="owl-twitter owl-carousel">
						<div class="item text-center">
							<img src="{{ asset('img/icono.png') }}">
							<h3 class="white light">GRACIAS POR INSCRIBIRTE A {{ $ElementosArray["evento"] ->Nombre_Evento }}</h3>
							<h4 class="light-white light">En unos segundos recibirás un correo con toda la información para tu ingreso al evento.</br>
								Recuerda revisar tu bandeja de Spam.</h4>
						</div>						
					</div>
				</div>
			</div>
			<div class="row">
				<input type="hidden" id="pinboleta" value="{{$ElementosArray["pinEvento"]}}">
				<input type="hidden" id="nombreEvento" value="{{$ElementosArray["evento"] ->Nombre_Evento}}">
				<div class="col-md-6">
					<div id="qrBoleta">

					</div>
				</div>
			</div>
		</div>
	</section>
<script src="{{ asset('js/Evento/eventoPago.js') }}"></script>
<script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
<script src="{{ asset('js/Plugins/Qrcode/qrcode.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        generarQRCodePago($('#nombreEvento').val(),$('#pinboleta').val());
    });
</script>
@endsection
