@extends('layouts.profile')

@section('content')
    <style type="text/css">
        ul#menu_arbol li {
            padding: 0 10px;
        }
        ul#menu_arbol ul {
            margin-left: 5px;
        }
    </style>
	
	 <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Crear Rol</h4>
                </div>
    <form id="formRol">
        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
        <input type="hidden" id="Empresa_id" name="Empresa_id" >
        <div class="container">
            <div class="row justify-content-center">
                <div class="panel panel-success">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nombre</label>
                                <input id="Nombre" name="Nombre" type="text" class="form-control">
                                    <span class="invalid-feedback" role="alert" id="errorNombre"></span>
                            </div>
                            <div class="col-md-4">
                                <label>Descripción</label>
                                <input id="Descripcion" name="Descripcion" type="text" class="form-control">
                                <span class="invalid-feedback" role="alert" id="errorDescripcion"></span>
                            </div>
                        </div>
						<div></div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul id="menu_arbol" class="nav">
                                    @foreach($listRecursos as $recursoPadre)
                                        @if($recursoPadre->RecursoSistemaPadre_id == null)
                                            <li name="liPadre" class="nav-item">
                                               <input name="idRecurso[]" type="checkbox" value="{{$recursoPadre->id}}" onclick="checkRecursosHijos(this)">
                                                <a href="#ul{{$recursoPadre->id}}" data-toggle="collapse">{{$recursoPadre->Descripcion}} <i>(Ver más)</i> </a>
                                                <div class="collapse" id="ul{{$recursoPadre->id}}">
												<ul class="nav" name="ulhijo">
                                                    @foreach($listRecursos as $recurso)
                                                        @if($recurso->RecursoSistemaPadre_id == $recursoPadre->id)
                                                            <li class="nav-item">
                                                                <input name="idRecurso[]" type="checkbox" value="{{$recurso->id}}" onclick="checkRecursoPadre(this)">{{$recurso->Descripcion}}
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
												</div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button onclick="GuardarRol()" type="button" class="btn btn-rose">Crear Rol</button>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
		 </div>

            </div>
        </div>
    </form>
    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/MSistema/Rol.js') }}"></script>

@endsection
