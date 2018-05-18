@extends('layouts.eventos')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Tienda</h3></div>
                    <div style="overflow-x:auto;">
                        <div class="row">
                            <div class="col-md-6">
                                @foreach($productos as $Producto)
                                    <div class="col-md-4">
                                        <button>
                                            <img src="{{$rutaImagenes.$Producto->Imagen_Producto}}" />
                                        </button>
                                        ${{$Producto->precio}}
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <form id="crearEvento" action="crearEvento" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}"/>
                                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                                    <div style="overflow-x:auto;">
                                        <table style="border-collapse: collapse !important; border-spacing: 0 !important; width: 100% !important;" id="TablaListaProductos" class="table table-bordered">
                                            <thead>
                                            <tr >
                                                <th >
                                                    Producto
                                                </th>
                                                <th >
                                                    Valor
                                                </th>

                                            </tr>
                                            </thead>
                                            <tbody >
                                            @foreach($productos as $Producto)
                                                <tr>
                                                    <td >
                                                       xxx
                                                    </td>
                                                    <td >
                                                        5600
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <th >
                                                total
                                            </th>
                                            <th >
                                                3400
                                            </th>
                                            </tfoot>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection