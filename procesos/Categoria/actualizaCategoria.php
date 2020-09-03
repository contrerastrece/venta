<?php
    require_once "../../clases/conexion.php";
    require_once "../../clases/categoria.php";

    $idCategoria=$_POST['idCategoria'];
    $UpdateCategoria=$_POST['categoriaU'];
    
    $link=str_replace(" ","",$UpdateCategoria).".php";
    $datos=array(
        $idCategoria,
        $UpdateCategoria,
        $link

    );

    $obj=new Categoria();
    echo $obj-> actualizaCategoria($datos);
?>