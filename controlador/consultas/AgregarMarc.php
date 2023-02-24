<?php

    include_once("../../controlador/consultas/conexion.php");

    $txtMarca = strtolower($_POST['txtMarca']);
    $respuesta = array();

    if(buscarRepetido($txtMarca, $cn) == 0) {
        $respuesta['estado'] = "3";
    } else {
        if(addMarc($txtMarca, $cn) == 1) {
            $respuesta['estado'] = "1";
        } else {
            $respuesta['estado'] = "2";
        }
    }

    function addMarc($txtMarca, $cn) {
        $queryAddCat = "INSERT INTO marca(NomMarca) VALUES ('$txtMarca')";
        if($resp = $cn->query($queryAddCat)) {
            return 1;
        } else {
            return 0;
        }
    }

    function buscarRepetido($txtMarca, $cn) {
        $queryBuscarCat = "SELECT * FROM marca WHERE NomMarca='$txtMarca'";
        if($resp = $cn->query($queryBuscarCat)) {
            return 1;
        } else {
            return 0;
        }
    }


    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);