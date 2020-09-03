<?php
    require_once "../../clases/conexion.php";
    require_once "../../clases/cliente.php";

    $obj=new clientes();

    $id=$_POST['id_cliente'];
    $nom=$_POST['nombreU'];
    $ape=$_POST['apellidoU'];
    $dir=$_POST['direccionU'];
    $usu=$_POST['usuarioU'];
    $tel=$_POST['telefonoU'];
    $rfc=$_POST['rfcU'];
  
    $datos=array($id,$nom,$ape,$dir,$usu,$tel,$rfc);

    echo $obj->actualizarCliente($datos);
?>