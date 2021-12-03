@extends('layouts.app')

@section('content')
      <section class="section section-lg bg-default text-center">
        <div class="container">
          <div class="block-about">
            <div class="block-about-content">
			<img src="{{ asset('images/icon.png') }}">
              <h6>En unos segundos recibirás un correo con toda la información para tu ingreso al evento.</br>Recuerda revisar tu bandeja de Spam.</h6>
              <h3>GRACIAS POR INSCRIBIRTE A {{ $ElementosArray["evento"] ->Nombre_Evento }}</h3>
              <p>Recuerda revisar muy bien tu bandeja de correo y guardar el Ecoticket para el día de ingreso al evento, ese es tu pase de acceso.</p>
            </div>
          </div>
        </div>
      </section>
@endsection
