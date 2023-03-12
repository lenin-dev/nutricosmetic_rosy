<?php

    include_once("../consultas/conexion.php");
    include_once("../consultas/conBuscarEmail.php");    // HACE LLAMADO A OTRO DOC .PHP

    // VUELVE EL STRING EN MINISCULAS Y CONVIERTE DE INT A STRING
    $nombre = strtolower($_POST['txtNombre']);
    $cel = (string)$_POST['txtCelular'];
    $email = $_POST['txtEmail'];
    $pass1 = $_POST['txtPass1'];
    $pass2 = $_POST['txtPass2'];
    $tipoUsuario = 2;
    $respuesta = array();
    $imgR = '/galeria/iconos/usuario.png';

    // ENCRIPTACION DE CONTRASEÑAS Y TOKEN DE USUARIO
    $passEncript = MD5($pass1);
	$token = MD5($nombre."+".$email."+".$cel);

    // estados
    // 1 - completado
    // 2 - error contraseña
    // 3 - error ya existe
    // 4 - hubo un error al guardar
    // 5 - campos vacios
    
    if(searchRepeated($email, $cn) == 1) {  // HACE USO DE LA FUNCTION DEL DOC .PHP
        $respuesta['estado'] = "3";
    } else if($pass1 != $pass2) {
        $respuesta['estado'] = "2";
    } else if(empty($nombre) && empty($cel) && empty($email) && empty($pass1) && empty($pass2)) {
        $respuesta['estado'] = "5";
    } else {
        $queryAdd = "INSERT INTO usuarios(Token,NombreCom,Email,Contrasena,Celular,IdTipoUsuario,Imagen) VALUES ('$token','$nombre','$email','$passEncript','$cel','$tipoUsuario','$imgR')";

        if(!$queryEjecutable = $cn->query($queryAdd)) {     // EJECUTA CONSULTA Y PREGUNTA CON IF SI SE EJECUTO CORRECTAMENTE
            $respuesta['estado'] = "4";
        } else {
            $respuesta['estado'] = "1";
        }
    }

    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    