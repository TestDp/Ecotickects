try {
    urlBase = obtenerUlrBase();
} catch (e) {
    console.error(e.message);
    throw new Error("El modulo transversales es requerido");
};


//crea elemento
const video = document.createElement("video");

//nuestro camvas
const canvasElement = document.getElementById("qr-canvas");
const canvas = canvasElement.getContext("2d");

//div donde llegara nuestro canvas
const btnScanQR = document.getElementById("btn-scan-qr");

//lectura desactivada
let scanning = false;
//evita procesar otro QR hasta que el usuario cierre el popup con Aceptar
let lecturaEnCurso = false;

//funcion para encender la camara
const encenderCamara = () => {
  if (lecturaEnCurso) return;
  navigator.mediaDevices
    .getUserMedia({ video: { facingMode: "environment" } })
    .then(function (stream) {
      scanning = true;
      btnScanQR.hidden = true;
      canvasElement.hidden = false;
      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.srcObject = stream;
      video.play();
      tick();
      scan();
    });
};

//funciones para levantar las funiones de encendido de la camara
function tick() {
  canvasElement.height = video.videoHeight;
  canvasElement.width = video.videoWidth;
  canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

  scanning && requestAnimationFrame(tick);
}

function scan() {
  try {
    qrcode.decode();
  } catch (e) {
    setTimeout(scan, 300);
  }
}

//apagar la camara y dejar listo para otra lectura
const cerrarCamara = () => {
  scanning = false;
  if (video.srcObject && video.srcObject.getTracks) {
    video.srcObject.getTracks().forEach((track) => {
      track.stop();
    });
  }
  video.srcObject = null;
  canvasElement.hidden = true;
  btnScanQR.hidden = false;
};

const activarSonido = () => {
  var audio = document.getElementById('audioScaner');
  if (audio) audio.play();
};

//callback cuando termina de leer el codigo QR
qrcode.callback = (respuesta) => {
  if (!respuesta || lecturaEnCurso) return;
  lecturaEnCurso = true;
  cerrarCamara();
  activarSonido();
  activarPinBoleta(respuesta);
};
/*
//evento para mostrar la camara sin el boton
window.addEventListener('load', (e) => {
  encenderCamara();
})
*/

// ActivarPinApp: sirve para evento pago (pin) y evento gratuito (pin = cédula)
function activarPinBoleta(strQr){
   var parts = strQr.split('CC - ');
   if (parts.length < 2) {
     mostrarPopupResultado({ Activa: false, Mensaje: 'QR no válido' });
     return;
   }
   var pin = (parts[1].split('ECO')[0] || '').trim();
   var idEvento = $("#idEvento").val();
   var userName = $("#userName").val();

   $.ajax({
     type: 'GET',
     url: urlBase + '/ActivarPinApp/' + idEvento + '/' + encodeURIComponent(pin) + '/' + userName,
     dataType: 'json',
     success: function (data) {
       mostrarPopupResultado(data);
     },
     error: function (xhr) {
       var msg = 'Error al validar el QR. Intente de nuevo.';
       if (xhr.responseJSON && xhr.responseJSON.mensaje) msg = xhr.responseJSON.mensaje;
       mostrarPopupResultado({ Activa: false, Mensaje: msg });
     }
   });
}

/**
 * Muestra popup con información del comprador y localidad.
 * Verde si se activó con éxito, rojo si la boleta ya fue leída.
 */
function mostrarPopupResultado(data) {
  var titulo = (data && data.Activa) ? 'Entrada registrada' : 'Resultado';
  var nombre = (data && data.Nombre) ? data.Nombre : '';
  var identificacion = (data && data.Identificacion) ? data.Identificacion : '';
  var localidad = (data && (data.Localidad != null && data.Localidad !== '')) ? data.Localidad : (data && data.localidad) ? data.localidad : '';
  var mensaje = (data && data.Mensaje) ? data.Mensaje : '';

  var esActiva = data && data.Activa === true;
  var yaActivada = data && data.Activa === false && data.Mensaje && data.Mensaje.indexOf('ya fue ACTIVADA') !== -1;
  var colorEstado = esActiva ? '#28a745' : (yaActivada || (data.Mensaje && data.Mensaje.indexOf('anulada') !== -1)) ? '#dc3545' : '#333';

  var html = '<div class="text-left" style="font-size: 1rem;">';
  if (localidad) html += '<p class="mb-2"><strong>Localidad:</strong> ' + escapeHtml(localidad) + '</p>';
  if (mensaje) html += '<p class="mb-2"><strong>Estado:</strong> <span style="color:' + colorEstado + '; font-weight: 600;">' + escapeHtml(mensaje) + '</span></p>';
  if (nombre) html += '<p class="mb-2"><strong>Comprador:</strong> ' + escapeHtml(nombre) + '</p>';
  if (identificacion) html += '<p class="mb-2"><strong>Identificación:</strong> ' + escapeHtml(identificacion) + '</p>';
  html += '</div>';

  var icono = esActiva ? 'success' : (data.Mensaje && data.Mensaje.indexOf('anulada') !== -1) ? 'warning' : 'info';

  Swal.fire({
    title: titulo,
    html: html || '<p>No hay información adicional.</p>',
    icon: icono,
    confirmButtonText: 'Aceptar',
    allowOutsideClick: false
  }).then(function () {
    lecturaEnCurso = false;
    // Volver a encender la cámara para leer otro QR sin tocar el botón
    encenderCamara();
  });
}

function escapeHtml(text) {
  if (!text) return '';
  var div = document.createElement('div');
  div.textContent = text;
  return div.innerHTML;
}



function abrirCamara(){
    $("#abriCamara").click();
    tick();
    scan();
}


