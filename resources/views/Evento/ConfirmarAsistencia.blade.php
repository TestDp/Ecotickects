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
						<h3>¿Contamos con tu asistencia para vivir la experiencia  {{$Evento ->Nombre_Evento}} ?</h3>
						<form id="ConfirmarAsistente" action="{{url('ConfirmarAsistente')}}" method="POST" enctype="multipart/form-data">
							<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" id="idEvento" name="idEvento" value="{{$Evento ->id}}">
						<div class="row">
						<div class="col-md-3">
						</div>
							<div class="col-md-6">
								Ingresa tu número de identificación
								<input id="Identificacion" name="Identificacion" type="number" class="form-control" onchange="BuscarAsistente()"/>
							</div>
						<div class="col-md-3">
						</div>	
						</div>	
						<div class="row">
								<div class="col-md-6">
															<b style="font-family: sans-serif; font-size: 40px;" >
																<input type="radio" name="confirmarAsistencia" value="si" id="si" /> SI 
															</b>
								</div>
								<div class="col-md-6">
															<b style="font-family: sans-serif; font-size: 40px;" >
																<input type="radio" name="confirmarAsistencia" value="no" id="no" /> NO 
															</b>
								</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-blue ripple trial-button" onclick="validarCamposConfirmacion()" >
									Enviar
								</button>
							</div>
						</div>
						</form>
						
						
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