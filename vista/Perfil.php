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
    <link rel="stylesheet" href="../estilos/estiloPrin.css">
    <!-- BOOTSTRAP y sweetalert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" 
        crossorigin="anonymous">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body  id="fondo">

    <div id="contMenu"></div>

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
        <div clss="container" hidden>
            <div class="mt-4">
                <p class="fw-bold fs-3 mt-4 my-2 text-center">Dirección</p>
                <div class="contButton mx-auto my-3">
                    <button class="bntAdd" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                        <span class="contIcon"><svg class="iconAdd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M240 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H176V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H240V80z"/></svg></span>
                        Agregar dirección
                    </button>
                </div>
                <div class="row justify-content-md-cente">
                    <div class="col col-lg-6 mx-auto mb-5">

                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Dirección
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-6 col-sm-6 my-2">
                                                <label>Colonía</label>
                                                <input type="text" class="form-control" disabled value="colonia">
                                            </div>
                                            <div class="col-6 col-sm-6 my-2">
                                                <label>Dirección</label>
                                                <input type="text" class="form-control" disabled value="direccion">
                                            </div>
                                            <div class="col-6 col-sm-6 my-2">
                                                <label>Código postal</label>
                                                <input type="text" class="form-control" disabled value="cp">
                                            </div>
                                            <div class="col-6 col-sm-6 my-2">
                                                <label>Núm. Exterior</label>
                                                <input type="text" class="form-control" disabled value="Exterior">
                                            </div>
                                            <div class="col-6 col-sm-6 my-2">
                                                <label>Núm. Interior</label>
                                                <input type="text" class="form-control" disabled value="Interior">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>   
            </div>
        </div>
    </section>

    <!-- JavaScript Bundle with Popper ////////////////////////////////////////////////////// -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" 
    crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" 
    integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>

    <script src="../controlador/peticiones/actualizarUsuario.js"></script>

</body>
</html>
