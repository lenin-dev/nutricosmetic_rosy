'use strict'

window.addEventListener("load", function(){
    cargarUsu();
    cargarImagenicon();
    valUsuAdmin();
});

const rutaCrud = "/nutricosmetic_rosy/vista/vistaAdmin/crudProductos.php";
const rutaPerfil = "/nutricosmetic_rosy/vista/Perfil.php";
const rutaIndex1 = "/nutricosmetic_rosy/index.html";
const rutaIndex2 = "/nutricosmetic_rosy/";
console.log(window.location.pathname);

function valUsuAdmin() {
    const http = new XMLHttpRequest();
    const url = '../../controlador/consultas/validarAdmin.php';
    const rutaActual = window.location.pathname;

    if(rutaActual == rutaCrud) {
        http.open('POST', url, true);
        http.send();
    }

    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var respuesta = JSON.parse(http.responseText);

            if(respuesta.estado != 1) {
                 window.location.href = "../../";
            }
        }
    }
}

// CARGA EL ICONO DEL NAVBAR
function cargarImagenicon() {
    const http = new XMLHttpRequest();
    const url = "./controlador/consultas/mostrarImagen.php";
    const url1 = "../controlador/consultas/mostrarImagen.php";
    const url2 = '../../controlador/consultas/mostrarImagen.php';
    const rutaActual = window.location.pathname;

    if(rutaActual == rutaPerfil) {
        http.open('POST', url1, true);
    } else if(rutaActual == rutaCrud) {
        http.open('POST', url2, true);
    } else {
        http.open('POST', url, true);
    }
    http.send();

    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
        var respuesta = JSON.parse(http.responseText);
        var contImagenIcon = document.getElementById('imgIconNavbar');

            if (respuesta.contImagen != 1) {
                // contImagenIcon.src = "./galeria/iconos/usuario.png";
            } else {
                if(rutaActual == rutaPerfil) {
                    contImagenIcon.src = respuesta.imagen1;

                } else if(rutaActual == rutaIndex1 || rutaActual == rutaIndex2) {
                    contImagenIcon.src = respuesta.imagen2;

                } else {
                    contImagenIcon.src = respuesta.imagen3;
                }
            }
        }
    }
}

function cargarUsu() {
    var linea1 = document.getElementById("resp1");
    var linea2 = document.getElementById("resp2");
    var linea3 = document.getElementById("resp3");
    var linea4 = document.getElementById("resp4");
    var prod = document.getElementById("prod");

    const http = new XMLHttpRequest();
    const url = './controlador/consultas/validarUsuario.php';
    const url1 = '../controlador/consultas/validarUsuario.php';
    const url2 = '../../controlador/consultas/validarUsuario.php';
    var rutaActual = window.location.pathname;    // LOCALIZACION ACTUAL DE LA PAGINA

    if(rutaActual == rutaPerfil) {
        http.open('POST', url1, true);
    } else if(rutaActual == rutaCrud) {
        http.open('POST', url2, true);
    } else {
        http.open('POST', url, true);
    }
    http.send();

    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            var respuesta = JSON.parse(http.responseText);

            if(respuesta.estado == "1") {

                if(linea1 != undefined) {
                    linea1.style.display = "none";
                }
                
                if(respuesta.tipo != "3") {
                    prod.style.display = "none";
                }

            } else {
                linea2.style.display = "none";
                linea3.style.display = "none";
                linea4.style.display = "none";
                prod.style.display = "none";
            }
        }
    }
}
