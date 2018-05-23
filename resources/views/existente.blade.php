@extends('layouts.eventos')

@section('content')
<section style="background:#ffffff; padding-top:40px !important;" class="section section-padded blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div>
						<div class="item text-center">
							<img src="{{ asset('img/icono.png') }}">
							<h3 style="color:#db0000;" class="white light">El número de identificación {{$identificacion}} ya se encuentra registrado.</h3>
							<h4 style="color:#db0000;" class="light-white light">Por favor verifica la información ingresada e intenta de nuevo.</h4>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
