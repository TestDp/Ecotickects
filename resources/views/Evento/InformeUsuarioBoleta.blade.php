@extends('layouts.profile')

@section('content')

	    <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Informe Usuarios por Boleta {{ $ListaUsuarioBoleta["UsuarioBoleta"]->evento ->Nombre_Evento }}</h4>
                </div>
               <div class="card-body">
                  <div class="table-responsive">
						<table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaUsuarioPromotor" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    Localidad
                                </th>
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
                            @foreach($ListaUsuarioBoleta["UsuarioBoleta"] as $usuarioBoleta)
                            <tr>
                                <td>
                                    {{$usuarioBoleta->localidad}}
                                </td>
                                <td>
                                  {{$usuarioBoleta->PrecioEtapa}}
                                </td>
                                <td>
                                    {{$usuarioBoleta->Promotor}}
                                </td>
                                <td>
                                    {{$usuarioBoleta->CantidadBoletas}}
                                </td>
                                <td>
                                    {{$usuarioBoleta->TotalEtapa}}
                                </td>

                            </tr>
                            @endforeach

                            </tbody>

                        </table>

                                        <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Consolidado por localidad</h4>
                </div>


                        <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaUsuarioPromotor2" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    Localidad
                                </th>
                                <th>
                                    Precio Etapa
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
                            @foreach($ListaUsuarioBoleta2["UsuarioBoleta2"] as $usuarioBoleta2)
                                <tr>
                                    <td>
                                        {{$usuarioBoleta2->localidad}}
                                    </td>
                                    <td>
                                        {{$usuarioBoleta2->PrecioEtapa}}
                                    </td>

                                    <td>
                                        {{$usuarioBoleta2->CantidadBoletas}}
                                    </td>
                                    <td>
                                        {{$usuarioBoleta2->TotalEtapa}}
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                        <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaUsuarioPromotor" class="table table-bordered">
                            <thead>
                            <tr >
                                <th>
                                    Total Boletas
                                </th>
                                <th>
                                    {{$ListaUsuarioBoleta["UsuarioBoleta"]->CantidadTotal}}
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
                                    {{$ListaUsuarioBoleta["UsuarioBoleta"]->Total}}
                                </th>
                            </tr>
                            </thead>

                        </table>
                        <div class="panel-body">
                            <input type="hidden" id="idevento" value="{{$ListaUsuarioBoleta["UsuarioBoleta"]->idEvento}}">
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
            var table = $('#TablaUsuarioPromotor').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: {
                    name: 'primary',
                    text: 'Save current page',
                    buttons: [
                        { extend: 'excel', text: '<p class="btn btn-rose" style="color: green !important; font-size: 20px; text-align: center;">Exportar lista</p>' }
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
	    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#TablaUsuarioPromotor2').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: {
                    name: 'primary',
                    text: 'Save current page',
                    buttons: [
                        { extend: 'excel', text: '<p class="btn btn-rose" style="color: green !important; font-size: 20px; text-align: center;">Exportar lista</p>' }
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