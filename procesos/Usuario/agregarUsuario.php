<?php
    require_once "../../clases/conexion.php";
    require_once "../../clases/usuarios.php";

    $obj=new usuarios();
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $usuario=$_POST['usuario'];     
    $password=sha1($_POST['password']);//encriptar la constraseña

    $datos=array( $nombre, $apellido, $usuario, $password);

    echo $obj->registroUsuario($datos);
?>