'use strict'

var inputOferta = document.getElementById("inputOferta");
var check = document.getElementById("inlineFormCheck");
check.addEventListener("change", function() {
    if(inputOferta.disabled == true) {
        inputOferta.disabled = false;
    } else {
        inputOferta.disabled = true;
    }

})

// MOSTRAR IMAGEN
const mostrar = (event) => {
    let img = document.getElementById('imagenUsuario');
    let mostrarIamgen = new FileReader();

    mostrarIamgen.onload = () => {
        if(mostrarIamgen.readyState == 2) {
            img.src = mostrarIamgen.result;
        }
    }
    mostrarIamgen.readAsDataURL(event.target.files[0]);
}

function limpiarImputs() {
    document.getElementById('imagenUsuario').src = "../../galeria/iconos/agregar.png";
    document.getElementById('file-input').value = "";
    document.getElementById('inputNombreProducto').value = "";
    document.getElementById('selectCategoria').value = "0";
    document.getElementById('selectMarca').value = "0";
    document.getElementById('inputPrecio').value = "";
    document.getElementById('inputProcion').value = "";
    document.getElementById('inlineFormCheck').value = "";
    document.getElementById('inputOferta').value = "";
    document.getElementById('textTareaDescripcion').value = "";

    if(inputOferta.disabled == false) {
        document.getElementById("inlineFormCheck").checked = false;
        inputOferta.disabled = true;
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////


btnProd.addEventListener("click", function(evento) {
    var btnAdd = document.getElementById("btnGuardar");
    var btnUp = document.getElementById("btnActualizar");
    btnAdd.style.display = "block";
    btnUp.style.display = "none";

    cargaMarSelect(evento);
    cargaCatSelect(evento);
});

// EVENTO PARA NO REPETIR MOSTRAR CATEGORIAS
function cargaCatSelect(evento) {
    verSelectCategorias();
    /* Si el atributo "data-cargado" vale "si" evitamos la descarga */
    if (evento.target.dataset.cargado != "si") {
        // console.log("Cargando categorías");
        verSelectCategorias();

       evento.target.dataset.cargado = "si";
    }
}
// VER CATEGORIAS EN SELECTES PRODUCTOS
verSelectCategorias();
function verSelectCategorias() {
    const http = new XMLHttpRequest();
    const url = '../../controlador/consultas/verCategorias.php';

    http.open('POST', url, true); 
    http.send();

    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            var respuesta = JSON.parse(http.responseText);
            var select = document.getElementById("selectCategoria");
            
            selectCategoria.replaceChildren();
            var option1 = document.createElement("option");
            // option1.setAttribute("selected");
            let valor1 = document.createTextNode("Escoge una categoría");
            option1.appendChild(valor1);
            select.appendChild(option1);

            for(var i = 0; i < respuesta.length; i++) {

                var option = document.createElement("option");
                option.setAttribute("value", respuesta[i].IdCategoria);
                let valor = document.createTextNode(respuesta[i].NomCategoria);
                option.appendChild(valor);
                select.appendChild(option);
            }
        }
    }
}

// EVENTO PARA NO REPETIR MOSTRAR MARCA
function cargaMarSelect(evento) {
    verSelectMarca();
    /* Si el atributo "data-cargado" vale "si" evitamos la descarga */
    if (evento.target.dataset.cargado != "si") {
        // console.log("Cargando categorías");
        verSelectMarca();

       evento.target.dataset.cargado = "si";
    }
}


// VER MARCA EN SELECTES PRODUCTOS
verSelectMarca();
function verSelectMarca() {
    var select = document.getElementById("selectMarca");
    const http = new XMLHttpRequest();
    const url = '../../controlador/consultas/verMarca.php';

    http.open('POST', url, true); 
    http.send();

    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            var respuesta = JSON.parse(http.responseText);
            
            selectMarca.replaceChildren();
            var option1 = document.createElement("option");
            // option1.setAttribute("selected");
            let valor1 = document.createTextNode("Escoge una marca");
            option1.appendChild(valor1);
            select.appendChild(option1);

            for(var i = 0; i < respuesta.length; i++) {

                var option = document.createElement("option");
                option.setAttribute("value", respuesta[i].IdMarca);

                let valor = document.createTextNode(respuesta[i].NomMarca);
                option.appendChild(valor);
                select.appendChild(option);
            }
        }
    }
}

// AGREGAR PRODUCTO
var formAgregarProductos = document.getElementById('formAgregarProductos');
formAgregarProductos.onsubmit = i => {
    var fm = new FormData(formAgregarProductos);
    const http = new XMLHttpRequest();
  
    i.preventDefault();
    var url = "../../controlador/consultas/AgregarProd.php";

    http.open("POST", url, true);
    http.send(fm);

    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var mensaje = document.getElementById("mensaje4");
            var respuesta = JSON.parse(http.responseText);
        
            if (respuesta.estado == "5") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "El tipo de imagen es incorrecto, agregue una imagen de tipo jpg, png, jpeg";
                setTimeout(mostrarMensajeProdEdit(), 5000);

            } else if (respuesta.estado == "4") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Hubo un error al guardar el producto vuelva a intentarlo";
                setTimeout(mostrarMensajeProdEdit(), 5000);

            } else if (respuesta.estado == "3") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Inserte una imagen del producto";
                setTimeout(mostrarMensajeProdEdit(), 5000);

            } else if (respuesta.estado == "2") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "No se permiten caracteres especiales, solo se permiten letras y números, escriba bien sus datos";
                setTimeout(mostrarMensajeProdEdit(), 5000);

            } else if (respuesta.estado == "1") {

                limpiarImputs();

                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Datos almacenados",
                    showConfirmButton: false,
                    timer: 2000,
                });
            } else {
                console.log(respuesta.estado);
            }
        }
    }
};

//////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////
btncat.addEventListener("click", function(evento) {
    cargarCat(evento);
});

// EVENTO PARA NO REPETIR MOSTRAR CATEGORIAS
function cargarCat(evento) {
    verCategorias();
    /* Si el atributo "data-cargado" vale "si" evitamos la descarga */
    if (evento.target.dataset.cargado != "si") {
        // console.log("Cargando categorías");
       verCategorias();

       evento.target.dataset.cargado = "si";
    }
}

// MUESTRO Y CREO LAS CATEGORIAS
function verCategorias() {
    var ul = document.getElementById("listaCategoria");
    const http = new XMLHttpRequest();
    const url = '../../controlador/consultas/verCategorias.php';

    http.open('POST', url); 
    http.send();

    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            var respuesta = JSON.parse(http.responseText);
            listaCategoria.replaceChildren();
            // console.log(respuesta);

            for(var i = 0; i < respuesta.length; i++) {
                var li = document.createElement("li");
                li.innerHTML = respuesta[i].NomCategoria;
                ul.appendChild(li);
            }
        }
    }
}

// AGREGAR CATEGORIA
var formAgregarCategoria = document.getElementById('formAgregarCategoria');
formAgregarCategoria.onsubmit = evento => {
    var fm = new FormData(formAgregarCategoria);
    const http = new XMLHttpRequest();
  
    evento.preventDefault();
    var url = "../../controlador/consultas/AgregarCat.php";

    http.open("POST", url, true);
    http.send(fm);

    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var mensaje = document.getElementById("mensaje5");
            var respuesta = JSON.parse(http.responseText);

            if (respuesta.estado == "3") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Esta categoría ya existe";

            } else if (respuesta.estado == "2") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Falló la operación al guardar la categoría, vuelva a intentarlo";

            } else if (respuesta.estado == "1") {
                mensaje.style.display = "none";
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Datos almacenados",
                    showConfirmButton: false,
                    timer: 2000,
                });
                cargarCat(evento);
                verSelectCategorias();
            } else {
                mensaje.style.display = "block";
                mensaje.innerHTML = "No se permiten caracteres especiales.";
            }
        }
    }
};
////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////
var btnMarca = document.getElementById('btnMarca');
btnMarca.addEventListener("click", function(evento) {
    cargaMar(evento);
});

// EVENTO PARA NO REPETIR MOSTRAR MARCA
function cargaMar(evento) {
    verMarca();
    /* Si el atributo "data-cargado" vale "si" evitamos la descarga */
    if (evento.target.dataset.cargado != "si") {
        // console.log("Cargando categorías");
       verMarca();
       evento.target.dataset.cargado = "si";
    }
}

// MUESTRO Y CREO LAS MARCA
function verMarca() {
    var ul = document.getElementById("listaMarca");
    const http = new XMLHttpRequest();
    const url = '../../controlador/consultas/verMarca.php';

    http.open('POST', url); 
    http.send();

    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            var respuesta = JSON.parse(http.responseText);
            
            listaMarca.replaceChildren();

            for(var i = 0; i < respuesta.length; i++) {
                var li = document.createElement("li");
                li.innerHTML = respuesta[i].NomMarca;
                ul.appendChild(li);
            }
        }
    }
}

// AGREGAR MARCA
var formAgregarMarca = document.getElementById('formAgregarMarca');
formAgregarMarca.onsubmit = evento => {
    var fm = new FormData(formAgregarMarca);
    const http = new XMLHttpRequest();
  
    evento.preventDefault();
    var url = "../../controlador/consultas/AgregarMarc.php";

    http.open("POST", url, true);
    http.send(fm);

    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var mensaje = document.getElementById("mensaje6");
            var respuesta = JSON.parse(http.responseText);

            if (respuesta.estado == "3") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Esta marca ya existe";

            } else if (respuesta.estado == "2") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Falló la operación al guardar la marca, vuelva a intentarlo";

            } else if (respuesta.estado == "1") {
                mensaje.style.display = "none";
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Datos almacenados",
                    showConfirmButton: false,
                    timer: 2000,
                });
                cargaMar(evento);
            } else {
                mensaje.style.display = "block";
                mensaje.innerHTML = "No se permiten caracteres especiales.";
            }
        }
    }
};
//////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////
// VER PRODUCTOS

window.addEventListener("load", function() {
    cargarTabla();
})

document.getElementById('cerraModalClose').addEventListener("click", function() {
    cargarTabla();
    limpiarImputs();
})

document.getElementById('cerrarModal').addEventListener("click", function() {
    cargarTabla();
    limpiarImputs();
})

var formBuscar = document.getElementById('formBuscar');
formBuscar.addEventListener("keyup", cargarTabla);

function cargarTabla(){

    var tbody = document.getElementById("tbody");

    var fm = new FormData(formBuscar);
    const http = new XMLHttpRequest();
    var url = "../../controlador/consultas/verProductos.php";
    http.open("POST", url, true);
    // http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(fm);
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            const listaObjetos = ["NomProducto","NomMarca","NomCategoria","Porcion","PrecioOriginal","PrecioOferta"];
            var respuesta = JSON.parse(http.responseText);
            // console.log(respuesta);
            if(respuesta.estado == "2") { 
                Swal.fire({
                    icon: 'error',
                    title: 'Error..',
                    text: 'Hubo un error al cargar los productos, vuelva a recargar la página.'
                })
            } else {
                tbody.replaceChildren();
                
                for(var j = 0; j < respuesta.length; j++) {
                    var tr = document.createElement("tr");
                    var th = document.createElement("th");
                    for(var i = 0; i < listaObjetos.length; i++) {
                        if(i == 0) {
                            th.setAttribute("scope", "row");
                            var textValor2 = document.createTextNode(j+1);
                            th.appendChild(textValor2);
                            tr.appendChild(th);
                        }
                        
                        var td = document.createElement("td");
                        var textValor = document.createTextNode(respuesta[j][listaObjetos[i]]);
                        td.appendChild(textValor);
                        tr.appendChild(td);
                    }
                    var td2 = document.createElement("td");
                    var td3 = document.createElement("td");
                    
                    // EDITAR
                    var a = document.createElement("button");
                    var img = document.createElement("img");
                    a.setAttribute("type", "button");
                    a.setAttribute("value", respuesta[j].TokenProd);
                    a.setAttribute("class", "btn-sin-bordes");
                    a.setAttribute("onclick", "MostrarEditarProd(value)");
                    a.setAttribute("data-bs-toggle", "modal");
                    a.setAttribute("data-bs-target", "#staticAddProductos");
                    img.setAttribute("src", "../../galeria/iconos/editar.png");
                    img.setAttribute("width", "30");
                    img.setAttribute("height", "30");
                    a.appendChild(img);
                    // BORRAR
                    var a2 = document.createElement("button");
                    var img2 = document.createElement("img");
                    a2.setAttribute("type", "button");
                    a2.setAttribute("value", respuesta[j].TokenProd);
                    a2.setAttribute("class", "btn-sin-bordes");
                    a2.setAttribute("onclick", "alertMensajeDelete(value)");
                    img2.setAttribute("src", "../../galeria/iconos/eliminar.png");
                    img2.setAttribute("width", "30");
                    img2.setAttribute("height", "30");
                    
                    a2.appendChild(img2);
                    td2.appendChild(a);
                    td3.appendChild(a2);
                    tr.appendChild(td2);
                    tr.appendChild(td3);
                    tbody.appendChild(tr);
                }
            }
        }
    }
}

function alertMensajeDelete(TokenProd) {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })
      
    swalWithBootstrapButtons.fire({
        title: 'Eliminar',
        text: "¿Está seguro que desea eliminar este producto?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar ',
        cancelButtonText: 'No, cancelar ',
        reverseButtons: true

    }).then((result) => {
        if (result.isConfirmed) {

            eliminarMethoPost(TokenProd);

            swalWithBootstrapButtons.fire(
                'Eliminado',
                'Se ha eliminado correctamente.',
                'success'
            )
            
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelado',
            'No se ha eliminado.',
            'error'
          )
        }
    })
}

function eliminarMethoPost(TokenProd) {
    const xml = new XMLHttpRequest();
    const url = '../../controlador/consultas/EliminarProducto.php';
    var parametros = 'clave='+TokenProd;

    xml.open('POST', url, true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send(parametros);

    xml.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {

            var respuesta = JSON.parse(this.responseText);
            var mensajeDiv = document.getElementById('mensaje-error-prod');

            if(respuesta.estado == "1") {
                cargarTabla();

            } else if(respuesta.estado == "2") {
                mensajeDiv.style.display = 'block';
                mensajeDiv.innerHTML = "No se encontro el valor del producto, vuelva a intentarlo más tarde.";
                setTimeout(mostrarMensajeProd, 10000);

            } else {
                mensajeDiv.style.display = 'block';
                mensajeDiv.innerHTML = "No se ejecuto la acción eliminar producto, vuelvalo a intentar más tarde.";
                setTimeout(mostrarMensajeProd, 10000);
            }

        }
    }
}

function mostrarMensajeProd() {
    var mensaje = document.getElementById('mensaje-error-prod');

    if(mensaje.style.display != 'none') {
        mensaje.style.display = 'none';
    }
}

// MOSTRAR DATOS DEL PRODUCTO PARA ACTUALIZAR
function MostrarEditarProd(clave) {

    var btnAdd = document.getElementById("btnGuardar");
    var btnUp = document.getElementById("btnActualizar");
    var tituloh1 = document.querySelector("#tituloModal-1");
    // tituloh1.innerHTML = "Actualizar producto";
    btnAdd.style.display = "none";
    btnUp.style.display = "block";

    const xml = new XMLHttpRequest();
    const url = "../../controlador/consultas/verProductos.php";
    var param = 'clave='+clave;

    xml.open("POST", url, true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send(param);

    xml.onreadystatechange = function() {
        if (xml.readyState == 4 && xml.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            // console.log(respuesta);

            var img = document.getElementById('imagenUsuario');
            var Token = document.getElementById('inputNombreToken');
            var nombre = document.getElementById('inputNombreProducto');
            var cat = document.getElementById('selectCategoria');
            var mar = document.getElementById('selectMarca');
            var precio = document.getElementById('inputPrecio');
            var porsion = document.getElementById('inputProcion');
            var oferta = document.getElementById('inputOferta');
            var descripcion = document.getElementById('textTareaDescripcion');

            img.src = "../.."+respuesta[0].Imagen;
            Token.value = respuesta[0].TokenProd;
            nombre.value = respuesta[0].NomProducto;
            cat.value = respuesta[0].IdCategoria;
            mar.value = respuesta[0].IdMarca;
            precio.value = respuesta[0].PrecioOriginal;
            porsion.value = respuesta[0].Porcion;
            oferta.value = respuesta[0].PrecioOferta;
            descripcion.value = respuesta[0].Descripcion;

        }
    }
}

// ACTUALIZAR PRODUCTOS
document.getElementById("btnActualizar").addEventListener("click", function() {
    var fm = new FormData(formAgregarProductos);
    const http = new XMLHttpRequest();
  
    var url = "../../controlador/consultas/EditarProducto.php";

    http.open("POST", url, true);
    http.send(fm);

    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var mensaje = document.getElementById("mensaje4");
            var respuesta = JSON.parse(http.responseText);
        
            if (respuesta.estado == "5") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "file vacio";
                setTimeout(mostrarMensajeProdEdit, 10000);

            } else if (respuesta.estado == "4") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Hubo un error al guardar el producto vuelva a intentarlo";
                setTimeout(mostrarMensajeProdEdit, 10000);

            } else if (respuesta.estado == "3") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Inserte una imagen de tipo jpg, png o jpeg.";
                setTimeout(mostrarMensajeProdEdit, 10000);

            } else if (respuesta.estado == "2") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "No se permiten caracteres especiales, solo se permiten letras y números, escriba bien sus datos";
                setTimeout(mostrarMensajeProdEdit, 10000);

            } else if (respuesta.estado == "1") {

                limpiarImputs();

                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Datos Actualizados",
                    showConfirmButton: false,
                    timer: 2000,
                });
            } else {
                console.log(respuesta.estado);
            }
        }
    }
})

function mostrarMensajeProdEdit() {
    var mensaje = document.getElementById('mensaje4');

    if(mensaje.style.display != 'none') {
        mensaje.style.display = 'none';
    }
}