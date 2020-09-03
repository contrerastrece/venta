<?php 
class usuarios{
	public function registroUsuario($datos){
		$c=new conectar();
		$conexion=$c->conexion();
 
		$fecha=date("Y/m/d");

		$sql="INSERT into usuarios(nombre,apellido,email,password,fechaCaptura)
		values ('$datos[0]',
		'$datos[1]',
		'$datos[2]',
		'$datos[3]',
		'$fecha') ";

		return mysqli_query($conexion,$sql);

	}
	//clase para el Login
	public function loginUser($datos){
		$c=new conectar();
		$conexion=$c->conexion();
		$password=sha1($datos[1]);//password encriptado

		//Para crear la sesión del ID
		$_SESSION['usuario']=$datos[0];//0 es el nombre del Usuario
		$_SESSION['iduser']=self::traerID($datos);//para traer el id_usuario
		//el self es una manera de instanciar facilmente

		//consulta sql
		//guardaremos todos los datos registrados 
		$sql="SELECT * from usuarios where 
		email='$datos[0]' and
		password='$password'";
		//test para encontrar coincidencia
		$result=mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result)>0){
			return 1;
		}else{
			return 0;
		}

	}

	public function traerID($datos){
		$c=new conectar();
		$conexion=$c->conexion();
		$password=sha1($datos[1]);

		$sql="SELECT id_usuario from usuarios where
		email='$datos[0]' and
		password='$password'";
		$result=mysqli_query($conexion,$sql);
		return mysqli_fetch_row($result)[0];//algún día entenderé el puto "fetch"


	}
	
	public function obtenerDatosUsuarios($idUsuario){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="SELECT id_usuario, nombre, apellido, email FROM usuarios
				WHERE id_usuario='$idUsuario'";
		$result=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($result);
		$datos=array(
			'id_usuario'=>$ver[0],
			'nombre'=>$ver[1],
			'apellido'=>$ver[2],
			'email'=>$ver[3]
		);
		return $datos;
	}
	public function actualizaUsuarios($datos){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="UPDATE usuarios SET nombre='$datos[1]',
								apellido='$datos[2]',
								email='$datos[3]'
			WHERE id_usuario='$datos[0]'";

		return mysqli_query($conexion,$sql);
	}
	
	public function eliminarUsuarios($idUsuario){
		$c=new conectar();
		$conexion=$c->conexion();
		
		$sql="DELETE from usuarios
			WHERE id_usuario='$idUsuario'";

		return mysqli_query($conexion,$sql);
	}
}

?>