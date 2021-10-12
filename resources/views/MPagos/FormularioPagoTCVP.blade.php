@section('FomularioPagoTD')
    <form id="formPagoTC">


    <input type="hidden" id="tipoTC" name="tipoTC" value="{{$tipoTC}}">
        <div class="row">
            <div class="col-md-5">
                <label>Nombre en la tarjeta *</label>
            </div>
            <div class="col-md-7">
                <input type="text"  id="nombrePagador" name="nombrePagador" class="form-control"
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
                <label>Número de tarjeta *</label>
            </div>
            <div class="col-md-7">
                <input type="number" class="form-control" id="numeroTarjeta" name="numeroTarjeta" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <label>Código de seguridad *</label>
            </div>
            <div class="col-md-3">
                <input type="number" maxlength="3" minlength="3"  class="form-control" placeholder="000"
                       id="codigoTarjeta" name="codigoTarjeta"  />
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <label>Fecha Vencimiento *</label>
            </div>
            <div class="col-md-3">
                <select id="mesVenc" name="mesVenc" class="form-control">
                    <option value="">mes</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="04">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
            <div class="col-md-3">
                <select id="anioVenc" name="anioVenc" class="form-control">
                    <option value="">año</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    <option value="32">32</option>
                    <option value="33">33</option>
                    <option value="34">34</option>
                    <option value="35">35</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <label>Cuotas *</label>
            </div>
            <div class="col-md-3">
                <select id="numeroCuotas" name="numeroCuotas" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    <option value="32">32</option>
                    <option value="33">33</option>
                    <option value="34">34</option>
                    <option value="35">35</option>
                    <option value="36">36</option>
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
            <button type="button" class="btn btn-success" onclick="validarCamposFormPagoTC()">Pagar</button>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    </form>
@endsection
