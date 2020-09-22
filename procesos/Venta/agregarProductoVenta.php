<!-- iniciando git -->

<?php
    session_start();
    require_once "../../clases/conexion.php";
    $c=new conectar();
    $conexion=$c->conexion();

    $id_cli=$_POST['clienteVenta'];
    $id_pro=$_POST['productoVenta'];
    $des=$_POST['descripcion'];
    $stk=$_POST['cantidad'];
    $precio=$_POST['precio'];

    // obtener nombre del cliente
    $sql="SELECT nombre, apellido from clientes
        WHERE id_cliente='$id_cli'";
    $result=mysqli_query($conexion, $sql);
    $cli=mysqli_fetch_row($result);
    $n_cli=$cli[0]." ".$cli[1];

    //obtener nombre de producto 
    $sql="SELECT nombre from articulos
        WHERE id_producto='$id_pro'";
    $result=mysqli_query($conexion, $sql);
    $n_pro=mysqli_fetch_row($result)[0];
    
    // calcular importe
    $importe=$stk*$precio;

    $datos=$id_pro."||".$n_pro."||".$precio."||".$des."||".$stk."||".$importe;

    $_SESSION['tablaVentaTemp'][]=$datos;

?>