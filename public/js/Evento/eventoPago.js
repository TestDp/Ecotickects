
try {
    urlBase = obtenerUlrBase();
} catch (e) {
    console.error(e.message);
    throw new Error("El modulo transversales es requerido");
};


function RegistrarUsuario () {
    var form = $("#formularioEvento");
    var token = $("#_token").val();
    $.ajax({
        type: 'POST',
        url: urlBase + '/FormularioAsistentePago',//primero el modulo/controlador/metodo que esta en el controlador
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        dataType: "JSON",
        success: function (result) {
            var userAgent =  navigator.userAgent;
            //var cokkie = document.cookie;
            OcultarPopupposition();
            $('#eco').empty().append($(result));
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}


function RegistrarUsuarioTemp () {
    var form = $("#formularioEvento");
    var token = $("#_token").val()
    $.ajax({
        type: 'POST',
        url: urlBase + '/FormularioAsistentePago',//primero el modulo/controlador/metodo que esta en el controlador
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

function validarMaximoBoletas() {
    const cantidadInput = document.getElementById('CantidadTickets');
    const maxBoletas = parseInt(cantidadInput.getAttribute('max'));
    
    if (parseInt(cantidadInput.value) > maxBoletas) {
        swal({
            title: "Límite de boletas",
            text: "Solo puedes comprar hasta " + maxBoletas + " boletas para este evento.",
            icon: "warning",
            button: "OK",
        });
        cantidadInput.value = maxBoletas;
        calcularPrecioTotal(); // Recalcular el precio después de ajustar la cantidad
    } else if (parseInt(cantidadInput.value) < 1) {
        cantidadInput.value = 1;
        calcularPrecioTotal(); // Recalcular el precio después de ajustar la cantidad
    }
}

function generarQRCodePago(nombreEvento,pinBoleta) {
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
                required: true,
                min: 1,
                max: function() {
                    return parseInt(document.getElementById('CantidadTickets').getAttribute('max'));
                }
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
                required: "*La cantidad de Tickets es obligatoria",
                min: "*Debe seleccionar al menos 1 boleta",
                max: "*Solo puede comprar hasta " + document.getElementById('CantidadTickets').getAttribute('max') + " boletas para este evento"
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

function validarCodigoPromocional(idEvento) {
   var CodigoPromocional = $("#Codigo").val();
    $.ajax({
        type: 'GET',
        url: urlBase+'/ValidarCodigoPromo/'+idEvento+'/'+CodigoPromocional,
        dataType: 'json',
        success: function (result) {
            if (result) {
                if(result.length > 0) {
                    swal({
                        title: "Código activado!",
                        text: "su código fue activado con exito!",
                        icon: "success",
                        button: "OK",
                    });
					var nomLocalidad="";
                    $.each(result, function (ind, element) {
                        var opcion = new Option(element.localidad, element.id);
                        $(opcion).attr("data-num", element.precio);
                        $(opcion).attr("style", "color:green;");
                        nomLocalidad = nomLocalidad + element.localidad;
                        $("#localidad").append(opcion);//agregamos las opciónes consultadas
                    });
                    document.getElementById('mensaje-cupon').innerHTML = "Cupón Válido - Ahora selecciona en LOCALIDAD la opción "+ nomLocalidad;
                    document.getElementById('mensaje-cupon').style.color = "#74b12e";
                }else{
                    swal({
                        title: "Código invalido!",
                        text: "su código es invalido, intente de nuevo!",
                        icon: "error",
                        button: "OK",
                    });
					document.getElementById('mensaje-cupon').innerHTML = "Cupón Inválido inténtalo de nuevo";
                    document.getElementById('mensaje-cupon').style.color = "#E11D32";
                }
            }
        },
        error: function (result) {
            var errors = result.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
            swal({
                title: "Error!",
                text: "Hubo un error mientras se validaba el codigo intentalo de nuevo!",
                icon: "error",
                button: "OK",
            });
            docu
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
        url: urlBase+'/ActivarEventoPago/'+idEvento+'/'+FlagEsActivo,//primero el modulo/controlador/metodo que esta en el controlador
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
        url: urlBase+'/ActivarTienda/'+idEvento+'/'+FlagEsActivo,//primero el modulo/controlador/metodo que esta en el controlador
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
        url: urlBase+'/ActivarSolicitarPIN/'+idEvento+'/'+FlagEsActivo,//primero el modulo/controlador/metodo que esta en el controlador
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
        url: urlBase+'/ActivarEsPublico/'+idEvento+'/'+FlagEsActivo,//primero el modulo/controlador/metodo que esta en el controlador
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

function AgregarVlrPagoTC(tipoTC){
        swal({
            title: '¡El pago con tarjeta de credito contiene un costo adicional!',
            text: "¿Está seguro que desea pagar con tarjeta de crédito?",
            icon: 'warning',
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: false,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                }},
        }).then((result) => {
            if (result) {
                $("#aVisa").attr('onclick','cargarFormularioPagoTC("VISA")');
                $("#aMasterCard").attr('onclick','cargarFormularioPagoTC("MASTERCARD")');
                $("#aAmex").attr('onclick','cargarFormularioPagoTC("AMEX")');
                $("#aDiners").attr('onclick','cargarFormularioPagoTC("DINERS")');
                $("#aCodensa").attr('onclick','cargarFormularioPagoTC("CODENSA")');
                var impuestos = parseInt($("#subTotal").val() * 0.04);
                var total  = impuestos + parseInt($("#subTotal").val());
                $("#tdTotalAPagar").html(total);
            var row = '<tr id="trValorAdicional">';
                row = row + '<td>1</td>';
                row = row + '<td>Costo transacción</td>';
                row = row +'<td>'+impuestos+'</td>';
                row = row + '<td>'+impuestos+'</td>';
                row = row + '</tr>';
                $("#TablasDetalleFactura").append(row);
                cargarFormularioPagoTC(tipoTC);
            }
        });
}
function cargarFormularioPagoTC(tipoTC) {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'/FormularioPagoTc/'+tipoTC,
        dataType: 'json',
        success: function (result) {
            OcultarPopupposition();
            $('#divPSE').empty().append($(result));
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}
function cargarFormularioPagoPSE() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'/FormularioPagoPSE',
        dataType: 'json',
        success: function (result) {
            OcultarPopupposition();
            $("#divTC").remove();
            $('#divMediosDePago').append($(result));
            $('#aPSE').removeAttrs('onclick');
            $('#aPSE').removeAttrs('style');
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}



function CargarFormularioMediosDePago() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'/FormularioMediosDePago',
        dataType: 'json',
        success: function (result) {
            OcultarPopupposition();
            $('#divMediosDePago').empty().append($(result));
            $("#trValorAdicional").remove();
            $("#tdTotalAPagar").html($("#subTotal").val());
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}
function PagarCompraTC() {
    PopupPosition();
    var form = $("#formPagPy");
    var token = $("#_token").val();
    $.ajax({
        type: 'POST',
        url: urlBase + '/pagarTC',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        dataType: "JSON",
        success: function (result) {
            OcultarPopupposition();
            if(result.STATUS == 'SUCCESS'){
                $('#eco').empty().append($(result.RESPONSE));
            }else{
                if(result.STATUS == 'ERROR'){
                    swal({
                        title: "Error procesando el pago!",
                        text: result.RESPONSE,
                        icon: "error",
                        button: "OK",
                    });
                }else{
                    swal({
                        title: "Error procesando el pago!",
                        text: "Por favor intenta de nuevo!",
                        icon: "error",
                        button: "OK",
                    });
                }
            }
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Error procesando el pago!",
                text: "Por favor intenta de nuevo!",
                icon: "error",
                button: "OK",
            });
        }
    });
}

function PagarCompraPSE() {
    PopupPosition();
    var form = $("#formPagPy");
    var token = $("#_token").val()
    $.ajax({
        type: 'POST',
        url: urlBase + '/pagarPSE',//primero el modulo/controlador/metodo que esta en el controlador
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        dataType: "JSON",
        success: function (result) {
            OcultarPopupposition();
            if(result.Respuesta == true){
                window.location.href= result.URLPPAGOPSE;
            }
            else{
                swal({
                    title: "Error procesando el pago!",
                    text: "Por favor intenta de nuevo!",
                    icon: "error",
                    button: "OK",
                });
            }
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}

function guardarNombreBanco() {
    var nombreBanco =  $("#banco").find("option:selected").text();
    $("#nombreBanco").val(nombreBanco);
}


function CargarLocalidadesEvento(){
    var $idEvento =$("#Evento_id").val();
    var localidad_id =$("#localidad")
    $.ajax({
        type: 'GET',
        url: urlBase+'/LocalidadesEvento/' + $idEvento,
        dataType: 'json',
        success: function (result) {
            if (result) {
                localidad_id.find("option").remove();//Removemos las opciónes anteriores
                localidad_id.append(new Option("Seleccionar", ""));// agregamos la opción de seleccionar
                $.each(result, function (ind, element) {
                    var opcion = new Option(element.localidad, element.id);
                    $(opcion).attr("data-num", element.precio);
                    localidad_id.append(opcion)
                });
            }
        }
    });

}


function CargarPromotores(){
    $("#enlace").val("");
    var idEvento =$("#Evento_id").val();
    var promotores_id =$("#Promotor_id");
    $.ajax({
        type: 'GET',
        url: urlBase+'/listaPromotores/' + idEvento,
        dataType: 'json',
        success: function (result) {
            if (result) {
                promotores_id.find("option").remove();//Removemos las opciónes anteriores
                promotores_id.append(new Option("Seleccionar", ""));// agregamos la opción de seleccionar
                $.each(result, function (ind, element) {
                    var opcion = new Option(element.Nombres +' ' +element.Apellidos, element.id);
                    promotores_id.append(opcion)
                });
            }
        }
    });

}


function CrearEnlacePromotor(){
    var url = urlBase + "/form-prom/" + $("#Evento_id").val() + "/" + $("#Promotor_id").val();
    $("#enlace").val(url);
}


function validarCamposFormPagoTC(){
    validarFormPagoTC();
    if ($("#formPagPy").valid()) {
        PagarCompraTC();
    }
}

function validarFormPagoTC(){
    $("#formPagPy").validate({
        rules: {
            nombrePagador: {
                required: true
            },
            tipoDoc: {
                required: true
            },
            documentoPagador: {
                required: true
            },
            numeroTarjeta: {
                required: true
            },
            codigoTarjeta: {
                required: true
            },
            mesVenc: {
                required: true
            },
            anioVenc: {
                required: true
            },
            numeroCuotas: {
                required: true
            },
            numeroTel: {
                required: true
            }

        },
        messages: {
            nombrePagador: {
                required: "*El nombre es obligatorio"
            },
            tipoDoc: {
                required: "*El tipo de documento es obligatorio"
            },
            documentoPagador: {
                required: "*El documento es obligatorio"
            },
            numeroTarjeta: {
                required: "*El numero de tarjeta es obligatoria"
            },
            codigoTarjeta: {
                required: "*El código es obligatorio"
            },
            mesVenc: {
                required: "*El mes es obligatorio"
            },
            anioVenc: {
                required: "*El año es obligatorio"
            },
            numeroCuotas: {
                required: "*El número de cuotas es obligatorio"
            },
            numeroTel: {
                required: "*El telefono es obligatorio"
            },
        }

    });

}


function validarCamposFormPagoPSE(){
    validarFormPagoPSE();
    if ($("#formPagPy").valid()) {
        PagarCompraPSE();
    }
}


function validarFormPagoPSE(){
    $("#formPagPy").validate({
        rules: {
            nombreBanco: {
                required: true
            },
            nombreTitular: {
                required: true
            },
            tipoDoc: {
                required: true
            },
            documentoPagador: {
                required: true
            },
            tipoCliente: {
                required: true
            },
            numeroTel: {
                required: true
            }

        },
        messages: {
            nombreBanco: {
                required: "*El banco es obligatorio"
            },
            nombreTitular: {
                required: "*El nombre es obligatorio"
            },
            tipoDoc: {
                required: "*El tipo de documento es obligatorio"
            },
            documentoPagador: {
                required: "*El número del documento es obligatorio"
            },
            tipoCliente: {
                required: "*El tipo de cliente  es obligatorio"
            },
            numeroTel: {
                required: "*El telefono es obligatorio"
            }
        }

    });

}


function verificarAfiliacion() {
    var identificacion = $("#Identificacion").val();
    var eventoId = $("#Evento_id").val();
    
    if (identificacion && identificacion.length > 5) {
        $.ajax({
            type: 'GET',
            url: urlBase + '/verificarAfiliacion/' + eventoId + '/' + identificacion,
            dataType: 'json',
            success: function (result) {
                if (result.esAfiliado) {
                    // Asignar automáticamente el código promocional al campo
                    $("#Codigo").val(result.codigoPromocional);
                    
                    // Validar el código automáticamente usando la función existente
                    validarCodigoPromocional(eventoId);
                    
                    // Mostrar un mensaje adicional sobre el beneficio
                    setTimeout(function() {
                        document.getElementById('mensaje-cupon').innerHTML += "<br>¡Beneficio por ser afiliado a " + result.convenio + "!";
                    }, 500); // Pequeño delay para que no se sobrescriba con el mensaje de validarCodigoPromocional
                }
            },
            error: function (result) {
                console.log("Error al verificar afiliación:", result);
            }
        });
    }
}

