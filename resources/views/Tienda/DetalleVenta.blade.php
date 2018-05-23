@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Detalle de venta</h3></div>
                    <div style="overflow-x:auto;">
                        <div class="row">
                            <div class="col-md-2">
                                <h4># de Compra</h4>
                                {{$factura->id}}
                            </div>
                            <div class="col-md-3">
                                <h4>Correo Comprador</h4>
                                {{$factura->CorreoComprador}}
                            </div>
                            <div class="col-md-3">
                                <h4>Total venta</h4>
                                {{$factura->PrecioTotal}}
                            </div>
                            <div class="col-md-2">
                                <h4>Cancelada</h4>
                                @if($factura->Cancelada ==1)
                                    SI
                                @else
                                    NO
                                @endif
                            </div>
                            <div class="col-md-2">
                                <h4>Despachada</h4>
                                <label id="despacha">
                                @if($factura->despachado ==1)
                                    SI
                                @else
                                    NO
                                @endif
                                </label>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                    <div style="overflow-x:auto;">
                                        <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaListaProductos" class="table table-bordered">
                                            <thead>
                                            <tr >
                                                <th >
                                                    codigo
                                                </th>
                                                <th >
                                                    Producto
                                                </th>
                                                <th >
                                                    Precio
                                                </th>
                                                <th>
                                                    cantidad
                                                </th>
                                                <th>subtotal</th>

                                            </tr>
                                            </thead>
                                            <tbody id="listaProductos" >
                                            @foreach($detallesFactura as $detalle)
                                            <tr>
                                                <td >
                                                    {{ $detalle->producto->Codigo }}
                                                </td>
                                                <td >
                                                    {{ $detalle->producto->Nombre_Producto}}
                                                </td>
                                                <td >
                                                    {{ $detalle->producto->precio }}
                                                </td>
                                                <td>
                                                    {{ $detalle->cantidad }}
                                                </td>
                                                <td>
                                                    {{ $detalle->subTotal }}
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th >
                                                total
                                            </th>
                                            <th id="total">
                                                {{$factura->PrecioTotal}}
                                            </th>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <button onclick="despacharVenta({{$factura->id}})" >Despachar</button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/Tienda/Tienda.js') }}"></script>
@endsection
