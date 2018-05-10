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
						<h3>¿Contamos con tu asistencia para vivir la experiencia Lovers Festival?. </h3>
						<div class="row">
								<div class="col-md-6">
															<b style="font-family: sans-serif;" class="wpcf7-form-control-wrap">
																<input type="radio" name="terminos" value="1" id="terminos" /> SI 
															</b>
								</div>
								<div class="col-md-6">
															<b style="font-family: sans-serif;" class="wpcf7-form-control-wrap">
																<input type="radio" name="HabeasData" value="1" id="HabeasData" /> NO 
															</b>
								</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="submit" onclick="generarQRCode()" class="btn btn-blue ripple trial-button">
									Enviar
								</button>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>

</tbody>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>

@endsection