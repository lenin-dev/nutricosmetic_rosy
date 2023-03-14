'use strict'

window.addEventListener("load", function(){
    cargarUsu();
    cargarImagenicon();
    
    if(document.getElementById('numCountFav') !== null) {
        valUsuAdmin();
        verNumsFavs();
    }
});

if (document.getElementById("btn-fav") !== null) {
    document.getElementById('btn-fav').addEventListener("click", function() { favVer(); })
}


const rutaCrud = "/nutricosmetic_rosy/vista/vistaAdmin/crudProductos.php";
const rutaPerfil = "/nutricosmetic_rosy/vista/Perfil.php";
const rutaIndex1 = "/nutricosmetic_rosy/index.html";
const rutaIndex2 = "/nutricosmetic_rosy/";
console.log(window.location.pathname);

function favVer() {
    const http = new XMLHttpRequest();
    const url = "../controlador/consultas/verFavoritos.php";
    const url1 = "./controlador/consultas/verFavoritos.php";
    const rutaActual = window.location.pathname;
    var param = "id=1";

    if(rutaActual == rutaPerfil) {
        http.open('POST', url, true);
    } else {
        http.open('POST', url1, true);
    }
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(param);
    
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            const listaObjetos = ["Imagen","NomProducto","PrecioOriginal","PrecioOferta"];
            var respuesta = JSON.parse(http.responseText);

            if(respuesta.estado == '0') {
                Swal.fire({
                    position: 'top-center',
                    icon: 'warning',
                    title: 'Debe iniciar sesión',
                    showConfirmButton: false,
                    timer: 3000
                })
            } else {
                var tbody = document.getElementById('bodyTable');
                tbody.replaceChildren();

                for(var i = 0; i < respuesta.length; i++) {
                    var tr = document.createElement('tr');
                    
                    for(var j = 0; j < listaObjetos.length; j++) {

                        var a = document.createElement('a');

                        if(rutaActual == rutaPerfil) {
                            a.setAttribute("href", "../vista/vistaUsuario/producto.html?clave="+respuesta[i].TokenProd);
                        } else {
                            a.setAttribute("href", "./vista/vistaUsuario/producto.html?clave="+respuesta[i].TokenProd);
                        }                        
                        a.setAttribute("class", "text-decoration-none text-dark");

                        if(j == 0) {
                            var td = document.createElement('td');
                            var img = document.createElement('img');
                            if(rutaActual == rutaPerfil) {
                                img.setAttribute("src", ".."+respuesta[i][listaObjetos[j]]);
                            } else {
                                img.setAttribute("src", "."+respuesta[i][listaObjetos[j]]);
                            }
                            img.setAttribute("width", 40);
                            img.setAttribute("height", 40);
                            td.appendChild(img);
                            tr.appendChild(td);
                            j++;
                        }

                        td = document.createElement('td');
                        var textValor = document.createTextNode(respuesta[i][listaObjetos[j]]);
                        
                        a.appendChild(textValor);
                        td.appendChild(a);
                        tr.appendChild(td);
                    }
                    td = document.createElement('td');
                    var button = document.createElement('button');
                    button.setAttribute("type", "button");
                    button.setAttribute("onclick", "eliminarFav(value)");
                    button.setAttribute("value", respuesta[i].IdProducto);
                    button.setAttribute("class", "btn-sin-bordes");

                    img = document.createElement('img');
                    if(rutaActual == rutaPerfil) {
                        img.setAttribute("src", "../galeria/iconos/eliminar.png");
                    } else {
                        img.setAttribute("src", "./galeria/iconos/eliminar.png");
                    }
                    img.setAttribute("width", "30");
                    img.setAttribute("height", "30");

                    button.appendChild(img);
                    td.appendChild(button);
                    tr.appendChild(td);
                    tbody.appendChild(tr);
                }
            }
        }
    }
}

function eliminarFav(value) {
    const http = new XMLHttpRequest();
    const url = "../controlador/consultas/eliminarFavoritos.php";
    const url1 = "./controlador/consultas/eliminarFavoritos.php";
    const rutaActual = window.location.pathname;
    var param = "clave="+value;

    if(rutaActual == rutaPerfil) {
        http.open('POST', url, true);
    } else {
        http.open('POST', url1, true);
    }
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(param);
    
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var respuesta = JSON.parse(http.responseText);

            if(respuesta.estado == "1") {
                verNumsFavs();
                favVer();

            } else if(respuesta.estado == "2") {
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'Debe iniciar sesión.',
                    showConfirmButton: false,
                    timer: 5000
                })

            }  else {
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'Ocurrio un error, intentelo más tarde.',
                    showConfirmButton: false,
                    timer: 5000
                })
            }
        }
    }
}

function verNumsFavs() {
    const http = new XMLHttpRequest();
    const url = "../controlador/consultas/verFavoritos.php";
    const url1 = "./controlador/consultas/verFavoritos.php";
    const rutaActual = window.location.pathname;

    if(rutaActual == rutaPerfil) {
        http.open('GET', url, true);
    } else {
        http.open('GET', url1, true);
    }
    http.send();
    
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var respuesta = JSON.parse(http.responseText);
            var numCountFav = document.getElementById('numCountFav');

            if(respuesta.total == "0") {
                numCountFav.innerHTML = "0";
            } else {
                numCountFav.innerHTML = respuesta['total'].total;
            }
        }
    }
}

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

            if (respuesta.contImagen == 1) {
                if(rutaActual == rutaPerfil) {
                    contImagenIcon.src = ".."+respuesta.imagen;

                } else if(rutaActual == rutaIndex1 || rutaActual == rutaIndex2) {
                    contImagenIcon.src = "."+respuesta.imagen;

                } else {
                    contImagenIcon.src = "../.."+respuesta.imagen;
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
