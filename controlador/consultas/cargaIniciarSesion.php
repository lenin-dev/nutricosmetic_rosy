<?php

    session_start();
    $respuesta = array();
    if(!empty($_SESSION['Token'])) {
        $respuesta['estado'] = '1';
    } else {
        $respuesta['estado'] = '2';

    }
    
    header('Content-Type: application/json');
    echo json_encode($respuesta);