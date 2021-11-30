@extends('layouts.profile')

@section('content')

    <div class="row">
		<div class="col-sm-12">
              <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Generar enlace para promotores</h4>
                  </div>
                </div>
                <div class="card-body ">
				<div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">contacts</i>
                  </div>
                  <h4 class="card-title">Diligencia la información para generar un enlace para un promotor</h4>
                </div>
                <div class="card-body ">
				<div class="row">
					<div class="col-sm-4">
                    Seleccione el evento
					<div class="form-group">
                    <select id="Evento_id" name="Evento_id" onchange="CargarPromotores()" class="form-control">
                        <option value="">Seleccionar</option>
                        @foreach($eventos as $evento)
                            <option value="{{ $evento->id }}">{{ $evento->Nombre_Evento}}</option>
                        @endforeach
                    </select>
					</div>
					</div>
                <div class="col-sm-4">
                    Seleccione el promotor
					<div class="form-group">
                    <select id="Promotor_id" name="Promotor_id" onchange="CrearEnlacePromotor()" class="form-control">
                        <option value="">Seleccionar</option>
                    </select>
                </div>
				</div>
                <div class="col-sm-4">
                    Enlace
					<div class="input-group no-border">
                    <input id="enlace" name="enlace" type="text" class="form-control" readonly/>
					<button class="btn btn-rose btn-round btn-just-icon" onclick="myFunction()"><i class="material-icons">content_copy</i></button>
                </div>
				</div>
				</div>
                </div>				

              </div>
                </div>
              </div>
        </div>
    </div>
    <script src="{{ asset('js/Transversal/generales.js') }}"></script>
    <script src="{{ asset('js/Evento/eventoPago.js') }}"></script>
    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>
	
	<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("enlace");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);
  
  /* Alert the copied text */
  alert("El link se ha copiado exitosamente: " + copyText.value);
}
</script>


@endsection
