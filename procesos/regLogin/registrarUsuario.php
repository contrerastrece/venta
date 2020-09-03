<?php 

require_once "../../clases/conexion.php";
require_once "../../clases/usuarios.php";

$obj=new usuarios();

//encriptar la constraseña
$password=sha1($_POST['password']);

$datos=array(
	$_POST['nombre'],
	$_POST['apellido'],
	$_POST['usuario'], 
	$password
);


echo $obj-> registroUsuario($datos);



?>