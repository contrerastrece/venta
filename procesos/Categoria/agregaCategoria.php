<?php
    session_start();
    require_once "../../clases/conexion.php";
    require_once "../../clases/usuarios.php";
    require_once "../../clases/categoria.php";
    
    $categoria=$_POST['categoria'];
    $id_usuario=$_SESSION['iduser'];
    $fecha=date("d-m-y");
    $link=str_replace(" ","",$categoria).".php";
    $datos=array(
                $id_usuario,
                $categoria,
                $fecha,
                $link
    );

    $objCategoria=new Categoria();

    echo $objCategoria->agregarCategoria($datos);
?>