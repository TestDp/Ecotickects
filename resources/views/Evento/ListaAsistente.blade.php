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
                                  {{  $asistente->Identificacion}}
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

                                </th>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
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
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
@endsection