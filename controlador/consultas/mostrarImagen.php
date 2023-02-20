<?php

    require_once("./conexion.php");
    session_start();
    $clave = $_SESSION['Token'];
    $respuesta = array();

    if(empty($_SESSION['Token'])) {
        header("location: ../vista/IniciarSesion.html");
    } else {
        $queryGetUsu = "SELECT * FROM usuarios WHERE Token='$clave'";
        if($ejecutarQueary = $cn->query($queryGetUsu)) {

            if($busqueda = mysqli_fetch_array($ejecutarQueary)) {
                if(empty($busqueda['DirecImagen'])) {
                    $respuesta['imagen'] = "../galeria/iconos/usuario.png";
                } else {
                    $respuesta['imagen1'] = "..".$busqueda['DirecImagen'];
                    $respuesta['imagen2'] = ".".$busqueda['DirecImagen'];
                }
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta);
