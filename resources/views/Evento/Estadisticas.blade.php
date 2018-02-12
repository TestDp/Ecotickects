@extends('layouts.eventos')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Estadísticas </div>
        <div class="panel-body">
            <input type="hidden" id="idevento" value="{{$idEvento}}">
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-sm-6">
                    <canvas id="canvas" class="img-responsive"></canvas>
                </div>
                <div class="col-sm-6">
                    <canvas id="canvasBarra" class="img-responsive"></canvas>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('js/Plugins/Chart/Chart.js') }}"></script>
    <script>
        $(document).ready(function () {
            construirGrafico();
            construirBarras();
        });
    </script>
    

@endsection