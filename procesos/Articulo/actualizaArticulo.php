<?php
    require_once "../../clases/conexion.php";
    require_once "../../clases/articulo.php";

    $obj=new Articulo();


   $datos=array(
      $_POST['idArticulo'],
      $_POST['categoriaSelectU'],
      $_POST['nombreU'],
      $_POST['descripcionU'],
      $_POST['cantidadU'],
      $_POST['precioU']
   );

echo $obj->actualizaArticulo($datos);



?>