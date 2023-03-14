<?php

include_once("../../controlador/consultas/conexion.php");
session_start();
$respuesta = array();

if(!empty($_POST['id'])) {
    if(isset($_SESSION['Token'])) {
        $tokenUsu = trim($_SESSION['Token']);
        $queryBusqFav = "SELECT p.Imagen, p.NomProducto, p.PrecioOferta, p.PrecioOriginal, c.IdProducto, c.IdUsuario FROM productos AS p, carrito AS c WHERE p.IdProducto=c.IdProducto";
        $result = $cn->query($queryBusqFav);
        for($i = 0; $i < $result->num_rows; $i++) {
            $respuesta[$i] = $result->fetch_assoc();
        }
        goto a;
    } else {
        $respuesta['estado'] = '0';
        goto a;
    }
}

if(isset($_SESSION['Token'])) {
    $tokenUsu = trim($_SESSION['Token']);
    $queryBusqFav = "SELECT count(c.IdUsuario) total FROM usuarios AS u, carrito AS c WHERE u.Token='$tokenUsu' AND u.IdUsuario=c.IdUsuario";
    $result = mysqli_query($cn, $queryBusqFav);
    $respuesta['total'] = mysqli_fetch_assoc($result);
} else {
    $respuesta['total'] = '0';
}
a:
// CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
header('Content-Type: application/json');
echo json_encode($respuesta);