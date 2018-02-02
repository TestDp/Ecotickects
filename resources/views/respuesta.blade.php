@extends('layouts.eventos')

@section('content')
<section style="padding-top:40px !important;" class="section section-padded blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="owl-twitter owl-carousel">
						<div class="item text-center">
							<img src="{{ asset('img/icono.png') }}">
							<h3 class="white light">GRACIAS POR INSCRIBIRTE A</h3>
							<h4 class="light-white light">En unos segundos recibirás un correo con toda la información para tu ingreso al evento.</br>
Recuerda revisar tu bandeja de Spam.</h4>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
