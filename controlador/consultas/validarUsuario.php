<?php

    require_once("../consultas/conBuscarEmail.php");
    session_start();
    $respuesta = array();

    // tipos:
    // 1 - usuario esta en session
    //      1.3 - el usuario es un admin
    //      1.4 - el usuario es un cliente
    // 2 - usaurio no esta en session

    if (empty($_SESSION['Token'])) {
        $respuesta['estado'] = "2";
    } else {
        $respuesta['estado'] = "1";

        if(validarTipoUsuario() == 1) {
            $respuesta['tipo'] = "3";
        } else {
            $respuesta['tipo'] = "4";
        }
    }

    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);
