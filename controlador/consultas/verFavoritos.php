<?php

include_once("../../controlador/consultas/conexion.php");
session_start();

$respuesta = array();

if(isset($_SESSION['Token'])) {
    $tokenUsu = trim($_SESSION['Token']);
    $queryBusqFav = "SELECT count(c.IdUsuario) total FROM usuarios AS u, carrito AS c WHERE u.Token='28e18a5d666c2d2c3f3bb1f546a93374' AND u.IdUsuario=c.IdUsuario";
    $result = mysqli_query($cn, $queryBusqFav);
    $respuesta['total'] = mysqli_fetch_assoc($result);
} else {
    $respuesta['total'] = '0';
}

// CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
header('Content-Type: application/json');
echo json_encode($respuesta);