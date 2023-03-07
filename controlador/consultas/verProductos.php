<?php

    include_once("../../controlador/consultas/conexion.php");
    $respuesta = array();

    $querySelect = "SELECT pr.TokenProd, c.NomCategoria, m.NomMarca, pr.NomProducto, pr.Porcion, pr.PrecioOriginal, pr.PrecioOferta 
    FROM productos pr, marca m, relacionprodcat rel, categoria c 
    WHERE m.IdMarca = pr.IdMarca AND rel.IdProducto = pr.IdProducto AND rel.IdCategoria = c.IdCategoria";

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