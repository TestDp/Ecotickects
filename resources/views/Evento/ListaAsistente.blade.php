@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Usuarios Registrados  {{$evento->Nombre_Evento}}</h3></div>
                        <div style="overflow-x:auto;" class="panel-body">
                            <ul class="nav nav-tabs" >
                                <li class="active">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#ListaAsistentes" role="tab" aria-controls="home"
                                       aria-selected="true">Lista Asistentes</a>
                                </li>
                                <li>
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ListaInvitados" role="tab" aria-controls="profile"
                                       aria-selected="false">Lista Invitados</a>

                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade in active" id="ListaAsistentes" role="tabpanel" aria-labelledby="home-tab">
                                    <div style="overflow-x:auto;">
                                        <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaListaAsistentes" class="table table-bordered">
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
                                    <th>
                                        CantidadBoletas
                                    </th>
                                    <th>
                                        TotalCompra
                                    </th>
                                </tr>
                                </thead>
                                <tbody >
                                @foreach($ListaAsistentes["asistentes"] as $asistente)
                                    <tr >
                                        <td>
                                            {{$asistente->Identificacion}}
                                        </td>
                                        <td>
                                            {{$asistente->Nombres}}
                                        </td>
                                        <td>
                                            {{$asistente->Apellidos}}
                                        </td>
                                        <td>
                                            {{$asistente->telefono}}
                                        </td>
                                        <td>
                                            {{$asistente->Email}}
                                        </td>
                                        <td>
                                            {{$asistente->Nombre_Ciudad}}
                                        </td>
                                        <td>
                                            {{$asistente->CantidadBoletas}}
                                        </td>
                                        <td>
                                            {{$asistente->PrecioTotal}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
							<button class="btn btn-info navbar-btn" onclick="tableToExcel('TablaListaAsistentes', 'W3C Example Table')">Exportar Lista Asistentes</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="ListaInvitados" role="tabpanel" aria-labelledby="home-tab">
                                    <div style="overflow-x:auto;">
                                        <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaListaAsistentes" class="table table-bordered">
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
                                            @foreach($ListaAsistentesGuestList["asistentesGuestList"] as $asistenteGL)
                                                <tr >
                                                    <td>
                                                        {{$asistenteGL->Identificacion}}
                                                    </td>
                                                    <td>
                                                        {{$asistenteGL->Nombres}}
                                                    </td>
                                                    <td>
                                                        {{$asistenteGL->Apellidos}}
                                                    </td>
                                                    <td>
                                                        {{$asistenteGL->telefono}}
                                                    </td>
                                                    <td>
                                                        {{$asistenteGL->Email}}
                                                    </td>
                                                    <td>
                                                        {{$asistenteGL->Nombre_Ciudad}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>
										<button class="btn btn-info navbar-btn" onclick="tableToExcel('TablaListaAsistentes', 'W3C Example Table')">Exportar Lista Invitados</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#TablaListaAsistentes').DataTable({
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
	<script type="text/javascript">
		var tableToExcel = (function() {
		  var uri = 'data:application/vnd.ms-excel;base64,'
			, template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
			, base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
			, format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
		  return function(table, name) {
			if (!table.nodeType) table = document.getElementById(table)
			var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
			window.location.href = uri + base64(format(template, ctx))
		  }
		})()
</script>
@endsection