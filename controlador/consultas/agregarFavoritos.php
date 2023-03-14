<?php

    include_once("../../controlador/consultas/conexion.php");
    session_start();
    $respuesta = array();

    if(!empty($_SESSION['Token'])) {
        $idFav = trim($_GET['clave']);
        $tokenUsu = trim($_SESSION['Token']);
    } else {
        $respuesta['estado'] = '4';
        goto salir;
    }

    if(buscarRepetido($cn, $tokenUsu, $idFav) == 1) {
        $respuesta['estado'] = '2';
    } else {
        $queryAddFav = "INSERT INTO carrito (IdUsuario, IdProducto) SELECT u.IdUsuario, p.IdProducto FROM usuarios AS u, productos AS p WHERE p.TokenProd='$idFav' AND u.Token='$tokenUsu'";
        if($queryResp = $cn->query($queryAddFav)) {
            $respuesta['estado'] = '1';
        } else {
            $respuesta['estado'] = '3';
        }
    }

    function buscarRepetido($cn, $tokenUsu, $idFav) {
        $resultUsu = buscarIdUsu($cn, $tokenUsu);
        $resultProd = buscarIdProd($cn, $idFav);

        $querySelectCar = "SELECT IdUsuario, IdProducto FROM carrito WHERE IdUsuario='$resultUsu' AND IdProducto='$resultProd'";
        $resp = mysqli_query($cn, $querySelectCar);

        if (mysqli_num_rows($resp)>0) {
            return 1;
        } else {
            return 0;
        }
    }

    function buscarIdProd($cn, $idFav) {
        $selectprod = "SELECT * FROM productos WHERE TokenProd='$idFav'";
        $resp = mysqli_query($cn, $selectprod);
        if($busqueda = mysqli_fetch_array($resp)) {
            $producto = $busqueda['IdProducto'];
        }
        return $producto;
    }

    function buscarIdUsu($cn, $tokenUsu) {
        $selectUsu = "SELECT * FROM usuarios WHERE Token='$tokenUsu'";
        $resp = $cn->query($selectUsu);
        if($busqueda = mysqli_fetch_array($resp)) {
            $usuario = $busqueda['IdUsuario'];
        }
        return $usuario;
    }
    
    salir:
    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);