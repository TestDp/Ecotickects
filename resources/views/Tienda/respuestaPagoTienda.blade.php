@extends('layouts.eventos')

@section('content')
<section style="padding-top:40px !important;" class="section section-padded blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div>
						<div class="item text-center">
							<img src="{{ asset('img/icono.png') }}">
							<h3 class="white light">GRACIAS REALIZAR LA COMPRA </h3>
							<h4 class="light-white light"></br>
								Si el estado de tu transacción es Aprobado reclama puedes reclamar el pedido.</br>
								</h4>
							<h3 class="white light">Estado de la transaccion es:{{ $ElementosArray["mensaje"]}}</h3>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
