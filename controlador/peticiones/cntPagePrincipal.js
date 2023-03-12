'use strict';

// Acciones de botonses o lincks /////////////////////
document.getElementById("pageInicio").addEventListener("click", function(){ cargarPageInicio(); });

document.getElementById("pageQuienesSomos").addEventListener("click", function(){ cargarPageQuienesSomos(); });

document.getElementById("resp2").addEventListener("click", function(){ cargaPerfil(); });

window.addEventListener("load", function() {
    cargaURL();
    cargaFooter();
});

// Cargar desde un inivio //////////////////
cargarPageInicio();
cargarSlider();

function cargaFooter() {
    const http = new XMLHttpRequest();
    const url = './vista/complementos/footer.php';
    http.open('GET', url, true); 
    http.send();

    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            document.getElementById("footer").innerHTML = this.responseText;
        }
    }
}

function cargaURL() {
    const rutaActual = window.location.hash;

    if(rutaActual == "#productos") {
        cargarPageInicio();
    } else if(rutaActual == "#quiensoy") {
        cargarPageQuienesSomos();
    }
}

// cargar pagina de inicio
function cargarPageInicio() {
    const http = new XMLHttpRequest();
    const url = './vista/vistaUsuario/Inicio.php';
    http.open('GET', url); 
    http.send();

    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            document.getElementById("contenedorPrincipal").innerHTML = this.responseText;
        }
    }
}

// cargar pagina de quien soy
function cargarPageQuienesSomos() {
    const http = new XMLHttpRequest();
    const url = './vista/vistaUsuario/QuienesSomos.html';
    http.open('GET', url);
    http.send();

    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            document.getElementById("contenedorPrincipal").innerHTML = this.responseText;
        }
    }
}

// cargar slider de imagenes
function cargarSlider() {
    const http = new XMLHttpRequest();
    const url = './vista/complementos/slider_imagenes.html';
    http.open('GET', url);
    http.send();

    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById("contenedor_slider").innerHTML = this.responseText;
        }
    }
}