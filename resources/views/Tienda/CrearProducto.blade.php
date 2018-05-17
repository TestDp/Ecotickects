@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>CREAR PRODUCTO</h3></div>

                    <form id="crearEvento" action="crearProducto" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}"/>
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-6">
                                Código
                                <input id="Codigo" name="Codigo" type="text" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                Nombre
                                <input id="Nombre_Producto" name="Nombre_Producto" type="text" class="form-control" />
                            </div>
                        </div>
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-6">
                                Precio
                                <input id="precio" name="precio" type="number" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                Cantidad
                                <input id="cantidad" name="cantidad" type="number" class="form-control" />
                            </div>
                        </div>
                        <hr/>
                        <div style="margin:0px !important;" class="row">
                            <div class="col-md-12">
                                Imagen del Producto
                                <input type="file" class="form-control" name="Imagen_Producto" >
                            </div>
                        </div>
                        <hr style="border-top-color:lightslategray; width:100%" />
                        <div class="row">
                            <div style="margin-bottom:2%;" class="col-md-12">
                                <button type="submit" class="btn btn-blue ripple trial-button" >
                                    Crear Producto
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>











    <script src="{{ asset('js/Evento/eventos.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('js/Plugins/EditorTexto/ckeditor.js') }}"></script>

    <script type="text/javascript">
        CKEDITOR.replace('informacionEvento');
    </script>

@endsection