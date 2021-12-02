@extends('layouts.eventos')

@section('content')
	<section class="section section-lg bg-default text-center">
        <div class="container">
          <div class="block-about">
            <div class="block-about-content">
			<img src="{{ asset('images/icon.png') }}">
              <h6>Disculpa, no hemos podido procesar tu solicitud debido a que...</h6>
              <h3>El evento ya supero el máximo de asistentes o el evento es privado.</h3>
            </div>
          </div>
        </div>
      </section>
@endsection
