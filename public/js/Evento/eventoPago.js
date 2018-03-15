var urlBase = "/Ecotickects/public/"; //SE DEBE VALIDAR CUAL ES LA URL EN LA QUE SE ESTA CORRIENDO LA APP
function RegistrarUsuario () {
    var form = $("#formularioEvento");
    $.ajax({
        url: urlBase+'FormularioAsistentePago',//primero el modulo/controlador/metodo que esta en el controlador
        type: 'POST',
        data: form.serialize(),
        dataType: "JSON",
        success: function (result) {
            if (result) {
                $('#formAsistente').removeAttr("hidden");
            }else{
                $('#formAsistente').attr("hidden","hidden");
            }
        }
    });
}