@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>¡Hola {{ Auth::user()->name }}! | Bievenid@ a Ecotickets</h3></div>
					<div style="margin:0px !important;" class="row">
							<section id="eco" class="section">
				<div class="container">
			<div class="row text-center title">
				<h2 style="font-size: 28px; font-weight: 700; text-align:center;">Gracias por cuidar el planeta</h2>
				<h4 class="light muted">¿Qué necesitas hacer?</h4>
			</div>
			<div class="row services">
				@if(Auth::user()->buscarRecurso('FormularioEvento'))
				<div class="col-md-4">
					<div class="service">
						<div class="icon-holder">
							<a href="{{ url('FormularioEvento') }}"><img style="display:block; margin:auto;" src="img/icons/calendario.png" alt="" class="icon"></a>
						</div>
						<h4 style="text-align:center; font-weight: 700;" class="heading"><a href="{{ url('FormularioEvento') }}">Crea un evento y salva el planeta</a></h4></p>
					</div>
				</div>
				@endif
				@if(Auth::user()->buscarRecurso('MisEventos'))
				<div class="col-md-4">
					<div class="service">
						<div class="icon-holder">
							<img style="display:block; margin:auto;" src="img/icons/eventos.png" alt="" class="icon">
						</div>
						<h4 style="text-align:center; font-weight: 700;" class="heading"><a href="{{ url('MisEventos') }}">Ver tus eventos</a></h4>
					</div>
				</div>
				@endif
				@if(Auth::user()->buscarRecurso('FormularioUsuario'))
				<div class="col-md-4">
					<div class="service">
						<div class="icon-holder">
							<img style="display:block; margin:auto;" src="img/icons/invitacion.png" alt="" class="icon">
						</div>
						<h4 style="text-align:center; font-weight: 700;" class="heading"><a href="{{ url('FormularioUsuario') }}">Enviar invitaciones o cortesías</a></h4>
					</div>
				</div>
				@endif
			</div>
		</div>
	</section>
					</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endsection
