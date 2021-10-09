@extends('layouts.profile')

@section('content')

    <div style="width:970px !important;" class="container">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h3>GENERAR ENLACE PROMOTORES</h3></div>
                <div style="text-align: left;" class="col-md-12">
                    <div class="panel-heading text-center"><a class="btn btn-blue ripple trial-button" href="{{ URL::previous() }}">Atrás</a></div>
                </div>
            </div>
            <div style="margin:0px !important;" class="row">
                <div class="col-md-4">
                    Seleccione el evento
                    <select id="Evento_id" name="Evento_id" class="form-control" onchange="CargarPromotores()">
                        <option value="">Seleccionar</option>
                        @foreach($eventos as $evento)
                            <option value="{{ $evento->id }}">{{ $evento->Nombre_Evento}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    Seleccione el promotor
                    <select id="Promotor_id" name="Promotor_id" class="form-control" onchange="CrearEnlacePromotor()" >
                        <option value="">Seleccionar</option>
                    </select>
                </div>
                <div class="col-md-4">
                    Enlace
                    <input id="enlace" name="enlace" type="text" class="form-control" readonly/>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Evento/eventoPago.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>


@endsection
