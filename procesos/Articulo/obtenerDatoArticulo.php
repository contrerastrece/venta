<?php
    require_once "../../clases/conexion.php";
    require_once "../../clases/articulo.php";

    $obj=new Articulo();    
    
    $idart=$_POST['idart'];

    echo json_encode($obj->obtenDatosArticulo($idart));
?>