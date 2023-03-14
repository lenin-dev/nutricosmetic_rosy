<?php

    include_once("../../controlador/consultas/conexion.php");
    session_start();
    $idUsuario = $_SESSION['Token'];
    $respuesta = array();

    if($_POST['clave'] != 0) {
        $clave = $_POST['clave'];

        if(!empty($idUsuario)) {
            if(vaciarUno($cn, $clave, $idUsuario) == 1) {
                $respuesta['estado'] = '1';
            } else {
                $respuesta['estado'] = '3';
            }
        } else {
            $respuesta['estado'] = '2';
        }

    } else {

        if(!empty($idUsuario)) {
            if(vaciarTodos($cn, $idUsuario) == 1) {
                $respuesta['estado'] = '1';
            } else {
                $respuesta['estado'] = '3';
            }
        } else {
            $respuesta['estado'] = '2';
        }
        
    }


    function vaciarTodos($cn, $idUsuario) {
        $queryEliminarFav = "DELETE carrito
        FROM carrito 
        LEFT JOIN usuarios 
        ON usuarios.IdUsuario=carrito.IdUsuario 
        WHERE usuarios.Token='$idUsuario'";

        if($cn->query($queryEliminarFav)) {
            return 1;
        } else {
            return 0;
        }
    }

    function vaciarUno($cn, $clave, $idUsuario) {
        $queryEliminarFav = "DELETE carrito
        FROM carrito 
        LEFT JOIN usuarios 
        ON usuarios.IdUsuario=carrito.IdUsuario 
        WHERE carrito.IdProducto='$clave' AND usuarios.Token='$idUsuario'";

        if($cn->query($queryEliminarFav)) {
            return 1;
        } else {
            return 0;
        }
    }

// CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
header('Content-Type: application/json');
echo json_encode($respuesta);
