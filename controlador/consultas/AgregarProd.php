<?php
    include_once("../../controlador/consultas/conexion.php");
    session_start();

    // 1- success
    // 2- datos vacios
    // 3- imagen vacia
    // 4- hubo un error al guardar

    $imagenName = $_FILES['file-input'];    // DEVUELVE UNA CADENA DE LOS ATRIBUTOS DE LA IMAGEN
	$imagenTmp = $_FILES['file-input']['tmp_name']; // OBTENGO EL NOMBRE TEMPORAL DE LA IMAGEN
	$nomEncript = md5($_FILES['file-input']['tmp_name']);  // ENCRIPTO CON MD5 EL NOMBRE TEMPORAL DE LA IMAGEN

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

    if($_FILES['file-input']['name'] == null) {
        $respuesta['estado'] = "3";
    } else {

    }

    // CONVIERTE E IMPRIME EL ARRAY EN UN OBJETO JSON
    header('Content-Type: application/json');
    echo json_encode($respuesta);