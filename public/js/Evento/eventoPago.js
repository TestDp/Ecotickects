//var urlBase = "/Eco-Tortoise/trunk/public/"; //SE DEBE VALIDAR CUAL ES LA URL EN LA QUE SE ESTA CORRIENDO LA APP
try {
    urlBase = obtenerUlrBase();
} catch (e) {
    console.error(e.message);
    throw new Error("El modulo transversales es requerido");
};


//var urlBase = "/Ecotickects/trunk/public/"; //SE DEBE VALIDAR CUAL ES LA URL EN LA QUE SE ESTA CORRIENDO LA APP
function RegistrarUsuario () {
    var form = $("#formularioEvento");
    var token = $("#_token").val()
    $.ajax({
        type: 'POST',
        url: urlBase + 'FormularioAsistentePago',//primero el modulo/controlador/metodo que esta en el controlador
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

function validarCamposRegistrarAsistente() {
    validarFormularioPago();
    if ($("#formularioEvento").valid()) {
        RegistrarUsuario();
    }
}




function validarFormularioPago(){
    $("#formularioEvento").validate({
        rules: {
            Nombres: {
                required: true
                // minlength: 2
            },
            Apellidos: {
                required: true
            },
            Identificacion: {
                required: true
            },
            telefono: {
                required: true
            },
            Email: {
                required: true,
                email: true
            },
            confEmail: {
                equalTo: "#Email",
                email: true
            },
            Departamento_id: {
                required: true
            },
            Ciudad_id: {
                required: true
            },
            genero: {
                required: true
            },
            Edad: {
                required: true,
                //min: 18
            },
            terminos: {
                required: true
            },
            HabeasData: {
                required: true
            },
            localidad: {
                required: true
            },
            CantidadTickets: {
                required: true
            },
            'Respuesta_id[0]': {
                required: true
            },
            'Respuesta_id[1]': {
                required: true
            },
            'Respuesta_id[2]': {
                required: true
            },
            'Respuesta_id[3]': {
                required: true
            },
            'Respuesta_id[4]': {
                required: true
            },
            'Respuesta_id[5]': {
                required: true
            },
            'Respuesta_id[6]': {
                required: true
            },
            'Respuesta_id[7]': {
                required: true
            },
            'Respuesta_id[8]': {
                required: true
            },
            'Respuesta_id[9]': {
                required: true
            },
            'Respuesta_id[10]': {
                required: true
            },
            'Respuesta_id[11]': {
                required: true
            },
            'Respuesta_id[12]': {
                required: true
            },
            'Respuesta_id[13]': {
                required: true
            },
            'Respuesta_id[14]': {
                required: true
            },
            'Respuesta_id[15]': {
                required: true
            },
            'Respuesta_id[16]': {
                required: true
            },
            'Respuesta_id[17]': {
                required: true
            },
            'Respuesta_id[18]': {
                required: true
            },

        },
        messages: {
            Nombres: {
                required: "*El nombre es obligatorio"
            },
            Apellidos: {
                required: "*El apellido es obligatorio"
            },
            Identificacion: {
                required: "*La identificación es obligatorio"
            },
            telefono: {
                required: "*El telefono es obligatorio"
            },
            Email: {
                required: "*El email es obligatorio",
                email: "Se debe  ingresar un correo valido"
            },
            confEmail: {
                equalTo: "*Los correos debe ser iguales",
                email: "Se debe  ingresar un correo valido"
            },
            Departamento_id: {
                required: "*El departamento es obligatorio"
            },
            Ciudad_id: {
                required: "*La ciudad es obligatoria"
            },
            genero: {
                required: "*El rol es obligatorio"
            },
            Edad: {
                required: "*La edad es obligatoria"  ,
                //min: "*Debes ser mayor de edad para asistir al evento"
            },
            terminos: {
                required: "*Los términos son obligatorios"
            },
            HabeasData: {
                required: "*El  HabeasData es obligatorio"
            },
            localidad: {
                required: "*La localidad es obligatoria"
            },
            CantidadTickets: {
                required: "*La cantidad de Tickets es obligatoria"
            },
            'Respuesta_id[0]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[1]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[2]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[3]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[4]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[5]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[6]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[7]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[8]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[9]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[10]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[11]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[12]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[13]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[14]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[15]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[16]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[17]': {
                required: "*Seleccione una opción por favor"
            },
            'Respuesta_id[18]': {
                required: "*Seleccione una opción por favor"
            },

        }

    });

}

function validarCodigoPromocional(element,idEvento) {
    var CodigoPromocional ="";
    CodigoPromocional = $(element).value();

    $.ajax({
        type: 'GET',
        url: urlBase+'ValidarCodigoPromo/'+idEvento+'/'+CodigoPromocional,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            CodigoPromocional: CodigoPromocional,
            idEvento:idEvento,
            _token :$("#_token").val()
        },
        dataType: 'json',
        success: function (result) {
            if (result) {
                //$("#valorBoleta").val($("#localidad").find('option:selected').data('num'));
                //$("#PrecioTotal").val($("#valorBoleta").val()*$("#CantidadTickets").val());
                //$('#listaUsuarios').empty().append($(data));
                $('#localidad').empty().append($(result.preciosBoletas));
                $("#localidad").val(result.preciosBoletas->localidad);

            }
        },
        error: function (result) {
            var errors = result.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);

                });
            }
        }
    });
}



function ActivarEsPago (element,idEvento) {
    var FlagEsActivo ="";
     if($(element).prop( "checked" ))
     {
         FlagEsActivo =1;
     }else{
         FlagEsActivo =0;
     }

    $.ajax({
        url: urlBase+'ActivarEventoPago/'+idEvento+'/'+FlagEsActivo,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            FlagEsActivo: FlagEsActivo,
            idEvento:idEvento,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {

            }
        }
    });
}

function ActivarTienda (element,idEvento) {
    var FlagEsActivo ="";
    if($(element).prop( "checked" ))
    {
        FlagEsActivo =1;
    }else{
        FlagEsActivo =0;
    }
    $.ajax({
        url: urlBase+'ActivarTienda/'+idEvento+'/'+FlagEsActivo,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            FlagEsActivo: FlagEsActivo,
            idEvento:idEvento,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {

            }
        }
    });
}

function ActivarSolicitarPIN (element,idEvento) {
    var FlagEsActivo ="";
    if($(element).prop( "checked" ))
    {
        FlagEsActivo =1;
    }else{
        FlagEsActivo =0;
    }
    $.ajax({
        url: urlBase+'ActivarSolicitarPIN/'+idEvento+'/'+FlagEsActivo,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            FlagEsActivo: FlagEsActivo,
            idEvento:idEvento,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {

            }
        }
    });
}

function ActivarEsPublico (element,idEvento) {
    var FlagEsActivo ="";
    if($(element).prop( "checked" ))
    {
        FlagEsActivo =1;
    }else{
        FlagEsActivo =0;
    }
    $.ajax({
        url: urlBase+'ActivarEsPublico/'+idEvento+'/'+FlagEsActivo,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            FlagEsActivo: FlagEsActivo,
            idEvento:idEvento,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {

            }
        }
    });
}