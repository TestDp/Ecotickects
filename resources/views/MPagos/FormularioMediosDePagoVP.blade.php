@section('FomularioMediosDePago')
        <div id="divTC">
            <h4>Tarjetas de credito</h4>
            <div class="row">
                <div class="col-md-3">
                    <a  id="aVisa" name="aVisa" class="navbar-brand"  onclick="AgregarVlrPagoTC('VISA')" style="cursor:pointer;">
                        <img style="height: auto !important;" src="../img/icono_visa.png" data-active-url="../img/icono_visa.png" alt=""  width="100%" height="100%"/>
                    </a>
                </div>
                <div class="col-md-3">
                    <a id="aMasterCard" class="navbar-brand" onclick="AgregarVlrPagoTC('MASTERCARD')" style="cursor:pointer;">
                        <img style="height: auto !important;" src="../img/icono_mastercard.png" data-active-url="../img/icono_visa.png" alt=""  width="100%" height="100%"/>
                    </a>
                </div>
                <div class="col-md-3">
                    <a id="aAmex" name="aAmex" class="navbar-brand" onclick="AgregarVlrPagoTC('AMEX')" style="cursor:pointer;">
                        <img style="height: auto !important;" src="../img/icono_amex.png" data-active-url="../img/icono_visa.png" alt="" width="100%" height="100%"/>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <a id="aDiners" name="aDiners" class="navbar-brand" onclick="AgregarVlrPagoTC('DINERS')" style="cursor:pointer;">
                        <img style="height: auto !important;" src="../img/icono_diners.png" data-active-url="../img/icono_visa.png" alt="" width="100%" height="100%"/>
                    </a>
                </div>
                <div class="col-md-3">
                    <a id="aCodensa" name="aCodensa" class="navbar-brand" onclick="AgregarVlrPagoTC('CODENSA')" style="cursor:pointer;">
                        <img style="height: auto !important;" src="../img/icono_codensa.jpg" data-active-url="../img/icono_visa.png" alt="" width="100%" height="100%"/>
                    </a>
                </div>
            </div>
            <hr>
        </div>
        <div id="divPSE">
            <h4>Débito bancario PSE</h4>
            <div class="row">
                <div class="col-md-4">
                    <a id="aPSE" name="aPSE"  class="navbar-brand" onclick="cargarFormularioPagoPSE()" style="cursor:pointer;">
                        <img style="height: auto !important;" src="../img/icono_pse.jpg" data-active-url="../img/icono_visa.png" alt="" width="100%" height="100%"/>
                    </a>
                </div>
                <div class="col-md-8">
                    <div>
                        <label>
                            Recuerda verificar el monto máximo que tienes habilitado para pagos por internet.
                        </label>
                    </div>
                </div>
            </div>
            <hr>
        </div>
@endsection
