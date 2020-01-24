@extends('layouts.eventos')

@section('content')
<section style="background:#ffffff; padding-top:40px !important;" class="section section-padded blue-bg">
		<div class="container">
			<div class="row">
				<div style="width: 75%; text-align: center;" class="col-md-12 col-md-offset-2">
							<img src="{{ asset('img/icono.png') }}">
							        @if($respuesta == 'true')
            <h3 style="color:#000 !important;">Muchas gracias por registrarse, se ha enviado un correo electrónico para verificación de la cuenta </h3>
        @else
            @if($respuesta =='sinPago')
                <h3 style="color:#000 !important;">No se ha realizado el pago de la suscripción</h3>
            @else
                <h3 style="color:#000 !important;">No se ha verificado la cuenta, por favor verifcar su cuenta </h3>
            @endif
        @endif

				</div>
			</div>
		</div>
	</section>
@endsection