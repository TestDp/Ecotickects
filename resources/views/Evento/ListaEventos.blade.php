@extends('layouts.eventos')

@section('content')
	<div class="row title text-center">
								<h2 class="black">EVENTOS ECOTICKETS</h2>
	</div>
						<div style="padding-bottom:2%;" class="row">
							<div style="text-align: center;" class="col-md-12">
							<a class="btn btn-blue ripple trial-button" href="{{ URL::previous() }}">Atrás</a>
							</div>
						</div>
	<div style="overflow-x:auto;">
<table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaListaEventos" class="table table-bordered">
    <thead>
    <tr >

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
        <th></th>
        <th></th>
    </tr>
    </thead>

    <tbody >
    @foreach($ListaEventos["eventos"] as $evento)
        <tr>

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
                @if($evento->esPago)
                <a class="btn btn-blue ripple trial-button" href="{{url('FormularioAsistentePago', ['idEvento' => $evento->id ])}}">Registrarse</a>
                @else
                    <a class="btn btn-blue ripple trial-button" href="{{url('FormularioAsistente', ['idEvento' => $evento->id ])}}">Registrarse</a>
                @endif
            </td>
            <th>
                <form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
                    <input name="merchantId"    type="hidden"  value="508029">
                    <input name="accountId"     type="hidden"  value="512321">
                    <input name="description"   type="hidden"  value="Test PAYU">
                    <input name="referenceCode" type="hidden"  value="EcoPagos002">
                    <input name="amount"        type="hidden"  value="20000">
                    <input name="tax"           type="hidden"  value="3193">
                    <input name="taxReturnBase" type="hidden"  value="16806">
                    <input name="currency"      type="hidden"  value="COP">
                    <input name="signature"     type="hidden"  value="d211f38f6393e9776db24e5d9f66d12b">
                    <input name="test"          type="hidden"  value="1">
                    <input name="buyerEmail"    type="hidden"  value="cristianmg13@hotmail.com">
                    <input name="responseUrl"    type="hidden"  value="http://ecotickets.co">
                    <input name="confirmationUrl"    type="hidden"  value="http://ecotickets.co/Eventos">
                    <input name="Submit"        type="submit"  value="Enviar">
                </form>
            </th>
        </tr>
    @endforeach
    </tbody>
</table>
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