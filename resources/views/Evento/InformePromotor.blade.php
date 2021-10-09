@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Informe Promotor {{ $ListaPromotor["Promotor"]->evento ->Nombre_Evento }}</h3></div>
                    <div style="overflow-x:auto;" class="panel-body">
						<table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaPromotor" class="table table-bordered">
                            <thead>
                            <tr >
                                <th>
                                    Precio Etapa
                                </th>
                                <th>
                                    Promotor
                                </th>
                                <th>
                                    Cantidad Boletas
                                </th>
                                <th>
                                    Total Etapa
                                </th>

                            </tr>
                            </thead>
                            <tbody >
                            @foreach($ListaPromotor["Promotor"] as $promotor)
                            <tr >
                                <td>
                                  {{$promotor->PrecioEtapa}}
                                </td>
                                <td>
                                    {{$promotor->Promotor}}
                                </td>
                                <td>
                                    {{$promotor->CantidadBoletas}}
                                </td>
                                <td>
                                    {{$promotor->TotalEtapa}}
                                </td>

                            </tr>
                            @endforeach

                            </tbody>

                        </table>

                        <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaPromotor" class="table table-bordered">
                            <thead>
                            <tr >
                                <th>
                                    Total Boletas
                                </th>
                                <th>
                                    {{$ListaPromotor["Promotor"]->CantidadTotal}}
                                </th>
                                <th style="visibility: hidden">>
                                    Total Etapa
                                </th>
                                <th style="visibility: hidden">>
                                    Porcentaje
                                </th>
                                <th>
                                    Total Liquidar
                                </th>
                                <th>

                                </th>
                            </tr>
                            </thead>

                        </table>
                        <div class="panel-body">
                            <input type="hidden" id="idevento" value="{{$ListaPromotor["Promotor"]->idEvento}}">
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <canvas id="canvasLiquidacion" class="img-responsive"></canvas>
                                </div>

                                <div class="col-md-6">
                                    <canvas style="height:600px !important;" id="canvasCiudadesAsistens" class="img-responsive"></canvas>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>





        </div>

    </div>


	<script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>

    <script src="{{ asset('js/Plugins/Chart/Chart.js') }}"></script>
    <script src="{{ asset('js/Plugins/Gauge/gauge.js') }}"></script>
    <!--script src="{{ asset('http://bernii.github.com/gauge.js/dist/gauge.js') }}"></script-->


@endsection