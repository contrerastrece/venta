<?php 
	require_once "clases/conexion.php";
	$obj=new conectar();
	$conexion=$obj->conexion();

	$sql="SELECT * from usuarios where email='admin'";

	$result=mysqli_query($conexion,$sql);
	$validar=0;

	if (mysqli_num_rows($result)>0) {
		$validar=1;
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login De User</title>
	<!--<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="js/funciones.js"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-primary">
					<div class="panel panel-heading">Sistema de Ventas Contreras</div>

					<div class="panel panel-body">
						<p>
							<img src="img/almacen.jpg" width="100%" height="300px" >
						</p>
						<form id="frmLogin">
							<label>Ingrese Usuario</label>
							<input type="text" class="form-control input-sm" name="usuario" id="usuario" placeholder="Usuario">
							<p></p>
							<label>Contraseña</label>
							<input type="password" class="form-control input-sm" name="password" id="password" placeholder="Contraseña">
							<p></p>
							<span class="btn btn-primary btn-sm" id="ingresarSistema">Ingresar</span>
							<?php if(!$validar):?>
							<a href="registro.php" class="btn btn-danger btn-sm">Registrar</a>
							<?php endif; ?>
						</form>
					</div>
				</div>				
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>
</html>

<!--Script para validar datos-->
<script type="text/javascript">
	$(document).ready(function(){

	//script para evento click y ajax 
	$('#ingresarSistema').click(function(){

		vacios=validarFormVacio('frmLogin');
			//crear un mensaje de alerta
			if (vacios>0) {
				alert("Debes llenar todos los campos.");
				return false;
			}

			datos=$('#frmLogin').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/regLogin/login.php",
				success:function(r){

					if (r==1) {
						window.location="vistas/inicio.php";
					}else{
						alert("No se pudo acceder");
					}
				}
			});
		});
	});
</script>