@extends('layouts.eventos')

@section('content')
<section style="background:#ffffff; padding-top:40px !important;" class="section section-padded blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
						<div class="item text-center">
							<img src="{{ asset('img/icono.png') }}">
							<h3 style="text-align:center; color:#db0000;" class="white light">El evento ya supero el máximo de asistentes o el evento es privado.</h3>
						</div>						
				</div>
			</div>
		</div>
	</section>
@endsection
