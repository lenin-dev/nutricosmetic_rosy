<?php

    include_once("../../controlador/consultas/conexion.php");

    $txtMarca = strtolower($_POST['txtMarca']);
    $respuesta = array();
    $pregMatchText = "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i";     //EXPRECIONES REGULARES preg_match

    if(!preg_match($pregMatchText, $txtMarca) || $txtMarca == " ") {
        $respuesta['estado'] = "4";
    } else {
        if(buscarRepetido($txtMarca, $cn) == 1) {
            $respuesta['estado'] = "3";
        } else {
            if(addMarc($txtMarca, $cn) == 1) {
                $respuesta['estado'] = "1";
            } else {
                $respuesta['estado'] = "2";
            }
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
        $queryBuscarCat = "SELECT NomMarca FROM marca WHERE NomMarca='$txtMarca'";
        $resultado = $cn->query($queryBuscarCat);
        if(mysqli_num_rows($resultado)>0) {
            return 1;
        } else {
            return 0;
        }
    }


    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);