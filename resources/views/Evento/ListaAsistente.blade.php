@extends('layouts.eventos')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Lista de Asistentes</h3></div>
                    <div class="panel-body">
                        <table id="TablaListaAsistentes"  class="table table-bordered">
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
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($ListaAsistentes["Asistentes"] as $asistente)
                            <tr >
                                <th>
                                  {{$asistente->Identificacion}}
                                </th>
                                <th>
                                    {{$asistente->Nombres}}
                                </th>
                                <th>
                                    {{$asistente->Apellidos}}
                                </th>
                                <th>
                                    {{$asistente->telefono}}
                                </th>
                                <th>
                                    {{$asistente->Email}}
                                </th>
                                <th>
                                    {{$asistente->ciudad->Nombre_Ciudad}}
                                </th>
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