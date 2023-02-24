<?php
    include_once("../../controlador/consultas/conexion.php");
    session_start();

    // 1- success
    // 2- datos vacios
    // 3- imagen vacia
    // 4- hubo un error al guardar
    // 5- tipo de imagen

    $imagenName = $_FILES['file-input'];    // DEVUELVE UNA CADENA DE LOS ATRIBUTOS DE LA IMAGEN
	$imagenTmp = $_FILES['file-input']['tmp_name'];     // OBTENGO EL NOMBRE TEMPORAL DE LA IMAGEN
	$nomEncript = md5($_FILES['file-input']['tmp_name']);   // ENCRIPTO CON MD5 EL NOMBRE TEMPORAL DE LA IMAGEN

    $txtProducto = $_POST['txtProducto'];
    $txtCategoria = $_POST['txtCategoria'];
    $txtMarca = $_POST['txtMarca'];
    $txtPrecio = $_POST['txtPrecio'];
    $txtPorcion = $_POST['txtPorcion'];
    $txtDescripcion = $_POST['txtDescripcion'];
    if(!empty($_POST['txtOferta'])) {
        $txtOferta = $_POST['txtOferta'];
    }

    $png = ".png";
	$jpeg = ".jpeg";
	$jpg = ".jpg";
    $respuesta = array();
    $clave = MD5($txtProducto."+".$txtPrecio."+".$txtPorcion);

    if($_FILES['file-input']['name'] == null) {
        $respuesta['estado'] = "3";
    } else {
        if ($imagenName['type'] === "image/png" || $imagenName['type'] === "image/PNG") {

            if(agregarProd($cn, $txtProducto, $clave, $txtCategoria, $txtMarca, $txtPrecio, $txtPorcion, $txtDescripcion, $txtOferta, rutaDestinoImagen($png, $nomEncript)) == 1) {
                copiarRutaIamagen($png, rutaDestinoServer($png, $nomEncript));
                $respuesta['estado'] = "1";
            } else {
                $respuesta['estado'] = "4";
            }
            
        } else if($imagenName['type'] === "image/jpg" || $imagenName['type'] === "image/JPG") {
            
            if(agregarProd($cn, $txtProducto, $clave, $txtCategoria, $txtMarca, $txtPrecio, $txtPorcion, $txtDescripcion, $txtOferta, rutaDestinoImagen($jpg, $nomEncript)) == 1) {
                copiarRutaIamagen($jpg, rutaDestinoServer($jpg, $nomEncript));
                $respuesta['estado'] = "1";
            } else {
                $respuesta['estado'] = "4";
            }

        } else if($imagenName['type'] === "image/jpeg" || $imagenName['type'] === "image/JPEG") {
            
            if(agregarProd($cn, $txtProducto, $clave, $txtCategoria, $txtMarca, $txtPrecio, $txtPorcion, $txtDescripcion, $txtOferta, rutaDestinoImagen($jpeg, $nomEncript)) == 1) {
                copiarRutaIamagen($jpeg, rutaDestinoServer($jpeg, $nomEncript));
                $respuesta['estado'] = "1";
            } else {
                $respuesta['estado'] = "4";
            }

        } else {
            $respuesta['estado'] = "5";
        }
    }

    function agregarProd($cn, $txtProducto, $clave, $txtCategoria, $txtMarca, $txtPrecio, $txtPorcion, $txtDescripcion, $txtOferta, $rutaDefinitiva) {
        $queryAgregarProd = "INSERT INTO productos(IdMarca,TokenProd,NomProducto,Porcion,PrecioOriginal,PrecioOferta,Descripcion,Imagen) VALUES
        ('$txtMarca','$clave','$txtProducto','$txtPorcion','$txtPrecio','$txtOferta','$txtDescripcion','$rutaDefinitiva')";
        
        $queryAgregarCat = "INSERT INTO categoria()";

        if($respAdd = $cn->query($queryAgregarProd)) {
            return 1;
        } else {
            return 0;
        }
    }

    // RUTA QUE SE ALMACENARA EN LA BASE DE DATOS
    function rutaDestinoImagen($tipo, $nomEncript) {
        $rutaDefinitiva = "/galeria/productos/".$nomEncript.$tipo;
        return $rutaDefinitiva;
    }

    // OBTENER LA RUTA A DONDE SE COPIARA LA IMAGEN
    function rutaDestinoServer($tipo, $nomEncript) {
        $rutaDestino = $_SERVER['DOCUMENT_ROOT']."/nutricosmetic_rosy/galeria/productos/".$nomEncript.$tipo;    // OBTENGO LA RUTA DONDE SE ALMACENARAN LAS IMAGENES
        return $rutaDestino;
    }

    // COPIAR LA IMAGEN AL DIRECTORTIO ESPECIFICADO
    function copiarRutaIamagen($tipo, $rutaDestino) {
        copy($_FILES["file-input"]["tmp_name"], $rutaDestino); // COPIO LAS IMAGENES A LA CARPETA DE RUTADESTINO
        move_uploaded_file(basename($_FILES["file-input"]["tmp_name"]), $rutaDestino.$tipo);   // MUEVO LA IMAGEN A LA CARPETA DESTINO 
    }

    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);