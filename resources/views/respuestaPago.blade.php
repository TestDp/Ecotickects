@extends('layouts.eventos')

@section('content')
<section style="padding-top:40px !important;" class="section section-padded blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div>
						<div class="item text-center">
							<img src="{{ asset('img/icono.png') }}">
							<h3 class="white light">GRACIAS POR COMPRAR TU BOLETA AL EVENTO:{{ $ElementosArray["evento"] ->Nombre_Evento }}</h3>
							<h4 class="light-white light">En unos segundos recibirás un correo con la cantidad de boletas que compraste.</br>
								Si el estado de tu transaccion es Aprovada.</br>
								Recuerda revisar tu bandeja de Spam.</h4>
							<h3 class="white light">Estado de la transaccion:{{ $ElementosArray["mensaje"]}}</h3>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
