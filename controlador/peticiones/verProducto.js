window.addEventListener("load", function() {
    cargarDatosProd();
})

function cargarDatosProd() {
    const xml = new XMLHttpRequest();
    const url = "../../controlador/consultas/verProductos.php";

    xml.open("GET", url, true);
    xml.send();

    xml.onreadystatechange = function() {
        if (xml.readyState == 4 && xml.status == 200) {
            var respuesta = JSON.parse(this.responseText);
            console.log(respuesta);

            // var img = document.getElementById('imagenUsuario');
            // var Token = document.getElementById('inputNombreToken');
            // var nombre = document.getElementById('inputNombreProducto');
            // var cat = document.getElementById('selectCategoria');
            // var mar = document.getElementById('selectMarca');
            // var precio = document.getElementById('inputPrecio');
            // var porsion = document.getElementById('inputProcion');
            // var oferta = document.getElementById('inputOferta');
            // var descripcion = document.getElementById('textTareaDescripcion');

            // img.src = "../.."+respuesta[0].Imagen;
            // Token.value = respuesta[0].TokenProd;
            // nombre.value = respuesta[0].NomProducto;
            // cat.value = respuesta[0].IdCategoria;
            // mar.value = respuesta[0].IdMarca;
            // precio.value = respuesta[0].PrecioOriginal;
            // porsion.value = respuesta[0].Porcion;
            // oferta.value = respuesta[0].PrecioOferta;
            // descripcion.value = respuesta[0].Descripcion;

        }
    }
}