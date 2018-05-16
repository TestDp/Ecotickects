@extends('layouts.eventos')

@section('content')
	<div class="row title text-ri">
								<h2 class="black">EVENTOS ECOTICKETS</h2>
	</div>
						<div style="padding-bottom:2%;" class="row">
							<div style="text-align: center;" class="col-md-12">
							<a class="btn btn-blue ripple trial-button" href="{{ URL::previous() }}">Atrás</a>
							</div>
						</div>
	<tbody>
<div class="gtco-section">
		<div class="gtco-container">
			<div class="row row-pb-md">
				<div class="col-md-12">
					<ul id="gtco-portfolio-list">

    
    @foreach($ListaEventos["eventos"] as $evento)
	
		<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(http://dpsoluciones.co/wp-content/uploads/2017/11/Dp-Nature2.png);">
      		<div style="height:15%;"><h1>{{ $evento->Nombre_Evento }}</h1></div>
			<h1>-----------------</h1>
			<h2>{{ $evento->Lugar_Evento }}</h2>			   
			<h4>{{ $evento->ciudad->Nombre_Ciudad }}</h4>			   
			<h4>{{ $evento->ciudad->departamento->Nombre_Departamento }}</h4>
			<h1>-----------------</h1>            
                @if($evento->esPago)
                <a href="{{url('FormularioAsistentePago', ['idEvento' => $evento->id ])}}"><h5 style="border: 1px #8abd51 solid; background-color:#8abd51; padding: 3%;">Registrarse</h5></a>
                @else
                <a href="{{url('FormularioAsistente', ['idEvento' => $evento->id ])}}"><h5 style="border: 1px #8abd51 solid; background-color:#8abd51; padding: 3%;">Registrarse</h5></a>
                @endif
            @if($evento->activarTienda ==1)
                <a href="{{url('FormularioAsistentePago', ['idEvento' => $evento->id ])}}"><h5 style="border: 1px #8abd51 solid; background-color:#8abd51; padding: 3%;">Tienda</h5></a>
            @endif
           </li>
    @endforeach
    
	</ul>
</div></div></div></div>
</tbody>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>

@endsection