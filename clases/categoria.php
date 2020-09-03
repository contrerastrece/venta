<?php
    class Categoria{

        public function agregarCategoria($datos){
            $c=new conectar();
            $conexion=$c->conexion();

            $sql="INSERT into categorias(id_usuario,nombreCategoria,fechaCaptura,link) 
                        values ('$datos[0]','$datos[1]','$datos[2]', '$datos[3]')";

            return mysqli_query($conexion,$sql);
        }

        public function actualizaCategoria($datos){
            $c=new conectar();
            $conexion=$c->conexion();

            $sql="UPDATE categorias SET nombreCategoria='$datos[1]' ,
                                                 link='$datos[2]'
                    WHERE id_categoria='$datos[0]'";
            echo mysqli_query($conexion,$sql);

        }
        
        public function eliminarCategoria($idCategoria){
            $c=new conectar();
            $conexion=$c->conexion();

            $sql="DELETE FROM categorias WHERE id_categoria='$idCategoria'";

            return mysqli_query($conexion,$sql);
        }
    }



?>