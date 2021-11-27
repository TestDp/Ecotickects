@extends('layouts.app')

@section('content')
        <div class="container">
          <div class="row justify-content-md-center">
            <div class="col-md-9 col-lg-7 col-xl-5">
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
@endsection