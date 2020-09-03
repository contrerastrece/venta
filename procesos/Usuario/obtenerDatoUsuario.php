<?php
    require_once "../../clases/conexion.php";
    require_once "../../clases/usuarios.php";

    $obj=new usuarios;

    echo json_encode($obj->obtenerDatosUsuarios($_POST['idUsuario']));
?>