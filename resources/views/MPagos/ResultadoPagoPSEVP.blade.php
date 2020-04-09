@section('ResultadoPagoPSEVP')
    <div class="container">
        <div class="row">
            <div class="panel panel-success">
                <div class="panel-heading">Resultado de la operación</div>
                <div class="panel-body">
                    <table style="width:100%" class="table table-bordered">
                        <tbody id="TablasDetallePedido">
                        <tr>
                            <td>Empresa</td>
                            <td>{{$InfoPago->Empresa}}</td>
                        </tr>
                        <tr>
                            <td>NIT</td>
                            <td>{{$InfoPago->NIT}} </td>
                        </tr>
                        <tr>
                            <td>Fecha</td>
                            <td>{{$InfoPago->Fecha}} </td>
                        </tr>
                        <tr>
                            <td>Estado</td>
                            <td>{{$InfoPago->Estado}} </td>
                        </tr>
                        <tr>
                            <td>Referencia de pedido</td>
                            <td>{{$InfoPago->RefPedido}} </td>
                        </tr>
                        <tr>
                            <td>Referencia transacción</td>
                            <td>{{$InfoPago->RefTrasaccion}} </td>
                        </tr>
                        <tr>
                            <td>Número transacción</td>
                            <td>{{$InfoPago->NumTransaccion}} </td>
                        </tr>
                        <tr>
                            <td>Banco</td>
                            <td>{{$InfoPago->Banco}} </td>
                        </tr>
                        <tr>
                            <td>Valor</td>
                            <td>{{$InfoPago->Valor}} </td>
                        </tr>
                        <tr>
                            <td>Moneda</td>
                            <td>{{$InfoPago->Moneda}} </td>
                        </tr>
                        <tr>
                            <td>Descripción</td>
                            <td>{{$InfoPago->Descripcion}} </td>
                        </tr>
                        <tr>
                            <td>IP Origen</td>
                            <td>{{$InfoPago->IP}} </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-success" onclick="">Reitentar transacción</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-success" onclick="">Finalizar transacción</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
