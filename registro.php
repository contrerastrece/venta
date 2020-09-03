<?php 
	require_once "clases/conexion.php";
	$obj=new conectar();
	$conexion=$obj->conexion();

	$sql="SELECT * from usuarios where email='admin'";

	$result=mysqli_query($conexion,$sql);
	$validar=0;

	if (mysqli_num_rows($result)>0) {
		header("location:index.php");
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
	<!--<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>
	<link rel="stylesheet" href="css/registro.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-danger">
					<div class="panel panel-heading">Registro de Administrador</div>
					<div class="panel panel-body">						
						<form id="frmRegistro">						
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombre" id="nombre">
							<p></p>
							<label>Apellido</label>							
							<input type="text" class="form-control input-sm" name="apellido" id="apellido">
							<p></p>
							<label>Email(usuario)</label>							
							<input type="text" class="form-control input-sm" name="usuario" id="usuario">
							<p></p>
							<label>Contraseña</label>							
							<input type="password" class="form-control input-sm" name="password" id="password">
							<p></p>
							<p></p>
							<span class="btn btn-primary" id="registro">Registrar</span>
							<a href="index.php" class="btn btn-default">Regresar</a>
							
						</form>
					</div>
				</div>
				
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>
</html>

<!--Script para validar vacio	-->
<script type="text/javascript">
	$(document).ready(function(){

		//script para evento click y ajax ---- también validará vacios
		$('#registro').click(function(){
			vacios=validarFormVacio('frmRegistro');

			//crear un mensaje de alerta
			if (vacios > 0) {
				alert("Debes llenar todos los campos.");
				return false;
			}

			datos=$('#frmRegistro').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/regLogin/registrarUsuario.php",
				success:function(r){
					alert(r);
					if (r==1) {
						alert("Agregado con Exito!");
					}else{
						alert("Falló al agregar");
					}

				}
			});

		});
	});
</script>
