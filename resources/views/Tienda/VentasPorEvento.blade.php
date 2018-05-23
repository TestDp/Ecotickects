@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Ventas del evento {{$nombreEvento}}</h3></div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

						<div style="overflow-x:auto;">
						<table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaListaEventos" class="table table-bordered">
                            <thead>
                            <tr >
                                <th >
                                    Id
                                </th>
                                <th >
                                    Correo del Comprador
                                </th>
                                <th >
                                    Precio total
                                </th>

                                <th >
                                    Cancelada
                                </th>
                                <th >
                                    Despachado
                                </th>
								<th>
                                    Visualizar Detalle
                                </th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($VentasPorEvento as $factura)
                                <tr>
                                    <td >
                                        {{ $factura->id }}
                                    </td>
                                    <td >
                                        {{ $factura->CorreoComprador }}
                                    </td>
                                    <td >
                                        {{ $factura->PrecioTotal }}
                                    </td>
                                    <td >
                                        @if($factura->Cancelada ==1)
                                         SI
                                        @else
                                         NO
                                         @endif
                                    </td>
                                    <td >
                                        @if($factura->despachado ==1)
                                            SI
                                        @else
                                            NO
                                        @endif
                                    </td>

                                    <td>
                                        <a class="btn btn-blue ripple trial-button" href="{{ url('/DetalleVenta',['idFactura' => $factura->id ]) }}">ver</a>
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
