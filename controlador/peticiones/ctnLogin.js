'use strict'
document.getElementById("btnradio1").addEventListener("click", function(){ login(); });

document.getElementById("btnradio2").addEventListener("click", function(){ registrar(); });

const contenedor1 = document.getElementById("idRegistro");
const contenedor2 = document.getElementById("idLogin");

// CAMBIO DE LOGIN A REGISTRARSE
function login() {
  contenedor1.style.display='none';
  contenedor2.style.display='block';
}
function registrar() {
  contenedor1.style.display='block';
  contenedor2.style.display='none';
  
}

// ACCION LOGUEARSE
var formLoguear = document.getElementById('formLoguearse');
formLoguear.onsubmit = i => {
    var btn = document.getElementById('loguear');
    var fmL = new FormData(formLoguear);
    const httpL = new XMLHttpRequest();

    i.preventDefault();
    btn.disabled = true;
    var url = "../controlador/consultas/IniciarSesion.php";

    httpL.open("POST", url);
    httpL.send(fmL);
    httpL.onreadystatechange = function() {
        if (httpL.readyState == 4 && httpL.status == 200) {
            var mensaje = document.getElementById("mensaje2");
            var respuesta = JSON.parse(httpL.responseText);
            btn.disabled = false;
            
            if (respuesta.estado == "4") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Este correo no existe";
            } else if (respuesta.estado == "3") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Campos vacios";
            } else if (respuesta.estado == "2") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Email o contraseña incorrectos";
            } else if (respuesta.estado == "1") {
                btn.disabled = false;
                Swal.fire({
                  position: "top-center",
                  icon: "success",
                  title: "Datos Correctos, enviando a página principal",
                  showConfirmButton: false,
                  timer: 2000,
                }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = "../index.html";
                  }
                });

            }
        }
    }

};

// ACCION REGISTRARSE
var formRegister = document.getElementById('formRegistrar');
formRegister.onsubmit = e => {
  var btn = document.getElementById('registrar');
  var fm = new FormData(formRegister);
  const http = new XMLHttpRequest();
  
  e.preventDefault();
  btn.disabled = true;
  var url = "../controlador/consultas/Registrarse.php";

  http.open("POST", url);
  http.send(fm);
  http.onreadystatechange = function() {
    if (http.readyState == 4 && http.status == 200) {
      var mensaje = document.getElementById("mensaje1");
      var respuesta = JSON.parse(http.responseText);
      btn.disabled = false;

      if (respuesta.estado == "5") {
        mensaje.style.display = "block";
        mensaje.innerHTML = "Campos vacios";
      } else if (respuesta.estado == "4") {
        mensaje.style.display = "block";
        mensaje.innerHTML = "Hubo un error al almacenar su usuario, vuelvalo a intentar";
      } else if (respuesta.estado == "3") {
        mensaje.style.display = "block";
        mensaje.innerHTML = "Lo sentimos este correo ya esta ingresado";
      } else if (respuesta.estado == "2") {
        mensaje.style.display = "block";
        mensaje.innerHTML = "Las contraseñas son distintas, favor de introducirlas correctamente";
      } else if (respuesta.estado == "1") {
        btn.disabled = false;
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: "Datos almacenados",
          showConfirmButton: false,
          timer: 4000,
        });
      } else {
        login();
      }
    }
  }
};