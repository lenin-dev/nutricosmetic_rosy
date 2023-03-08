<?php

    include_once('../../controlador/consultas/conexion.php');

    $clave = $_POST['clave'];
    $respuesta = array();

    // 1-Consulta ejecutada correctamente
    // 2-Variable vacia
    // 3-Consulta no ejecutada error

    if(!empty($clave)) {
        
        if(searchProd($clave, $cn) == 1) {
            $respuesta['estado'] = '1';
        } else {
            $respuesta['estado'] = '3';
        }

    } else {
        $respuesta['estado'] = '2';
    }

    function searchProd($clave, $cn) {
        $queryBuscar = "SELECT * FROM productos WHERE TokenProd='$clave'";

        if($respQuerySearch = $cn->query($queryBuscar)) {

            if($busquedaId = mysqli_fetch_array($respQuerySearch)) {
                $idProd = $busquedaId['IdProducto'];

                if(eliminarProdCat($idProd, $cn) == 1) {
                    return 1;

                } else {
                    return 0;
                }

            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function eliminarProdCat($idProd, $cn) {
        $queryEliminarRel = "DELETE FROM relacionprodcat WHERE IdProducto='$idProd'";
        $queryEliminarProd = "DELETE FROM productos WHERE IdProducto='$idProd'";

        if($cn->query($queryEliminarRel)) {
            if ($cn->query($queryEliminarProd)) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    echo json_encode($respuesta);