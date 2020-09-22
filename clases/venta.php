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

        public function crearVenta(){
            $c= new conectar();
            $conexion=$c->conexion();

            $fecCompra=date("Y-m-d");
            $idUser=$_SESSION['iduser'];
            $idVenta=self::creaFolio();
            $datos=$_SESSION['tablaVentaTemp'];
            $r=0;
            for ($i=0; $i <count($datos) ; $i++) { 
                $d=explode("||", $datos[$i]);
            
                $sql="INSERT INTO detal_ventas(id_venta, id_producto, id_usuario, precio, fechaCompra)
                values ('$idVenta','$d[0]','$idUser','$d[2]','$fecCompra')";
            
                $result=mysqli_query($conexion,$sql);
                $r+=$result;
            }
            return $r;


        }

        public function creaFolio(){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_venta from detal_ventas group by id_venta desc";

			$result=mysqli_query($conexion,$sql);
			$id=mysqli_fetch_row($result)[0];

			if($id=="" or $id==null or $id==0){
				return 1;
			}else{
				return $id + 1;
			}
		}
    }


?>