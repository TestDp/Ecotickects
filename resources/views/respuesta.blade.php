@extends('layouts.eventos')

@section('content')
<section style="padding-top:40px !important;" class="section section-padded blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div>
						<div class="item text-center">
							<img src="{{ asset('img/icono.png') }}">
							<h3 class="white light">GRACIAS POR INSCRIBIRTE A {{ $ElementosArray["evento"] ->Nombre_Evento }}</h3>
							<h4 class="light-white light">En unos segundos recibirás un correo con toda la información para tu ingreso al evento.</br>
Recuerda revisar tu bandeja de Spam.</h4>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
