<?php
    include_once("../../controlador/consultas/conexion.php");
    session_start();

    $imagenName = $_FILES['file-input'];    // DEVUELVE UNA CADENA DE LOS ATRIBUTOS DE LA IMAGEN
	$imagenTmp = $_FILES['file-input']['tmp_name'];     // OBTENGO EL NOMBRE TEMPORAL DE LA IMAGEN
	$nomEncript = md5($_FILES['file-input']['tmp_name']);   // ENCRIPTO CON MD5 EL NOMBRE TEMPORAL DE LA IMAGEN

    $txtProducto = trim($_POST['txtProducto']);
    $txtCategoria = trim($_POST['txtCategoria']);
    $txtMarca = trim($_POST['txtMarca']);
    $txtPrecio = trim($_POST['txtPrecio']);
    $txtPorcion = trim($_POST['txtPorcion']);
    $txtDescripcion = trim($_POST['txtDescripcion']);
    if(empty($_POST['txtOferta'])) {
        $txtOferta = null;
    } else {
        $txtOferta = $_POST['txtOferta'];
    }

    $png = ".png";
	$jpeg = ".jpeg";
	$jpg = ".jpg";
    $respuesta = array();
    $pregMatchText = "/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i";     //EXPRECIONES REGULARES preg_match
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
            $rutaDefinitivaPng = "/galeria/productos/".$nomEncript.$png;
            $rutaDestinoPng = $_SERVER['DOCUMENT_ROOT']."/nutricosmetic_rosy/galeria/productos/".$nomEncript.$png;    // OBTENGO LA RUTA DONDE SE ALMACENARAN LAS IMAGENES

            if(agregarProd($cn, $txtProducto, $nomEncript, $txtCategoria, (int)$txtMarca, (int)$txtPrecio, $txtPorcion, $txtDescripcion, (int)$txtOferta, $rutaDefinitivaPng) == 1) {
                
                copy($_FILES["file-input"]["tmp_name"], $rutaDestinoPng); // COPIO LAS IMAGENES A LA CARPETA DE RUTADESTINOPng
                move_uploaded_file(basename($_FILES["file-input"]["tmp_name"]), $rutaDestinoPng.$png);   // MUEVO LA IMAGEN A LA CARPETA DESTINO 
        
                $respuesta['estado'] = "1";
            } else {
                $respuesta['estado'] = "4";
            }
            
        } else if($imagenName['type'] === "image/jpg" || $imagenName['type'] === "image/JPG") {
            $rutaDefinitivaJpg = "/galeria/productos/".$nomEncript.$jpg;
            $rutaDestinoJpg = $_SERVER['DOCUMENT_ROOT']."/nutricosmetic_rosy/galeria/productos/".$nomEncript.$jpg;    // OBTENGO LA RUTA DONDE SE ALMACENARAN LAS IMAGENES

            if(agregarProd($cn, $txtProducto, $nomEncript, $txtCategoria, (int)$txtMarca, (int)$txtPrecio, $txtPorcion, $txtDescripcion, (int)$txtOferta, $rutaDefinitivaJpg) == 1) {
                
                copy($_FILES["file-input"]["tmp_name"], $rutaDestinoJpg); // COPIO LAS IMAGENES A LA CARPETA DE RUTADESTINOJpg
                move_uploaded_file(basename($_FILES["file-input"]["tmp_name"]), $rutaDestinoJpg.$jpg);   // MUEVO LA IMAGEN A LA CARPETA DESTINO 
        
                $respuesta['estado'] = "1";
            } else {
                $respuesta['estado'] = "4";
            }

        } else if($imagenName['type'] === "image/jpeg" || $imagenName['type'] === "image/JPEG") {
            $rutaDefinitivaJpeg = "/galeria/productos/".$nomEncript.$jpeg;
            $rutaDestinoJpeg = $_SERVER['DOCUMENT_ROOT']."/nutricosmetic_rosy/galeria/productos/".$nomEncript.$jpeg;    // OBTENGO LA RUTA DONDE SE ALMACENARAN LAS IMAGENES

            if(agregarProd($cn, $txtProducto, $nomEncript, $txtCategoria, (int)$txtMarca, (int)$txtPrecio, $txtPorcion, $txtDescripcion, (int)$txtOferta, $rutaDefinitivaJpeg) == 1) {
                
                copy($_FILES["file-input"]["tmp_name"], $rutaDestinoJpeg); // COPIO LAS IMAGENES A LA CARPETA DE RUTADESTINOJpeg$rutaDestinoJpeg
                move_uploaded_file(basename($_FILES["file-input"]["tmp_name"]), $rutaDestinoJpeg.$jpeg);   // MUEVO LA IMAGEN A LA CARPETA DESTINO 
                $respuesta['estado'] = "1";
            } else {
                $respuesta['estado'] = "4";
            }

        } else {
            $respuesta['estado'] = "5";
        }
    }

    function agregarProd($cn, $txtProducto, $nomEncript, $txtCategoria, $txtMarca, $txtPrecio, $txtPorcion, $txtDescripcion, $txtOferta, $rutaDefinitiva) {
        $queryAgregarProd = "INSERT INTO productos(IdMarca,TokenProd,NomProducto,Porcion,PrecioOriginal,PrecioOferta,Descripcion,Imagen) VALUES ('$txtMarca','$nomEncript','$txtProducto','$txtPorcion','$txtPrecio','$txtOferta','$txtDescripcion','$rutaDefinitiva')";
        
        if($respAdd = $cn->query($queryAgregarProd)) {
            $queryBuscarIdProd = "SELECT * FROM productos WHERE TokenProd='$nomEncript'";
            $respBusquedaId = $cn->query($queryBuscarIdProd);
            
            if($busquedaId = mysqli_fetch_array($respBusquedaId)) {
                $id = $busquedaId['IdProducto'];
                $queryAgregarCat = "INSERT INTO relacionprodcat(IdProducto,IdCategoria) VALUES('$id','$txtCategoria')";
                $cn->query($queryAgregarCat);
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);