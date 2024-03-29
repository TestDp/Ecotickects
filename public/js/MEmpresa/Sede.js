try {
    urlBase = obtenerUlrBase();
} catch (e) {
    console.error(e.message);
    throw new Error("El modulo transversales es requerido");
};
//Funcion para cargar la vista de crear una sede
function ajaxRenderSectionCrearSede() {
    $.ajax({
        type: 'GET',
        url: urlBase +'/crearSede',
        dataType: 'json',
        success: function (data) {
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}

//Funcion para cargar la vista de editar sede
function ajaxRenderSectionEditarSede(idSede) {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'/editarSede/' + idSede,
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data));
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

//Metodo para guarda la informacion de la sede retorna la vista con todas las sedes
function GuardarSede() {
    PopupPosition();
    var form = $("#formSede");
    var token = $("#_token").val()
    $.ajax({
        type: 'POST',
        url: urlBase +'/guardarSede',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transaccción exitosa!",
                text: "La sede fue grabada con exito!",
                icon: "success",
                button: "OK",
            });
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible grabar la sede!",
                icon: "error",
                button: "OK",
            });
            $("#errorNombre").html("");
            $("#errorDireccion").html("");
            $("#errorTelefono").html("");
            var errors = data.responseJSON;
            if(errors.errors.Nombre){
                var errorNombre = "<strong>"+ errors.errors.Nombre+"</strong>";
                $("#errorNombre").append(errorNombre);}
            if(errors.errors.Direccion){
                var errorDireccion = "<strong>"+ errors.errors.Direccion+"</strong>";
                $("#errorDireccion").append(errorDireccion);}
            if(errors.errors.Telefono){
                var errorTelefono = "<strong>"+ errors.errors.Telefono+"</strong>";
                $("#errorTelefono").append(errorTelefono);}
        }
    });
}

//Funcion para mostrar la lista de sedes
function ajaxRenderSectionListaSedes() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'/sedes',
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data));
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