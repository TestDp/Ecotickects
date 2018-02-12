@extends('layouts.eventos')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Bievenido a Ecotickets</h3></div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a class="btn btn-blue ripple trial-button" href="{{ url('FormularioEvento') }}">Crear Evento</a>
                        <table id="TablaListaEventos"  class="table table-bordered">
                            <thead>
                            <tr >
                                <th >
                                    Id
                                </th>
                                <th >
                                    Tipo
                                </th>
                                <th >
                                    Nombre
                                </th>
                                <th >
                                    Lugar
                                </th>
                                <th >
                                    Ciudad
                                </th>
                                <th >
                                    Departamento
                                </th>
                                <th >
                                    Fecha del Evento
                                </th>
                                <th >
                                    Fecha Inicial de registro
                                </th>
                                <th >
                                    Fecha Final de registro
                                </th>
                                <th >
                                    Asistentes
                                </th>
                                <th >
                                    Estadísticas
                                </th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($ListaEventos["eventos"] as $evento)
                                <tr>
                                    <td >
                                        {{ $evento->id }}
                                    </td>
                                    <td >
                                    {{ $evento->Tipo_Evento }}
                                    <td >
                                        {{ $evento->Nombre_Evento }}
                                    </td>
                                    <td >
                                        {{ $evento->Lugar_Evento }}
                                    </td>
                                    <td >
                                        {{ $evento->ciudad->Nombre_Ciudad }}
                                    </td>
                                    <td>
                                        {{ $evento->ciudad->departamento->Nombre_Departamento }}
                                    </td>
                                    <td >
                                        {{ $evento->Fecha_Evento }}
                                    </td>
                                    <td >
                                        {{ $evento->Fecha_Inicial_Registro }}
                                    </td>
                                    <td>
                                        {{ $evento->Fecha_Final_Registro }}
                                    </td>
                                    <td>
                                        <a class="btn btn-blue ripple trial-button" href="{{ url('/ListaAsistentes',['idEvento' => $evento->id ]) }}">ver</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-blue ripple trial-button" href="{{ url('/Estadisticas',['idEvento' => $evento->id ]) }}">ver</a>
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


    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#TablaListaEventos').DataTable({
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
