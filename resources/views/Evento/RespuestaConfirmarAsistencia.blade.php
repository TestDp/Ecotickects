@extends('layouts.eventos')

@section('content')

	
	<tbody>
	
	<div id="gtco-features-3">
		<div class="gtco-container">
			<div class="gtco-flex">
			
				<div class="feature feature-2 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-inner">
						<span class="icon" style="background-image: url(http://dpsoluciones.co/wp-content/uploads/2018/05/icono.png); background-position: center; background-repeat: no-repeat;">
							<i></i>
						</span>
						<img style="width:10%;" src="http://www.loversfestival.com/wp-content/uploads/2018/02/logo-lovers.png"></img>
						<h3>{{ $usuario->Nombres }} {{$respuestaConfirmacion}} al  {{$Evento ->Nombre_Evento}}</h3>
					</div>
				</div>
				
			</div>
		</div>
	</div>

</tbody>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
	<script src="{{ asset('js/Evento/eventos.js') }}"></script>
	<script src="{{ asset('js/Plugins/EditorTexto/ckeditor.js') }}"></script>

@endsection