<?php
    session_start();
    require_once "../../clases/conexion.php";
    require_once "../../clases/cliente.php";

    $obj=new clientes();
    
    $nom=$_POST['nombre'];
    $ape=$_POST['apellido'];
    $dir=$_POST['direccion'];
    $email=$_POST['usuario'];
    $tel=$_POST['telefono'];
    $refer=$_POST['rfc'];

   $datos=array($nom,$ape,$dir,$email,$tel,$refer);

    echo $obj->registrarCliente($datos);

?>