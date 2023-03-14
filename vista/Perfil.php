<?php
    require("../controlador/consultas/conexion.php");
    session_start();
    $clave = $_SESSION['Token'];

    if(empty($_SESSION['Token'])) {
        header("location: ./IniciarSesion.html");
    } else {
        $queryGetUsu = "SELECT * FROM usuarios WHERE Token='$clave'";
        if($ejecutarQueary = $cn->query($queryGetUsu)) {

            if($busqueda = mysqli_fetch_array($ejecutarQueary)) {
                $nombre = $busqueda['NombreCom'];
                $celular = $busqueda['Celular'];
                $correo = $busqueda['Email'];

                if(empty($busqueda['DirecImagen'])) {
                    $imagen = "../galeria/iconos/usuario.png";
                } else {
                    $imagen = "..".$busqueda['DirecImagen'];
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>

    <link rel="stylesheet" href="../estilos/estiloPrin.css">
    <link rel="icon" href="../galeria/iconos/iconotienda.ico">
    <!-- BOOTSTRAP y sweetalert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" 
        crossorigin="anonymous">
</head>
<body id="fondo">

    <!-- encabezado, menu principal ////////////////////////////////////////////////////// -->
    <!-- nombre y logo de la pagina /////////////////////////////////////////////// -->
    <nav class="navbar navbar-expand-lg" style="background-color: #F6C62E">
        <div class="container-sm">
            <a class="navbar-brand mb-0 h1" href="../index.html">
                <img src="../galeria/iconos/iconotienda.png" alt="Logo" width="40" height="40" 
                class="d-inline-block align-text-center">
            </a>
    <!-- boton hamburguesa /////////////////////////////////////////////////// -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Toggle navigation">
	            <span class="navbar-toggler-icon"></span>
            </button>
    <!-- opciones del menu ////////////////////////////////////////////////////////// -->
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active fs-6 fw-bold" id="pageInicio" aria-current="page" href="../#productos">INICIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active fs-6 fw-bold" id="pageQuienesSomos" href="../#quiensoy">QUIÉN SOY</a>
                </li>
                <li class="nav-item mb-2 mt-2">
                    <a href="#" id="btn-fav" class="btn-transparent position-relative mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="../galeria/iconos/favorito.png" height="30" width="30" alt="carrito-de-compras">
                        <span id="numCountFav" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                </li>
            </ul>
    <!-- icono de usuario /////////////////////////////////////////////////////////////// -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="navbar-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../galeria/iconos/usuario22.png" id="imgIconNavbar" alt="Logo" width="40" height="40" class="iconUsuario d-inline-block align-text-center">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a id="prod" class="dropdown-item" href="../vista/vistaAdmin/crudProductos.php">Administrar productos</a></li>
                        <li><a id="resp2" class="dropdown-item" href="../vista/Perfil.php">Perfil</a></li>
                        <li><hr id="resp3" class="dropdown-divider" id="resp"></li>
                        <li><a id="resp4" class="dropdown-item" href="../controlador/consultas/cerrarSesion.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Modal favoritos -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Favoritos</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Oferta</th>
                            <th>Limpiar</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTable"></tbody>
                </table>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" id="vaciar-fav" class="btn btn-primary">Vaciar</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Editar imagen -->
    <div class="modal fade text-center" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar datos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formActualizarDatos" name="formActualizarDatos" method="post">
                        <div class="alert alert-danger mensaje3" id="mensaje3" role="alert"></div>
                        <div class="mb-3">
                            <img src="<?php echo $imagen; ?>" class="imagenUsuario" name="imagenUsuario" id="imagenUsuario" alt="imgEditable">
                            <div class="file-input">
                                <input type="file" name="file-input" onchange="mostrar(event)" id="file-input" class="file-input__input"/>
                                <label class="file-input__label" for="file-input"><path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path></svg>
                                    <span>Subir imagen</span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Nombre</label>
                            <input type="text" value="<?php echo $nombre; ?>" class="form-control" name="etiquetaNombre">
                        </div>
                        <div class="mb-3">
                            <label>Celular</label>
                            <input type="text" value="<?php echo $celular; ?>" class="form-control" name="etiquetaCelular">
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="reload" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="sumit" id="enviar" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
                    
            </div>
        </div>
    </div>

    <!-- contenido pagina -->
    <section class="container pt-4 pb-3 mt-1 bg-light mt-5 text-center" id="border-radius">
        <div class="row row-cols-1 row-cols-md-3 my-3">
            <div class="col-sm-12 col-md-4 mx-auto">
                <div class="mb-3">
                    <div class="contenedorIcon mt-5">
                        <img src="<?php echo $imagen; ?>" id="imgUsuario" class="imagenUsuario" alt="editImg1">
                        <button type="button" class="mx-auto btnContIcon" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img class="btnEditar" src="../galeria/iconos/lapiz.png" alt="editar"></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-5 mx-auto">
                <label class="fw-bold fs-3 my-2 text-center">Datos de usuario</label>
                <input type="text" name="nombre" value="<?php echo $nombre; ?>" class="form-control my-2" disabled>
                <input type="text" name="correo" value="<?php echo $correo; ?>" class="form-control my-2" disabled>
                <input type="text" name="celular" value="<?php echo $celular; ?>" class="form-control my-2" disabled>
            </div>
        </div>
    </section>

    <div id="footer"></div>


    <!-- JavaScript Bundle with Popper ////////////////////////////////////////////////////// -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" 
    crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>

    <script src="../controlador/peticiones/actualizarUsuario.js"></script>
    <script src="../controlador/peticiones/validacionUsuario.js"></script>

</body>
</html>
