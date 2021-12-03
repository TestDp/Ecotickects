@extends('layouts.eventos')

@section('RespuestaPago')
	 <section class="section section-lg bg-default text-center">
        <div class="container">
          <div class="block-about">
            <div class="block-about-content">
			<img src="{{ asset('images/icon.png') }}">
              <h6>En unos segundos recibirás un correo con la cantidad de boletas que compraste.</br>Si el estado de tu transaccion es Aprobada.</h6>
              <h3>GRACIAS POR COMPRAR TU BOLETA AL EVENTO:{{ $ElementosArray["evento"] ->Nombre_Evento }}</h3>
			  <h6>Estado de la transacción:</h6><h4>{{ $ElementosArray["mensaje"]}}</h4>
              <p>Recuerda revisar muy bien tu bandeja de correo y guardar el Ecoticket para el día de ingreso al evento, ese es tu pase de acceso.</p>
            </div>
          </div>
        </div>
      </section>
@endsection
