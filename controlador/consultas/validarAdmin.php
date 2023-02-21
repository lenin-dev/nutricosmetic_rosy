<?php
    include_once("../../controlador/consultas/conBuscarEmail.php");
    session_start();
    $respuesta = array();
    if(empty($_SESSION['Token'])) {
        $respuesta['estado'] = 2;
    } else {
        if(validarTipoUsuario() == 1) {
            $respuesta['estado'] = 1;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta);