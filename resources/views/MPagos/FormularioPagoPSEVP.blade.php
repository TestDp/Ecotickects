@section('FomularioPagoPSE')
<form id="formPagoPSE">

<div>
    <div class="row">
        <div class="col-md-5">
            <label>Banco *</label>
        </div>
        <div class="col-md-7">
            <input type="hidden"  id="nombreBanco" name="nombreBanco" value=""/>
            <select id="banco" name="banco" class="form-control" onchange="guardarNombreBanco()">
                @foreach($listaBancos as $banco)
                    <option value="{{ $banco->pseCode }}">{{ $banco->description }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label>Nombre del titular *</label>
        </div>
        <div class="col-md-7">
            <input type="text"  id="nombreTitular" name="nombreTitular" class="form-control"
                   placeholder="Nombre completo" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label>Documento de identificación *</label>
        </div>
        <div class="col-md-3">
            <select id="tipoDoc" name="tipoDoc" class="form-control">
                <option value="">Tipo</option>
                <option value="CC">CC-Cédula de ciudadanía.</option>
                <option value="CE">CE-Cédula de extranjería..</option>
                <option value="NIT">NIT-Número de identificación triburaria.</option>
                <option value="PP">PP-Pasaporte.</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="number" class="form-control" id="documentoPagador" name="documentoPagador" />
        </div>
    </div>


    <div class="row">
        <div class="col-md-5">
            <label>Tipo Cliente *</label>
        </div>
        <div class="col-md-7">
            <select id="tipoCliente" name="tipoCliente" class="form-control">
                <option value="N">Natural</option>
                <option value="J">Juridica</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label>Teléfono Celular *</label>
        </div>
        <div class="col-md-7">
            <input type="number" class="form-control" id="numeroTel" name="numeroTel"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-success" onclick="validarCamposFormPagoPSE()">Pagar</button>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
</form>
@endsection
