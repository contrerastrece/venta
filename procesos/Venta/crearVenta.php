<?php
    session_start();
    require_once "../../clases/conexion.php";
    require_once "../../clases/venta.php";

    $obj=new ventas();


    if(count($_SESSION['tablaVentaTemp'])==0){
        echo 0;
    }else{
        $result=$obj->crearVenta();
        unset($_SESSION['tablaVentaTemp']);
        echo $result;
    }

?>