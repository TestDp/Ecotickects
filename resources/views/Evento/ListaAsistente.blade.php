@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de Asistentes </div>
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
                            <tfoot>
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