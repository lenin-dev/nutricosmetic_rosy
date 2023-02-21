<?php
    session_start();
    if(empty($_SESSION['Token'])) {
        header("location: ./../IniciarSesion.html");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../estilos/estiloPrin.css">

    <!-- BOOTSTRAP y sweetalert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" 
        crossorigin="anonymous">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Productos</title>
</head>
<body id="fondo">

    <!-- encabezado, menu principal ////////////////////////////////////////////////////// -->
    <!-- nombre y logo de la pagina /////////////////////////////////////////////// -->
    <nav class="navbar navbar-expand-lg" style="background-color: #F6C62E">
        <div class="container-sm">
            <a class="navbar-brand mb-0 h1" href="../../">
                <img src="../../galeria/iconos/iconotienda.png" alt="Logo" width="40" height="40" 
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
                    <a class="nav-link active fs-6 fw-bold" id="pageInicio" aria-current="page" href="../../#productos">INICIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active fs-6 fw-bold" id="pageQuienesSomos" href="../../#quiensoy">QUIÉN SOY</a>
                </li>
                <li class="nav-item mb-2 mt-2">
                    <a href="#" class="btn-transparent position-relative mx-3">
                        <img src="../../galeria/iconos/carrito-de-compras.png" height="30" width="30" alt="carrito-de-compras">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            1
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                </li>
            </ul>
    <!-- icono de usuario /////////////////////////////////////////////////////////////// -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="navbar-brand dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../galeria/iconos/usuario.png" id="imgIconNavbar" alt="Logo" width="40" height="40" class="iconUsuario d-inline-block align-text-center">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a id="prod" class="dropdown-item" href="../../vista/vistaAdmin/crudProductos.html">Administrar productos</a></li>
                        <li><a id="resp2" class="dropdown-item" href="../../vista/Perfil.php">Perfil</a></li>
                        <li><hr id="resp3" class="dropdown-divider" id="resp"></li>
                        <li><a id="resp4" class="dropdown-item" href="../../controlador/consultas/cerrarSesion.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    

    <!-- JavaScript Bundle with Popper ////////////////////////////////////////////////////// -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" 
    crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <script src="../../controlador/peticiones/validacionUsuario.js"></script>

</body>
</html>