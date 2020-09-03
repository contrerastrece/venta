<?php

    require_once "../../clases/conexion.php";
    require_once "../../clases/categoria.php";

    $id=$_POST['idCategoria'];

    $obj= new Categoria();
    echo $obj->eliminarCategoria($id);

?>