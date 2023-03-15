window.addEventListener("load", function() {
    cargarDatosProd();
})

var URLsearch = window.location.search;

function cargarDatosProd() {
    const xml = new XMLHttpRequest();
    const url = "../../controlador/consultas/verProductos.php"+URLsearch;

    xml.open("GET", url, true);
    // xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send();

    xml.onreadystatechange = function() {
        if (xml.readyState == 4 && xml.status == 200) {
            var respuesta = JSON.parse(this.responseText);

            var img = document.getElementById('img-prod');
            var titulo = document.getElementById('titulo-producto');
            var marca = document.getElementById('marca');
            var categoria = document.getElementById('categoria');
            var precio = document.getElementById('precio');
            var precio2 = document.getElementById('precio2');

            var precioN = document.getElementById('sms-precio-n');
            var precioO = document.getElementById('sms-precio-o');
            var precioO2 = document.getElementById('sms-precio-o2');

            var oferta = document.getElementById('oferta');
            var descripcion = document.getElementById('descripcion');

            img.src = "../.."+respuesta[0].Imagen;
            titulo.innerHTML = respuesta[0].NomProducto;
            marca.innerHTML = respuesta[0].NomMarca;
            categoria.innerHTML = respuesta[0].NomCategoria;
            descripcion.innerHTML = respuesta[0].Descripcion;

            if(respuesta[0].PrecioOferta > 0) {
                precioO.style.display = 'block';
                precioO2.style.display = 'block';
                precio2.innerHTML = respuesta[0].PrecioOriginal;
                oferta.innerHTML = respuesta[0].PrecioOferta;
            } else {
                precio.innerHTML = respuesta[0].PrecioOriginal;
                precioN.style.display = 'block';
            }
        }
    }
}

document.getElementById('btnCarrito').addEventListener("click", function() {
    agregarFav(URLsearch);
})

function agregarFav(URLsearch) {
    const xml = new XMLHttpRequest();
    const url = "../../controlador/consultas/agregarFavoritos.php"+URLsearch;

    xml.open("GET", url, true);
    // xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send();

    xml.onreadystatechange = function() {
        if (xml.readyState == 4 && xml.status == 200) {
            var respuesta = JSON.parse(this.responseText);

            if(respuesta.estado == "1") {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Agregado',
                    showConfirmButton: false,
                    timer: 1500
                  })
            } else if(respuesta.estado == "2") {
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'Ya se encuentra agregado',
                    showConfirmButton: false,
                    timer: 1500
                  })
            } else if(respuesta.estado == "4") {
                Swal.fire({
                    position: 'top-center',
                    icon: 'warning',
                    title: 'Debe iniciar sesión',
                    showConfirmButton: false,
                    timer: 1500
                  })
            } else {
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'Hubo un error, intentelo más tarde',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }
            
        }
    }
}