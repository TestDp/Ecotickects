@extends('layouts.profile')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="panel panel-success">
                <div class="panel-heading"><h3>Usuarios</h3></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <button onclick="ajaxRenderSectionCrearUsuario()" type="button" class="btn btn-success">Nuevo Usuario</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered" id="tablaUsuarios">
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Editar Usuario</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listUsuarios as $usuario)
                                    <tr>
                                        <th scope="row">{{$usuario->id}}</th>
                                        <td>{{$usuario->name}} {{$usuario->last_name}}</td>
                                        <td>{{$usuario->username}}</td>
                                        <td>{{$usuario->email}}</td>
                                        <td> <button onclick="ajaxRenderSectionEditarUsuario({{$usuario->id}})" type="button" class="btn btn-default" aria-label="Left Align" title="Editar Usuario">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                                            </button>
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
    </div>

    <link href="{{asset('js/Plugins/data-table/datatables.css')}}" rel="stylesheet">
    <!-- Plugins-->
    <script src="{{asset('js/Plugins/data-table/datatables.js')}}"></script>
    <!-- propias-->
    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/MSistema/Usuario.js') }}"></script>


    <script type="text/javascript">
        // Material Select Initialization
        $(document).ready(function() {
            $('#tablaUsuarios').DataTable({
                dom: 'B<"clear">lfrtip',
                buttons: {
                    name: 'primary',
                    text: 'Save current page'
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
