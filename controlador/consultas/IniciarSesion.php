<?php

    include("../consultas/conexion.php");
    include("../consultas/conBuscarEmail.php");

    session_start();
    $email = $_POST['txtEmail'];
    $pass = $_POST['txtPass'];
    $respuesta = array();
    // estados
    // 1 - completado
    // 2 - error de email o contraseña
    // 3 - error ya existe
    // 4 - no existe el email
    // 5 - campos vacios

    if(!empty($email) && !empty($pass)) {
        if(searchRepeated($email, $cn) == 1) {

            if(buscarUsuario($email, $pass, $cn) == 1) {
                $respuesta['estado'] = "1";
            } else {
                $respuesta['estado'] = "2";
            }

        } else {
            $respuesta['estado'] = "4";
        }
    } else {
        $respuesta['estado'] = "3";
    }

    function buscarUsuario($email, $pass, $cn) {
        $passEncript = MD5($pass);
        $queryBuscar = "SELECT * FROM usuarios WHERE Email='$email' AND Contrasena='$passEncript'";
        $ejecutarQuery = $cn->query($queryBuscar);

        if($busqueda = mysqli_fetch_array($ejecutarQuery)) {
			$busquedaNombre = $busqueda['NombreCom'];
			$busquedaEmail = $busqueda['Email'];
			$busquedaTel = $busqueda['Celular'];
            $busquedaToken = $busqueda['Token'];

            // ALMACENANDO EN SESSION
            $_SESSION['Email'] = $busquedaEmail;
            $_SESSION['Token'] = $busquedaToken;

		} else {
            return 0;
        }

        $token = MD5($busquedaNombre."+".$busquedaEmail."+".$busquedaTel);
        if($busquedaToken == $token) {
            return 1;
        } else {
            return 0;
        }
    }

    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);
