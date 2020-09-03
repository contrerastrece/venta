<?php
    require_once "../../clases/conexion.php";
    require_once "../../clases/cliente.php";

    $obj=new clientes();
    $idCliente=$_POST['idCliente'];

    echo $obj->eliminarCliente($idCliente);

?>