<?php

    class ventas{
        public function obtenerDatosProducto($id_PRODUCTO){
            $c=new conectar();
            $conexion=$c->conexion();
            $sql="SELECT art.nombre, art.descripcion, art.cantidad, art.precio, img.ruta 
                    from articulos as art
                    inner join imagenes as img on
                    art.id_imagen=img.id_imagen and
                    art.id_producto='$id_PRODUCTO'";
                    
            $result=mysqli_query($conexion,$sql);
            $ver= mysqli_fetch_row($result);
        
            $d=explode('/',$ver[4]);
            $img=$d[1].'/'.$d[2].'/'.$d[3];
            $datos=array(
                        'nombre'=> $ver[0],
                        'descripcion'=> $ver[1],
                        'cantidad'=> $ver[2],
                        'precio'=> $ver[3],
                        'ruta'=>$img
            );
            return $datos;
        }
    }


?>