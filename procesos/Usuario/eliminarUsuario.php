<?php
    require_once "../../clases/conexion.php";
    require_once "../../clases/usuarios.php";
    $obj=new usuarios;
    $idUsuario=$_POST['idUsuario'];
    
    echo $obj->eliminarUsuarios($idUsuario);

?>