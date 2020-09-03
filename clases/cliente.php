<?php
    class clientes{
        public function registrarCliente($datos){
            $c=new conectar();
            $conexion=$c->conexion();
            $id_usuario=$_SESSION['iduser'];
            
            $sql="INSERT into clientes (id_usuario, nombre, apellido, direccion, email, telefono, rfc)
                values ('$id_usuario', '$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]')";
            return mysqli_query($conexion,$sql);
        }

        public function obtenerDatosClientes($id_Cliente){
            $c=new conectar();
            $conexion=$c->conexion();

            $sql="SELECT id_cliente, nombre, apellido, direccion, email, telefono, rfc FROM clientes
                    WHERE id_cliente='$id_Cliente'";

            $result=mysqli_query($conexion,$sql);
            $ver=mysqli_fetch_row($result);

            $datos=array(
                "id_cliente"=>$ver[0],
                "nombre"=>$ver[1],
                "apellido"=>$ver[2],
                "direccion"=>$ver[3],
                "email"=>$ver[4],
                "telefono"=>$ver[5],
                "rfc"=>$ver[6]

            );
            return $datos;
        }

        public function actualizarCliente($datos){
            $c=new conectar();
            $conexion=$c->conexion();

            $sql="UPDATE clientes SET nombre='$datos[1]',
                                        apellido='$datos[2]',
                                        direccion='$datos[3]',
                                        email='$datos[4]',
                                        telefono='$datos[5]',
                                        rfc='$datos[6]'
                WHERE id_cliente='$datos[0]'";

            return mysqli_query($conexion,$sql);

        }
        
        public function eliminarCliente($id_Cliente){
            $c=new conectar();
            $conexion=$c->conexion();
            $sql="DELETE from clientes where id_cliente='$id_Cliente'";
            return mysqli_query($conexion,$sql);
        }
    }



?>