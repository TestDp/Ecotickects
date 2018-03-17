var urlBase = "/Ecotickects/public/"; //SE DEBE VALIDAR CUAL ES LA URL EN LA QUE SE ESTA CORRIENDO LA APP
function RegistrarUsuario () {
    var form = $("#formularioEvento");
    var token = $("#_token").val()
    $.ajax({
        type: 'POST',
        url: urlBase + 'registrarAsistentePago',//primero el modulo/controlador/metodo que esta en el controlador
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        dataType: "JSON",
        success: function (result) {
            if (result.respuesta) {
                $('#merchantId').val(result.info.merchantId);
                $('#accountId').val(result.info.accountId);
                $('#description').val(result.info.description);
                $('#referenceCode').val(result.info.referenceCode);
                $('#amount').val(result.info.amount);
                $('#tax').val(result.info.tax);
                $('#taxReturnBase').val(result.info.taxReturnBase);
                $('#currency').val(result.info.currency);
                $('#signature').val(result.info.signature);
                $('#test').val(result.info.test);
                $('#buyerEmail').val(result.info.buyerEmail);
                $('#responseUrl').val(result.info.responseUrl);
                $('#confirmationUrl').val(result.info.confirmationUrl);
                $("#formPago").submit();
            }else{
                $('#formAsistente').attr("hidden","hidden");
            }
        }
    });
}

function mostrarPrecioBoleta() {
    $("#valorBoleta").val($("#localidad").find('option:selected').data('num'));
    calcularPrecioTotal();
}

function calcularPrecioTotal() {
    $("#PrecioTotal").val($("#valorBoleta").val()*$("#CantidadTickets").val());
}


function generarQRCodePago(nombreEvento,pinBoleta)
{
    var qr = create_qrcode(nombreEvento +" - CC - " + pinBoleta + "ECOTICKETS" );
    $("#qrBoleta").html(qr);
}