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


// AGREGAR PRODUCTO
var formAgregarProductos = document.getElementById('formAgregarProductos');
formAgregarProductos.onsubmit = a => {
    var fm = new FormData(formAgregarProductos);
    const http = new XMLHttpRequest();
  
    a.preventDefault();
    var url = "../../controlador/consultas/AgregarProd.php";

    http.open("POST", url, true);
    http.send(fm);

    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var mensaje = document.getElementById("mensaje4");
            var respuesta = JSON.parse(http.responseText);
        
            if (respuesta.estado == "4") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "";

            } else if (respuesta.estado == "3") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Inserte una imagen del producto";

            } else if (respuesta.estado == "2") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "";

            } else if (respuesta.estado == "1") {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Datos almacenados",
                    showConfirmButton: false,
                    timer: 2000,
                });
            }
        }
    }
};

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
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Datos almacenados",
                    showConfirmButton: false,
                    timer: 2000,
                });
                cargarCat(evento);
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
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "Datos almacenados",
                    showConfirmButton: false,
                    timer: 2000,
                });
                cargaMar(evento);
            }
        }
    }
};
////////////////////////////////////////////////////////////////////////////////////////////