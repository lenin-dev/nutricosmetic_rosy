'use strict'
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

// RECARGAR LA PAGINA
var btnCerrar = document.getElementById("reload");
btnCerrar.addEventListener("click", () => {
    location.reload();
});


// ACCION ACTUALIZAR
var formActualizar = document.getElementById('formActualizarDatos');
formActualizar.onsubmit = a => {
    var fm = new FormData(formActualizar);
    const http = new XMLHttpRequest();
  
    a.preventDefault();
    var url = "../controlador/consultas/ActualizarDatosUsu.php";

    http.open("POST", url, true);
    http.send(fm);
    http.onreadystatechange = function() {
        if (http.readyState == 4 && http.status == 200) {
            var mensaje = document.getElementById("mensaje3");
            var respuesta = JSON.parse(http.responseText);
        
            if (respuesta.estado == "3") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Hubo un error al actualizar, vuelvalo a intentar";
            } else if (respuesta.estado == "2") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "El tipo de imagen debe de ser jpg, png o jpeg";
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
