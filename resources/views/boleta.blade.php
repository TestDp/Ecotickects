@extends('layouts.eventos')

@section('content')
<section style="padding-top:40px !important;" class="section section-padded boleta-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div style="border: solid 5px #fff;" class="owl-twitter owl-carousel">
						<div class="item text-center">
							<img src="{{ asset('img/icono.png') }}">
							<h1 class="titulo-boleta">{{ $ElementosArray["evento"] ->Nombre_Evento }}</h1>
							<h1 class="titulo-boleta">{{ $ElementosArray["evento"] ->Fecha_Evento }}</h1>
							<h1 class="titulo-boleta">{{ $ElementosArray["evento"] ->Lugar_Evento }}</h1>
						</div>
					</div>
				</div>
			</div>
			<div class="row">

				<input type="hidden" id="nombreEvento" value="{{$ElementosArray["evento"] ->Nombre_Evento}}">
				<div style="text-align: center;" class="col-md-12">
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
