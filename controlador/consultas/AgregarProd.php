<?php
    include_once("../../controlador/consultas/conexion.php");
    session_start();

    $imagenName = $_FILES['file-input'];    // DEVUELVE UNA CADENA DE LOS ATRIBUTOS DE LA IMAGEN
	$imagenTmp = $_FILES['file-input']['tmp_name'];     // OBTENGO EL NOMBRE TEMPORAL DE LA IMAGEN
	$nomEncript = md5($_FILES['file-input']['tmp_name']);   // ENCRIPTO CON MD5 EL NOMBRE TEMPORAL DE LA IMAGEN

    $txtProducto = $_POST['txtProducto'];
    $txtCategoria = $_POST['txtCategoria'];
    $txtMarca = $_POST['txtMarca'];
    $txtPrecio = $_POST['txtPrecio'];
    $txtPorcion = $_POST['txtPorcion'];
    $txtDescripcion = $_POST['txtDescripcion'];
    if(empty($_POST['txtOferta'])) {
        $txtOferta = null;
    } else {
        $txtOferta = $_POST['txtOferta'];
    }

    $png = ".png";
	$jpeg = ".jpeg";
	$jpg = ".jpg";
    $respuesta = array();
    $pregMatchText = "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i";
    $pregMatchNum = "/^[[:digit:]]+$/";
    // $clave = MD5($txtProducto."+".$txtPrecio."+".$txtPorcion);

    
    if(!preg_match($pregMatchText, $txtProducto) || 
        !preg_match($pregMatchText, $txtDescripcion) || 
        !preg_match($pregMatchNum, $txtPrecio) ||
        !preg_match($pregMatchNum, $txtPorcion)) {
        $respuesta['estado'] = "2";

    } else if($_FILES['file-input']['name'] == null) {
        $respuesta['estado'] = "3";

    } else {
        if ($imagenName['type'] === "image/png" || $imagenName['type'] === "image/PNG") {
            $rutaDefinitiva = "/galeria/productos/".$nomEncript.$png;
            $rutaDestino = $_SERVER['DOCUMENT_ROOT']."/nutricosmetic_rosy/galeria/productos/".$nomEncript.$png;    // OBTENGO LA RUTA DONDE SE ALMACENARAN LAS IMAGENES

            if(agregarProd($cn, $txtProducto, $nomEncript, $txtCategoria, (int)$txtMarca, (int)$txtPrecio, $txtPorcion, $txtDescripcion, (int)$txtOferta, $rutaDefinitiva) == 1) {
                
                copy($_FILES["file-input"]["tmp_name"], $rutaDestino); // COPIO LAS IMAGENES A LA CARPETA DE RUTADESTINO
                move_uploaded_file(basename($_FILES["file-input"]["tmp_name"]), $rutaDestino.$png);   // MUEVO LA IMAGEN A LA CARPETA DESTINO 
        
                $respuesta['estado'] = "1";
            } else {
                $respuesta['estado'] = "4";
            }
            
        } else if($imagenName['type'] === "image/jpg" || $imagenName['type'] === "image/JPG") {
            $rutaDefinitiva = "/galeria/productos/".$nomEncript.$jpg;
            $rutaDestino = $_SERVER['DOCUMENT_ROOT']."/nutricosmetic_rosy/galeria/productos/".$nomEncript.$jpg;    // OBTENGO LA RUTA DONDE SE ALMACENARAN LAS IMAGENES

            if(agregarProd($cn, $txtProducto, $nomEncript, $txtCategoria, (int)$txtMarca, (int)$txtPrecio, $txtPorcion, $txtDescripcion, (int)$txtOferta, $rutaDefinitiva) == 1) {
                
                copy($_FILES["file-input"]["tmp_name"], $rutaDestino); // COPIO LAS IMAGENES A LA CARPETA DE RUTADESTINO
                move_uploaded_file(basename($_FILES["file-input"]["tmp_name"]), $rutaDestino.$jpg);   // MUEVO LA IMAGEN A LA CARPETA DESTINO 
        
                $respuesta['estado'] = "1";
            } else {
                $respuesta['estado'] = "4";
            }

        } else if($imagenName['type'] === "image/jpeg" || $imagenName['type'] === "image/JPEG") {
            $rutaDefinitiva = "/galeria/productos/".$nomEncript.$jpeg;
            $rutaDestino = $_SERVER['DOCUMENT_ROOT']."/nutricosmetic_rosy/galeria/productos/".$nomEncript.$jpeg;    // OBTENGO LA RUTA DONDE SE ALMACENARAN LAS IMAGENES

            if(agregarProd($cn, $txtProducto, $nomEncript, $txtCategoria, (int)$txtMarca, (int)$txtPrecio, $txtPorcion, $txtDescripcion, (int)$txtOferta, $rutaDefinitiva) == 1) {
                
                copy($_FILES["file-input"]["tmp_name"], $rutaDestino); // COPIO LAS IMAGENES A LA CARPETA DE RUTADESTINO
                move_uploaded_file(basename($_FILES["file-input"]["tmp_name"]), $rutaDestino.$jpeg);   // MUEVO LA IMAGEN A LA CARPETA DESTINO 
        
                $respuesta['estado'] = "1";
            } else {
                $respuesta['estado'] = "error aqui";
            }

        } else {
            $respuesta['estado'] = "5";
        }
    }

    function agregarProd($cn, $txtProducto, $nomEncript, $txtCategoria, $txtMarca, $txtPrecio, $txtPorcion, $txtDescripcion, $txtOferta, $rutaDefinitiva) {

        $queryAgregarProd = "INSERT INTO productos (IdMarca,TokenProd,NomProducto,Porcion,PrecioOriginal,PrecioOferta,Descripcion,Imagen) VALUES ('$txtMarca','$nomEncript','$txtProducto','$txtPorcion','$txtPrecio','$txtOferta','$txtDescripcion','$rutaDefinitiva')";
    
        if($respAdd = $cn->query($queryAgregarProd)) {
            // $queryBuscarIdProd = "SELECT * FROM productos WHERE TokenProd='$nomEncript'";
            // if($respBusquedaId = $cn->query($queryBuscarIdProd)) {
            //     if($busquedaId = mysqli_fetch_array($respBusquedaId)) {
            //         $id = $busquedaId['IdProducto'];
            //         $queryAgregarCat = "INSERT INTO relacionprodcat(IdProducto,IdCategoria) VALUES('$Id','$txtCategoria')";
            //         $cn->query($queryAgregarCat);
                    return 1;
            //     }
            // } else {
            //     return 0;
            // }
        } else {
            return 0;
        }
    }

    // // RUTA QUE SE ALMACENARA EN LA BASE DE DATOS
    // $rutaDestinoImagen = function($tipo, $nomEncript) {
    //     $rutaDefinitiva = "/galeria/productos/".$nomEncript.$tipo;
    //     return $rutaDefinitiva;
    // }

    // // OBTENER LA RUTA A DONDE SE COPIARA LA IMAGEN
    // $rutaDestinoServer = function($tipo, $nomEncript) {
    //     $rutaDestino = $_SERVER['DOCUMENT_ROOT']."/nutricosmetic_rosy/galeria/productos/".$nomEncript.$tipo;    // OBTENGO LA RUTA DONDE SE ALMACENARAN LAS IMAGENES
    //     return $rutaDestino;
    // }

    // // COPIAR LA IMAGEN AL DIRECTORTIO ESPECIFICADO
    // $copiarRutaIamagen = function($tipo, $rutaDestino) {
    //     copy($_FILES["file-input"]["tmp_name"], $rutaDestino); // COPIO LAS IMAGENES A LA CARPETA DE RUTADESTINO
    //     move_uploaded_file(basename($_FILES["file-input"]["tmp_name"]), $rutaDestino.$tipo);   // MUEVO LA IMAGEN A LA CARPETA DESTINO 
    // }

    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);