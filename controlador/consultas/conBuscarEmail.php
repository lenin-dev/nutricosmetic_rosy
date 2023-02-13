<?php

    // BUSCA SI EXISTE EL EMAIL
    function searchRepeated($email, $cn) {
        $sql = "SELECT * FROM usuarios WHERE Email='$email'";
        $resultBusqueda = mysqli_query($cn, $sql);

        if (mysqli_num_rows($resultBusqueda)>0) {
            return 1;
        } else {
            return 0;
        }
    }

    // VERIFICA TIPO DE USUARIO AGREGADO A LA SESSION
    function validarTipoUsuario() {
        require_once("./conexion.php");
        // session_start();
        $token = $_SESSION['Token'];
        $queryTipoUsuario = "SELECT * FROM usuarios WHERE Token='$token'";

        if($respQuery = $cn->query($queryTipoUsuario)) {    // EJECUTA LA CONSULTA Y SI SE EJECUTA CORRECTAMENTE

            if($busqueda = mysqli_fetch_array($respQuery)) {    // BUSCA Y OBTIENE VALORES DE LA CONSULTA ANTERIOS CON EL FETCH ARRAY
                
                if($busqueda['IdTipoUsuario'] == 1) {   // VERIFICA SI EL ID TIPO USUARIO ES A UN ADMIN O CLIENTE
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
