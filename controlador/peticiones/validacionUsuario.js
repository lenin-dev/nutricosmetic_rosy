window.addEventListener("load", function(){
    cargarUsu();
});

function cargarUsu() {
    const http = new XMLHttpRequest();
    const url = './controlador/consultas/validarUsuario.php';

    http.open('POST', url);
    http.send();

    http.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            var linea1 = document.getElementById("resp1");
            var linea2 = document.getElementById("resp2");
            var linea3 = document.getElementById("resp3");
            var linea4 = document.getElementById("resp4");
            var prod = document.getElementById("prod");

            var respuesta = JSON.parse(http.responseText);

            if(respuesta.estado == "1") {
                linea1.style.display = "none";
                
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
