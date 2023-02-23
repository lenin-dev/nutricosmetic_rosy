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
        
            if (respuesta.estado == "3") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Inserte una imagen del producto";
            } else if (respuesta.estado == "2") {
                mensaje.style.display = "block";
                mensaje.innerHTML = respuesta.estado;
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
