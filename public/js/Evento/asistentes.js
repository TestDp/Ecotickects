try {
    urlBase = obtenerUlrBase();
} catch (e) {
    console.error(e.message);
    throw new Error("El modulo transversales es requerido");
};

function ValidarAnulacion(idTicket){
    swal({
        title: '¡Anularl'+idTicket+'!',
        text: "¿Está seguro que desea el ticket?",
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
            anularTicket(idTicket);
        }
    });
}

//@parametro idTicket: el id de la tabla asistentesEvento
function anularTicket(idTicket){
    PopupPosition();
        $.ajax({
            url: urlBase+'/anularTicket',
            data: {
                idTicket: idTicket,
                _token :$("#_token").val()
            },
            type: 'POST',
            success: function (result) {
                OcultarPopupposition();
                if(result.STATUS == 'SUCCESS'){
                    $('#eco').empty().append($(result.RESPONSE));
                }
            },
            error: function (data) {
                OcultarPopupposition();
                swal({
                    title: "Error anulando el ticket!",
                    text: "Por favor intenta de nuevo!",
                    icon: "error",
                    button: "OK",
                });
            }
        });

}