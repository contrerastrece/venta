<?php
    require_once "../../clases/conexion.php";
    require_once "../../clases/articulo.php";

    $idart=$_POST['idArticulo'];

    $obj=new Articulo();
    echo $obj->eliminarArticulo($idart);

?>