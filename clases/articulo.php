<?php

    class Articulo{

        public function agregarImagen($datos){
            //conectar con la bd
            $c= new conectar();
            $conexion=$c->conexion();
            $fecha=date('Y-m-d');
            $sql="INSERT into imagenes(id_categoria,nombre,ruta,fechaSubida)
                    values ('$datos[0]','$datos[1]','$datos[2]','$fecha')";


            $result=mysqli_query($conexion,$sql);

            return mysqli_insert_id($conexion);//mostrará el ultimo id agregado en imágenes
        }

        // Insertar articulo
        public function insertarArticulos($datos){
            $c= new conectar();
            $conexion=$c-> conexion();

            $fecha=date('Y-m-d');
            $sql="INSERT INTO articulos (id_categoria, id_imagen, id_usuario, nombre, descripcion, cantidad, precio, fechaCaptura)
                VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$fecha')";


            return mysqli_query($conexion,$sql);            
        }

        public function obtenDatosArticulo($idarticulo){
            //conectar con la bd
            $c= new conectar();
            $conexion=$c->conexion();

            $sql="SELECT id_producto, id_categoria, nombre, descripcion, cantidad, precio FROM articulos
                WHERE id_producto='$idarticulo'";
            $result=mysqli_query($conexion,$sql);
            $ver=mysqli_fetch_row($result);
            $datos=array(
                "id_producto"=>$ver[0],
                "id_categoria"=>$ver[1],
                "nombre"=>$ver[2],
                "descripcion"=>$ver[3],
                "cantidad"=>$ver[4],
                "precio"=>$ver[5]
            );
            return $datos;
        }

        // Actualizar articulo
        public function actualizaArticulo($datos){
             //conectar con la bd
             $c= new conectar();
             $conexion=$c->conexion();

             $sql= "UPDATE articulos SET id_categoria='$datos[1]',
                                        nombre='$datos[2]', 
                                        descripcion='$datos[3]', 
                                        cantidad='$datos[4]', 
                                        precio='$datos[5]'
                    WHERE id_producto='$datos[0]'";

            return mysqli_query($conexion,$sql);
        }

        // Eliminar articulo
        public function eliminarArticulo($idArticulo){
            //conectar con la bd
            $c= new conectar();
            $conexion=$c->conexion();
            
            $idimagen=self::obtenIdImg($idArticulo);
            $sql="DELETE FROM articulos WHERE id_producto='$idArticulo'";

            return mysqli_query($conexion,$sql);
            if ($result) {
                $ruta=self::obtenRutaImagen($idImg);
                $sql="DELETE from imagenes where id_imagen='$idimagen'";

                $result=mysqli_query($conexion,$sql);
                    if ($result) {
                        if (unlink($ruta)) {
                            return 1;
                        }
                    }
            }
       }

        public function obtenIdImg($idProducto){
            $c= new conectar();
            $conexion=$c->conexion();

            $sql="SELECT id_imagen 
                    from articulos 
                    where id_producto='$idProducto'";
            $result=mysqli_query($conexion,$sql);

            return mysqli_fetch_row($result)[0];
        }

        public function obtenRutaImagen($idImg){
            $c= new conectar();
            $conexion=$c->conexion();

            $sql="SELECT ruta 
                    from imagenes 
                    where id_imagen='$idImg'";

            $result=mysqli_query($conexion,$sql);

            return mysqli_fetch_row($result)[0];
        }

    }    

?>