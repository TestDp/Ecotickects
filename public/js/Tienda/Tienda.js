var urlBase = "/Ecophp/trunk/public/"; //SE DEBE VALIDAR CUAL ES LA URL EN LA QUE SE ESTA CORRIENDO LA APP

function ActivarProducto (idProducto) {
    idEvento =$("#Evento").val();
    $.ajax({
        url: urlBase+'ActivarProducto/'+idProducto+'/'+idEvento,//primero el modulo/controlador/metodo que esta en el controlador
        data: {// se colocan los parametros a enviar... en este caso no porque los voy es a obtener.
            idProducto: idProducto,
            idEvento:idEvento,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                location.reload(true);
            }
        }
    });
}