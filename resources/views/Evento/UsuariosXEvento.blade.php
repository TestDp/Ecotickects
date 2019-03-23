@section('UsuarioXEvento')
    <div class="col-md-12">
        <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" class="table table-bordered"  >
            <thead>
            <tr>
                <th scope="col">Identificación</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col"><input type="checkbox"  onclick="SelecTodosUsuarios(this)" checked/></th>
            </tr>
            </thead>
            <tbody id="tablaUsuarios">
            @foreach($listaUsuario as $usuario)
                <tr >
                    <td>{{$usuario->Identificacion}}</td>
                    <td>{{$usuario->Nombres}}</td>
                    <td>{{$usuario->Apellidos}}</td>
                    <td><input id="chkUsuario" name="chkUsuario" type="checkbox"   onclick="" checked/></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection