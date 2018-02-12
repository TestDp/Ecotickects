@extends('layouts.eventos')

@section('content')
	<div class="row title text-center">
								<h2 class="black">EVENTOS ECOTICKETS</h2>
	</div>
<table id="TablaListaEventos" class="table table-bordered">
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
    </tr>
    </thead>
   <!-- <tfoot>
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
    </tr>
    </tfoot>-->
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
            <td><a class="btn btn-blue ripple trial-button" href="{{url('FormularioAsistente', ['idEvento' => $evento->id ])}}">Registrarse</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
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