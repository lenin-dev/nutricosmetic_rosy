<?php

    include_once("../../controlador/consultas/conexion.php");
    $respuesta = array();

    $querySelect = "SELECT IdMarca, NomProducto, Porcion, PrecioOriginal, PrecioOferta FROM productos";
    // $querySelectNum = "SELECT count(*) FROM productos";

    if($result = $cn->query($querySelect)) {
        // $resultCount = $cn->query($querySelectNum);
        // $respuesta['count'] = $resultCount->num_rows;

        for($i = 0; $i<$result->num_rows;$i++) {
            $respuesta[$i] = $result->fetch_assoc();
        }

    } else {
        $respuesta['estado'] = "2";
    }

    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);