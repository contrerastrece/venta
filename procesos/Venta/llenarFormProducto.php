<?php
    require_once "../../clases/conexion.php";
    require_once "../../clases/venta.php";

    
    $obj=new ventas();

    echo json_encode( $obj->obtenerDatosProducto($_POST['idProducto']));
?>