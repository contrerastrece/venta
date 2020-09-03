<?php
    require_once "../../clases/conexion.php";
    require_once "../../clases/usuarios.php";
    $obj= new usuarios;

    $idUsuario=$_POST['idUsuario'];
    $updateNombre=$_POST['nombreU'];
    $updateApellido=$_POST['apellidoU'];
    $updateUsuario=$_POST['usuarioU'];

    $datos=array($idUsuario, $updateNombre, $updateApellido, $updateUsuario);   

    echo $obj-> actualizaUsuarios($datos);
?>