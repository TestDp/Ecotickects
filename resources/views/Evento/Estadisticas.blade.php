@extends('layouts.profile')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Estadísticas </div>
        <div class="panel-body">
            <input type="hidden" id="idevento" value="{{$idEvento}}">
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                @if(Auth::user()->buscarRecurso('EstadisticaCantidadXAsistentes'))
                <div class="col-md-6">
                    <canvas id="canvasCantidadAsistentes" class="img-responsive"></canvas>
                </div>
               @endif
                @if(Auth::user()->buscarRecurso('EstadisticaAsistentesXFecha'))
				<div class="col-md-6">
                    <canvas id="canvasAsistentesXFecha" class="img-responsive"></canvas>
                </div>
                @endif
            </div>

			<div class="row">
                @if(Auth::user()->buscarRecurso('EstadisticaCiudadesXAsistens'))
                <div class="col-md-6">
                    <canvas style="height:600px !important;" id="canvasCiudadesAsistens" class="img-responsive"></canvas>
                </div>
                @endif
                @if(Auth::user()->buscarRecurso('EstadisticaEdadesXAsistentes'))
                    <div class="col-sm-6">
                        <canvas style="height:600px !important;" id="canvasEdadesAsistentes" class="img-responsive"></canvas>
                    </div>
                @endif
            </div>
            <div class="row">
                @if(Auth::user()->buscarRecurso('EstadisticaJuntAsistentes'))
                <div class="col-md-6">
                    <canvas style="height:600px !important;" id="canvasJuntAsistens" class="img-responsive"></canvas>
                </div>
                @endif
                @if(Auth::user()->buscarRecurso('EstadisticaKPI'))
                <div class="col-sm-6">
                    <canvas style="height:300px !important;" id="canvasKPI" class="img-responsive"></canvas>
                </div>
                @endif
            </div>
        </div>
    </div>
 
	<script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('js/Plugins/Chart/Chart.js') }}"></script>
    <script src="{{ asset('js/Plugins/Gauge/gauge.js') }}"></script>
    <!--script src="{{ asset('http://bernii.github.com/gauge.js/dist/gauge.js') }}"></script-->
   
    <script>
        $(document).ready(function () {
            construirGraficoCantidadAsistentes();
            construirBarrasAsistentesCiudades();
            construirBarrasAsistentesEdades();
            construirBarrasAsistentesXFecha();
            construirGraficoJuntas();
            construirGraficoKPI();
        });
    </script>
    

@endsection