<?php

    include_once("../../controlador/consultas/conexion.php");

    $txtCategoria = strtolower($_POST['txtCategoria']);
    $respuesta = array();

    if(buscarRepetido($txtCategoria, $cn) == 0) {
        $respuesta['estado'] = "3";
    } else {
        if(addCat($txtCategoria, $cn) == 1) {
            $respuesta['estado'] = "1";
        } else {
            $respuesta['estado'] = "2";
        }
    }

    function addCat($txtCategoria, $cn) {
        $queryAddCat = "INSERT INTO categoria(NomCategoria) VALUES ('$txtCategoria')";
        if($resp = $cn->query($queryAddCat)) {
            return 1;
        } else {
            return 0;
        }
    }

    function buscarRepetido($txtCategoria, $cn) {
        $queryBuscarCat = "SELECT * FROM categoria WHERE NomCategoria='$txtCategoria'";
        if($resp = $cn->query($queryBuscarCat)) {
            return 1;
        } else {
            return 0;
        }
    }


    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);
