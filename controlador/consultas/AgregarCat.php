<?php

    include_once("../../controlador/consultas/conexion.php");

    $txtCategoria = strtolower($_POST['txtCategoria']);
    $respuesta = array();
    $pregMatchText = "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i";     //EXPRECIONES REGULARES preg_match

    if(!preg_match($pregMatchText, $txtCategoria) || $txtCategoria == " ") {
        $respuesta['estado'] = "4";
    } else {
        if(buscarRepetido($txtCategoria, $cn) == 1) {
            $respuesta['estado'] = "3";
        } else {
            if(addCat($txtCategoria, $cn) == 1) {
                $respuesta['estado'] = "1";
            } else {
                $respuesta['estado'] = "2";
            }
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
        $resp = $cn->query($queryBuscarCat);
        if(mysqli_num_rows($resp)>0) {
            return 1;
        } else {
            return 0;
        }
    }


    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);
