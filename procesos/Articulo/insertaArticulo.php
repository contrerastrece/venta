<?php
    session_start();
    $iduser=$_SESSION['iduser'];
    require_once "../../clases/conexion.php";
    require_once "../../clases/articulo.php";

    //instancia de articulo
    $obj=new Articulo();
    $datos=array();

    $nombreImg=$_FILES['imagen']['name'];
    $rutaAlmacenamiento=$_FILES['imagen']['tmp_name'];
    $carpeta='../../archivos/';
    $rutaFinal=$carpeta.$nombreImg;

    $datosImg=array(
                    $_POST['categoriaSelect'],
                    $nombreImg,
                    $rutaFinal 
                );

    if (move_uploaded_file($rutaAlmacenamiento, $rutaFinal)) {
        $idimagen=$obj -> agregarImagen($datosImg);
       if ($idimagen > 0) {

            $datos[0]=$_POST['categoriaSelect'];
            $datos[1]=$idimagen;
            $datos[2]=$iduser;
            $datos[3]=$_POST['nombre'];
            $datos[4]=$_POST['descripcion'];
            $datos[5]=$_POST['cantidad'];
            $datos[6]=$_POST['precio'];
           echo $obj-> insertarArticulos($datos);
       }
       else{
           echo 0;
       }
    }
?>