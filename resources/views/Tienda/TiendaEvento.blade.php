@extends('layouts.eventos')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div style="background-color:#8abd51 !important; padding-top: 2%;" class="panel-heading text-center"><h3>Tienda</h3></div>
                    <div style="overflow-x:auto; padding: 2%;">
                        <div style="padding-top:1%;" class="row">
                            <div class="col-md-6">
                                @foreach($productos as $Producto)
                                    <div class="col-md-4" id="producto" name="producto">
                                        <button onclick="agregarProductoAlCarrito(this)">
                                            <img style="width:100%;" src="{{$rutaImagenes.$Producto->Imagen_Producto}}" />
                                        </button>
                                        <input type="hidden" id="precio" name="precio" value="{{$Producto->precio}}">
                                        <input type="hidden" id="idProducto" name="idProducto" value="{{$Producto->id}}">
                                        <input type="hidden" id="nombreProducto" name="nombreProducto" value="{{$Producto->Nombre_Producto}}">
                                        {{$Producto->Nombre_Producto}}</br>
										<b>${{$Producto->precio}}</b>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <form id="crearCompra" >
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                    <div style="overflow-x:auto;">
                                        <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaListaProductos" class="table table-bordered">
                                            <thead>
                                            <tr >
                                                <th >
                                                    Producto
                                                </th>
                                                <th >
                                                    Precio
                                                </th>
                                                <th>
                                                    Cantidad
                                                </th>
                                                <th>Subtotal</th>
                                                <th>

                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="listaProductos" >
                                            </tbody>
                                            <tfoot>
                                            <th></th>
                                            <th></th>
                                            <th >
                                                total
                                            </th>
                                            <th id="total"></th>
                                            </tfoot>
                                        </table>
                                    </div>
                                    Correo Electrónico
                                    <input style="margin-bottom: 2%;" type="text" class="form-control" id="CorreoComprador" name="CorreoComprador"/>
                                    <input type="hidden" class="form-control" id="Evento_id" name="Evento_id" value="{{$idEvento}}"/>
                                    <input onclick="validarCamposFormularioCompra()" class="btn btn-blue ripple trial-button" value="Comprar"/>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <form method="post" id="formPago" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
        <input id="merchantId"  name="merchantId"    type="hidden"  value="">
        <input id="accountId"   name="accountId"     type="hidden"  value="">
        <input id="description" name="description"   type="hidden"  value="">
        <input id="referenceCode" name="referenceCode" type="hidden"  value="">
        <input id="amount"  name="amount"        type="hidden"  value="">
        <input id="tax"  name="tax"           type="hidden"  value="">
        <input id="taxReturnBase" name="taxReturnBase" type="hidden"  value="">
        <input id="currency" name="currency"      type="hidden"  value="">
        <input id="signature" name="signature"     type="hidden"  value="">
        <input id="test" name="test"          type="hidden"  value="">
        <input id="buyerEmail" name="buyerEmail"    type="hidden"  value="">
        <input id="responseUrl"  name="responseUrl"    type="hidden"  value="">
        <input id="confirmationUrl" name="confirmationUrl"    type="hidden"  value="">
    </form>
    <script src="{{ asset('js/Tienda/Tienda.js') }}"></script>
@endsection
