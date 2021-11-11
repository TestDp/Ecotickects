@extends('layouts.internas')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Liquidación Boleteria {{ $ListaEtapas["Etapas"]->evento ->Nombre_Evento }}</h3></div>
                    <div style="overflow-x:auto;" class="panel-body">
						<table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaLiquidacion" class="table table-bordered">
                            <thead>
                            <tr >
                                <th>
                                    Precio Etapa
                                </th>
                                <th>
                                    Cantidad Boletas
                                </th>
                                <th>
                                    Total Etapa
                                </th>
                                <th>
                                    Porcentaje
                                </th>
                                <th>
                                    Comisión x Boleta
                                </th>
                                <th>
                                    Total liquidar
                                </th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($ListaEtapas["Etapas"] as $etapa)
                            <tr >
                                <td>
                                  {{$etapa->PrecioEtapa}}
                                </td>
                                <td>
                                    {{$etapa->CantidadBoletas}}
                                </td>
                                <td>
                                    {{$etapa->TotalEtapa}}
                                </td>
                                <td>
                                    {{$etapa->Porcentaje}}
                                </td>
                                <td>
                                    {{$etapa->ComisionXBoleta}}
                                </td>
                                <td>
                                    {{$etapa->Total}}
                                </td>
                            </tr>
                            @endforeach

                            </tbody>

                        </table>

                        <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaLiquidacion" class="table table-bordered">
                            <thead>
                            <tr >
                                <th>
                                    Total Boletas
                                </th>
                                <th>
                                    {{$ListaEtapas["Etapas"]->CantidadTotal}}
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
                                    {{$ListaEtapas["Etapas"]->TotalGeneral}}
                                </th>
                            </tr>
                            </thead>

                        </table>
                        <div class="panel-body">
                            <input type="hidden" id="idevento" value="{{$ListaEtapas["Etapas"]->idEvento}}">
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
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#TablaListaAsistentes').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: {
                    name: 'primary',
                    text: 'Save current page',
                    buttons: [
                        { extend: 'excel', text: '<p style="color: green !important; font-size: 20px; text-align: center;"><img src="http://estebanquinteroc.com/wp-content/uploads/2017/10/icono-excel.png"></img>Exportar lista</p>' }
                    ]
                },
                language: {
                    "lengthMenu": "Registros por página _MENU_",
                    "info":"Mostrando del _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty":"Mostrando del 0 a 0 de 0 registros",
                    "infoFiltered": "(Registros filtrados _MAX_ )",
                    "zeroRecords": "No hay registros",
                    "search": "Buscador:",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                }
            });
        });
    </script>
    <script src="{{ asset('js/Plugins/Chart/Chart.js') }}"></script>
    <script src="{{ asset('js/Plugins/Gauge/gauge.js') }}"></script>
    <!--script src="{{ asset('http://bernii.github.com/gauge.js/dist/gauge.js') }}"></script-->

    <script>
        $(document).ready(function () {
            construirGraficoLiquidacion();
            construirBarrasAsistentesCiudades();

        });
    </script>
@endsection