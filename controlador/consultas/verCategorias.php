<?php

    include_once("../../controlador/consultas/conexion.php");
    $respuesta = array();

    $querySelect = "SELECT * FROM categoria ORDER BY NomCategoria asc";

    if($result = $cn->query($querySelect)) {

        for($i = 0; $i<$result->num_rows;$i++) {
            $respuesta[$i] = $result->fetch_assoc();
        }

    } else {
        $respuesta['estado'] = "2";
    }

    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);