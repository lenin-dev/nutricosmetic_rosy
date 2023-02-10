window.addEventListener("load", function(){
    cargarUsu();
});

function cargarUsu() {
    const http = new XMLHttpRequest();
    const url = './consultas/validarUsuario.php';

    http.open('POST', url);
    http.send();

    http.onreadystatechange == function() {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById("respuesta5").innerHTML = this.responseText;
            alert(this.responseText);
        }
    }
}