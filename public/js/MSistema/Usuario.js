//var urlBase = ""; //SE DEBE VALIDAR CUAL ES LA URL EN LA QUE SE ESTA CORRIENDO LA APP

try {
    urlBase = obtenerUlrBase();
} catch (e) {
    console.error(e.message);
    throw new Error("El modulo transversales es requerido");
};

//Funcion para cargar la vista de crear un usuario
function ajaxRenderSectionCrearUsuario() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'crearUsuario',
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

//Funcion para cargar la vista de editar un usuario
function ajaxRenderSectionEditarUsuario(idUsuario) {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'FormularioEditarUsuario/'+ idUsuario,
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
//Metodo para guarda la informacion del usuario retorna la vista con todos los usuarios
function GuardarUsuario() {
    var form = $("#formUsuario");
    var token = $("#_token").val();
    PopupPosition();
    $.ajax({
        type: 'POST',
        url: urlBase +'guardarUsuario',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transaccción exitosa!",
                text: "El usuario fue grabado con exito!",
                icon: "success",
                button: "OK",
            });
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible grabar el usuario!",
                icon: "error",
                button: "OK",
            });
            $("#errorname").html("");
            $("#errorlast_name").html("");
            $("#errorusername").html("");
            $("#erroremail").html("");
            $("#errorpassword").html("");
            $("#errorSede_id").html("");
            $("#errorRoles_id").html("");

            var errors = data.responseJSON;
            if(errors.errors.name){
                var errorname = "<strong>"+ errors.errors.name+"</strong>";
                $("#errorname").append(errorname);}
            if(errors.errors.last_name){
                var errorlast_name = "<strong>"+ errors.errors.last_name+"</strong>";
                $("#errorlast_name").append(errorlast_name);}
            if(errors.errors.username){
                var errorusername = "<strong>"+ errors.errors.username+"</strong>";
                $("#errorusername").append(errorusername);}
            if(errors.errors.email){
                var errorPrecioemail = "<strong>"+ errors.errors.email+"</strong>";
                $("#erroremail").append(errorPrecioemail);}
            if(errors.errors.password){
                var errorpassword = "<strong>"+ errors.errors.password+"</strong>";
                $("#errorpassword").append(errorpassword);}
            if(errors.errors.Sede_id){
                var errorSede_id = "<strong>"+ errors.errors.Sede_id+"</strong>";
                $("#errorSede_id").append(errorSede_id);}
            if(errors.errors.Roles_id){
                var errorRoles_id = "<strong>"+ errors.errors.Roles_id+"</strong>";
                $("#errorRoles_id").append(errorRoles_id);}

        }
    });
}

//Metodo para guardar la informacion editada  del usuario retorna la vista con todos los usuarios
function EditarUsuario() {
    var form = $("#formUsuario");
    var token = $("#_token").val();
    PopupPosition();
    $.ajax({
        type: 'POST',
        url: urlBase +'EditarUsuario',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transaccción exitosa!",
                text: "El usuario fue editado con exito!",
                icon: "success",
                button: "OK",
            });
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible editar el usuario!",
                icon: "error",
                button: "OK",
            });
            $("#errorname").html("");
            $("#errorlast_name").html("");
            $("#errorpassword").html("");
            $("#errorSede_id").html("");
            $("#errorRoles_id").html("");

            var errors = data.responseJSON;
            if(errors.errors.name){
                var errorname = "<strong>"+ errors.errors.name+"</strong>";
                $("#errorname").append(errorname);}
            if(errors.errors.last_name){
                var errorlast_name = "<strong>"+ errors.errors.last_name+"</strong>";
                $("#errorlast_name").append(errorlast_name);}
            if(errors.errors.password){
                var errorpassword = "<strong>"+ errors.errors.password+"</strong>";
                $("#errorpassword").append(errorpassword);}
            if(errors.errors.Sede_id){
                var errorSede_id = "<strong>"+ errors.errors.Sede_id+"</strong>";
                $("#errorSede_id").append(errorSede_id);}
            if(errors.errors.Roles_id){
                var errorRoles_id = "<strong>"+ errors.errors.Roles_id+"</strong>";
                $("#errorRoles_id").append(errorRoles_id);}
        }
    });
}

//Metodo para guarda la informacion del producto retorna la vista con todos los usuarios
function CambiarContrasena(element) {
    var form =  $(element).closest("form[name=formContrasena]");
    var token = form.find("input[name=_token]").val();
    PopupPosition();
    $.ajax({
        type: 'POST',
        url: urlBase +'CambiarContrasena',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transaccción exitosa!",
                text: "La contraseña fue cambiada con exito!",
                icon: "success",
                button: "OK",
            });
           // $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible cambiar la contraseña!",
                icon: "error",
                button: "OK",
            });
            $("#errorpassword").html("");
            var errors = data.responseJSON;
            if(errors.errors.password){
                var errorpassword = "<strong>"+ errors.errors.password+"</strong>";
                $("#errorpassword").append(errorpassword);}
        }
    });
}


//Funcion para mostrar la lista de categorias
function ajaxRenderSectionListaUsuarios() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'usuarios',
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