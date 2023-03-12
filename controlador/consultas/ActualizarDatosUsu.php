<?php

    include_once("conexion.php");
    session_start();

    $imagenName = $_FILES['file-input'];    // DEVUELVE UNA CADENA DE LOS ATRIBUTOS DE LA IMAGEN
	$imagenTmp = $_FILES['file-input']['tmp_name']; // OBTENGO EL NOMBRE TEMPORAL DE LA IMAGEN
	$nomEncript = md5($_FILES['file-input']['tmp_name']);  // ENCRIPTO CON MD5 EL NOMBRE TEMPORAL DE LA IMAGEN
	// $imagContent = addslashes(file_get_contents($imagenTmp));

    $nombre = $_POST['etiquetaNombre'];
    $celular = $_POST['etiquetaCelular'];
    $png = ".png";
	$jpeg = ".jpeg";
	$jpg = ".jpg";
    $respuesta = array();
    $emailOring = $_SESSION['Email'];
    $clave = MD5($nombre."+".$_SESSION['Email']."+".$celular);

    if($_FILES['file-input']['name'] == null) {
        if(actualizarDatosUsuSinImg($cn, $celular, $nombre, $clave, $emailOring) == 1) {
            $respuesta['estado'] = "1";
        } else {
            $respuesta['estado'] = "3";
        }
    } else {
        // PREGUNTO QUE TIPO DE IMAGEN ES SI JPG, PNG O JPEG
        if ($imagenName['type'] === "image/png" || $imagenName['type'] === "image/PNG") {
            $rutaDestino1 = $_SERVER['DOCUMENT_ROOT']."/nutricosmetic_rosy/galeria/usuarios/".$nomEncript.$png;    // OBTENGO LA RUTA DONDE SE ALMACENARAN LAS IMAGENES
            $rutaDefinitiva1 = "/galeria/usuarios/".$nomEncript.$png;

            // FUNCION PARA ELIMINAR
            if(eliminarImagen($cn, $emailOring) == 0) {
                return 0;
            } else {
                // FUNCION PARA ACTUALIZAR
                if(actualizarDatosUsu($cn, $rutaDefinitiva1, $celular, $nombre, $clave, $emailOring) == 0) {   // METODO PARA ACTUALIZAR
                    $respuesta['estado'] = "3";
                } else {
                    // PARA COPIAR Y MOVER IMAGEN AL DIRECTORIO IMAGENES
                    copy($_FILES["file-input"]["tmp_name"], $rutaDestino1); // COPIO LAS IMAGENES A LA CARPETA DE RUTADESTINO
                    move_uploaded_file(basename($_FILES["file-input"]["tmp_name"]), $rutaDestino1.$png);    // MUEVO LA IMAGEN A LA CARPETA DESTINO 
                    $respuesta['estado'] = "1";
                }
            }
        } else if($imagenName['type'] === "image/jpg" || $imagenName['type'] === "image/JPG") {
            $rutaDestino2 = $_SERVER['DOCUMENT_ROOT']."/nutricosmetic_rosy/galeria/usuarios/".$nomEncript.$jpg;    // OBTENGO LA RUTA DONDE SE ALMACENARAN LAS IMAGENES
            $rutaDefinitiva2 = "/galeria/usuarios/".$nomEncript.$jpg;

            // FUNCION PARA ELIMINAR
            if(eliminarImagen($cn, $emailOring) == 0) {
                return 0;
            } else {
                // FUNCION PARA ACTUALIZAR
                if(actualizarDatosUsu($cn, $rutaDefinitiva2, $celular, $nombre, $clave, $emailOring) == 0) {   // METODO PARA ACTUALIZAR
                    $respuesta['estado'] = "3";
                } else {
                    // PARA COPIAR Y MOVER IMAGEN AL DIRECTORIO IMAGENES
                    copy($_FILES["file-input"]["tmp_name"], $rutaDestino2); // COPIO LAS IMAGENES A LA CARPETA DE RUTADESTINO
                    move_uploaded_file(basename($_FILES["file-input"]["tmp_name"]), $rutaDestino2.$jpg);  // MUEVO LA IMAGEN A LA CARPETA DESTINO 
                    $respuesta['estado'] = "1";
                }
            }
        } else if($imagenName['type'] === "image/jpeg" || $imagenName['type'] === "image/JPEG") {
            $rutaDestino3 = $_SERVER['DOCUMENT_ROOT']."/nutricosmetic_rosy/galeria/usuarios/".$nomEncript.$jpeg;    // OBTENGO LA RUTA DONDE SE ALMACENARAN LAS IMAGENES;
            $rutaDefinitiva3 = "/galeria/usuarios/".$nomEncript.$jpeg;

            // FUNCION PARA ELIMINAR
            if(eliminarImagen($cn, $emailOring) == 0) {
                return 0;
            } else {
                // FUNCION PARA ACTUALIZAR
                if(actualizarDatosUsu($cn, $rutaDefinitiva3, $celular, $nombre, $clave, $emailOring) == 0) {   // METODO PARA ACTUALIZAR
                    $respuesta['estado'] = "3";
                } else {
                    // PARA COPIAR Y MOVER IMAGEN AL DIRECTORIO IMAGENES
                    copy($_FILES["file-input"]["tmp_name"], $rutaDestino3); // COPIO LAS IMAGENES A LA CARPETA DE RUTADESTINO
                    move_uploaded_file(basename($_FILES["file-input"]["tmp_name"]), $rutaDestino3.$jpeg);   // MUEVO LA IMAGEN A LA CARPETA DESTINO 
                    $respuesta['estado'] = "1";
                }
            }
        } else {
            $respuesta['estado'] = "2";
        }
    }

    // FUNCION PARA ELIMNAR IMAGEN DEL DIRECTORIO
    function eliminarImagen($cn, $emailOring) {
        $queryBuscarImg = "SELECT DirecImagen FROM usuarios WHERE Email='$emailOring'";
        
        if($resp = $cn->query($queryBuscarImg)) {

            if($busqueda = mysqli_fetch_array($resp)) {
                $rutaImg = trim($busqueda['DirecImagen']);

                if(!empty($rutaImg)) {
                    unlink($_SERVER['DOCUMENT_ROOT']."/nutricosmetic_rosy".$rutaImg);   // RUTA PARA ELIMINAR IMAGEN DEL DIRECTORTIO RAIZ
                }
                return 1;
            }
        } else {
            return 0;
        }
    }
    
    // CONSULTA PARA ACTUALIZAR DATOS CON IMG
    function actualizarDatosUsu($cn, $rutaDefinitiva, $celular, $nombre, $clave, $emailOring) {
        $queryUpdate = "UPDATE usuarios SET DirecImagen='$rutaDefinitiva', Celular='$celular', NombreCom='$nombre', Token='$clave' WHERE Email='$emailOring'";
        if($resp = $cn->query($queryUpdate)) {
            $_SESSION['Token'] = $clave;
            return 1;
        } else {
            return 0;
        }
    }

    // CONSULTA PARA ACTUALIZAR SIN IMG
    function actualizarDatosUsuSinImg($cn, $celular, $nombre, $clave, $emailOring) {
        $queryUpdate = "UPDATE usuarios SET Celular='$celular', NombreCom='$nombre', Token='$clave' WHERE Email='$emailOring'";
        if($resp = $cn->query($queryUpdate)) {
            $_SESSION['Token'] = $clave;
            return 1;
        } else {
            return 0;
        }
    }

    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);