@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>{{$producto->Nombre_Producto}}</h3></div>
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            Eventos
                            <div style="margin:0px !important;" class="row">

                                <div class="col-md-4">

                                    <select id="Evento" name="Evento"  class="form-control">
                                        <option value="">Seleccionar</option>
                                        @foreach($eventoLista as $evento)
                                            <option value="{{ $evento->id }}">{{ $evento->Nombre_Evento }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="button" class="form-control" value="Activar" onclick="ActivarProducto({{$producto->id }})"/>
                                </div>
                            </div>

                            <hr/>
						<div style="overflow-x:auto;">
						<table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaListaEventos" class="table table-bordered">
                            <thead>
                            <tr >
                                <th >
                                    Id
                                </th>
                                <th >
                                    Nombre evento
                                </th>
                                <th >

                                </th>

                            </tr>
                            </thead>
                            <tbody >
                            @foreach($eventos as $evento)
                                <tr>
                                    <td >
                                        {{ $evento->id }}
                                    </td>
                                    <td >
                                        {{ $evento->Nombre_Evento }}
                                    </td>
                                    <td >
                                        <a class="btn btn-blue ripple trial-button" href="{{ url('DesactivarProducto',['idProducto' => $producto->id,'idEvento'=>$evento->id ]) }}">Desactivar</a>
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


    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Evento/eventoPago.js') }}"></script>
    <script src="{{ asset('js/Tienda/Tienda.js') }}"></script>

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
