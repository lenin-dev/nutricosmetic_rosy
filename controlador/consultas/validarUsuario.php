<?php

    session_start();
    if (empty($_SESSION['NomUsuario'])) {
        echo "vacio";
    } else {
        echo "lleno";
    }