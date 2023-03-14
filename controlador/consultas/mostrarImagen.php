<?php

    require_once("./conexion.php");
    session_start();
    $respuesta = array();

    if(empty($_SESSION['Token'])) {
        $respuesta['contImagen'] = 2;
    } else {
        $respuesta['contImagen'] = 1;
        $clave = $_SESSION['Token'];
        $queryGetUsu = "SELECT * FROM usuarios WHERE Token='$clave'";
        if($ejecutarQueary = $cn->query($queryGetUsu)) {

            if($busqueda = mysqli_fetch_array($ejecutarQueary)) {
                if($busqueda['DirecImagen'] == null) {
                    $respuesta['imagen'] = "/galeria/iconos/usuario.png";
                } else {
                    $respuesta['imagen'] = $busqueda['DirecImagen'];
                }
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta);
