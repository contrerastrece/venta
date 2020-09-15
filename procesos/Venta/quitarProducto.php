<?php
    session_start();

    $index=$_POST['INDEX'];
    unset($_SESSION['tablaVentaTemp'][$index]);// destruye una variable en especifica
    $datos=array_values($_SESSION['tablaVentaTemp']);//devuelve todos los valores de un array
    unset($_SESSION['tablaVentaTemp']);
    $_SESSION['tablaVentaTemp']=$datos;


?>  