@extends('layouts.internas')

@section('content')
<div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Personas Registradas en {{$evento->Nombre_Evento}}</h4>
                </div>
               <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-shopping">
                      <thead>
                        <tr>
                          <th class="th-description">Identificación</th>
                          <th class="th-description">Nombre y apellido</th>
                          <th class="th-description">Celular y correo</th>
						  <th class="th-description">Localidad y ciudad</th>
                          <th class="th-description">Usuario vendedor</th>
						  <th class="th-description">Cantidad boletas</th>
						  <th class="th-description">Total compra</th>
                        </tr>
                      </thead>
                      <tbody>
					  @foreach($ListaAsistentes["asistentes"] as $asistente)
                        <tr>
                          <td class="td-name">{{$asistente->Identificacion}}</td>
                          <td class="td-name">
                            <a >{{$asistente->Nombres}}</a>
                            <br />
                            <small>{{$asistente->Apellidos}}</small>
                          </td>
						  <td class="td-name">
                            <a >{{$asistente->telefono}}</a>
                            <br />
                            <small>{{$asistente->Email}}</small>
                          </td>
						  <td class="td-name">
                            <a > <!--{{$asistente->Localidad}}--></a>
                            <br />
                            <small>{{$asistente->Nombre_Ciudad}}</small>
                          </td>
                          <td class="td-name">
                            <a>{{$asistente->UsuarioVendedor}}</a>
                          </td>
						  <td class="td-name">
                            <a>{{$asistente->CantidadBoletas}}</a>
                          </td>
						<td class="td-name">
                            <a>{{$asistente->PrecioTotal}}</a>
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
		
		<div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Personas invitadas a {{$evento->Nombre_Evento}}</h4>
                </div>
               <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-shopping">
                      <thead>
                        <tr>
                          <th class="th-description">Identificación</th>
                          <th class="th-description">Nombre y apellido</th>
                          <th class="th-description">Celular y correo</th>
						  <th class="th-description">Localidad y ciudad</th>
                        </tr>
                      </thead>
                      <tbody>
					  @foreach($ListaAsistentesGuestList["asistentesGuestList"] as $asistenteGL)
                        <tr>
                          <td class="td-name">{{$asistenteGL->Identificacion}}</td>
                          <td class="td-name">
                            <a >{{$asistenteGL->Nombres}}</a>
                            <br />
                            <small>{{$asistenteGL->Apellidos}}</small>
                          </td>
						  <td class="td-name">
                            <a >{{$asistenteGL->telefono}}</a>
                            <br />
                            <small>{{$asistenteGL->Email}}</small>
                          </td>
						  <td class="td-name">
                            <a > <!--{{$asistente->Localidad}}--></a>
                            <br />
                            <small>{{$asistenteGL->Nombre_Ciudad}}</small>
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