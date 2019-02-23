@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Usuarios Registrados</h3></div>
                    <div style="overflow-x:auto;" class="panel-body">
						<table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaListaAsistentes" class="table table-bordered">
                            <thead>
                            <tr >
                                <th>
                                    Identificación
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Apellidos
                                </th>
                                <th>
                                    Celular
                                </th>
                                <th>
                                    Correo
                                </th>
                                <th>
                                    Ciudad
                                </th>
                                <th>
                                    CantidadBoletas
                                </th>
                                <th>
                                    TotalCompra
                                </th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($ListaAsistentes["Asistentes"] as $asistente)
                            <tr >
                                <td>
                                  {{$asistente->Identificacion}}
                                </td>
                                <td>
                                    {{$asistente->Nombres}}
                                </td>
                                <td>
                                    {{$asistente->Apellidos}}
                                </td>
                                <td>
                                    {{$asistente->telefono}}
                                </td>
                                <td>
                                    {{$asistente->Email}}
                                </td>
                                <td>
                                    {{$asistente->ciudad->Nombre_Ciudad}}
                                </td>
                                <td>
                                    {{$asistente->CantidadBoletas}}
                                </td>
                                <td>
                                    {{$asistente->PrecioTotal}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>



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
@endsection