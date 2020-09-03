<?php 
	session_start();
	//si está llena nos mostrará el html
	if (isset($_SESSION['usuario']) and $_SESSION['usuario']=='admin') {
?>

<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
	<div class="container">
		<h1>Administrar Usuarios</h1>
		<div class="row">
			<div class="col-sm-4">
				<form id="frmRegistro" >						
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
				</form>		
			</div>
			<div class="col-sm-8">
				<div id="tablaUsuarioLoad"></div>
			</div>
		</div>
	</div>
	<!-- modal para editar usuario -->
	<div class="modal fade" id="actualizaUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmUsuarioU" >
						<input type="text" id="idUsuario" hidden="" name="idUsuario">						
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" name="nombreU" id="nombreU">
						<p></p>
						<label>Apellido</label>							
						<input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU">
						<p></p>
						<label>Email(usuario)</label>							
						<input type="text" class="form-control input-sm" name="usuarioU" id="usuarioU">
						<p></p>
						<label>Contraseña</label>							
						<input type="password" class="form-control input-sm" name="passwordU" id="passwordU">						
					</form>	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="button" id="btnActualizaUsuario" class="btn btn-warning" data-dismiss="modal">Guardar</button>	
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<!--Script para validar vacio	-->
<script type="text/javascript">
	$(document).ready(function(){
		/*traemos el id  para que carge la tabla */
		$('#tablaUsuarioLoad').load("usuario/tablaUsuario.php");

		//script para evento click y ajax ---- también validará vacios
		$('#registro').click(function(){
			vacios=validarFormVacio('frmRegistro');

			//crear un mensaje de alerta
			if (vacios > 0) {
				alertify.alert("Debes llenar todos los campos.");
				return false;
			}

			datos=$('#frmRegistro').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/Usuario/agregarUsuario.php",
				success:function(r){
					//alert(r);
					if (r==1) {
						$('#frmRegistro')[0].reset();
						$('#tablaUsuarioLoad').load("usuario/tablaUsuario.php");
						alertify.success("Agregado con Exito!");
					}else{
						alertify.error("Falló al agregar");
					}

				}
			});

		});
	});
</script>

<!-- script para llenar los datos al modal -->
<script>
	function agregarDatoUsuario(idUsuario){
		$.ajax({
			type:"POST",
			data:"idUsuario=" + idUsuario,
			url:"../procesos/Usuario/obtenerDatoUsuario.php",
			success:function(r){
				dato=jQuery.parseJSON(r);
				$('#idUsuario').val(dato['id_usuario']);
				$('#nombreU').val(dato['nombre']);
				$('#apellidoU').val(dato['apellido']);
				$('#usuarioU').val(dato['email']);
			}
		});
	}

</script>

<!-- Script para actualizar Usuario -->
<script type="text/javascript">
	$(document).ready(function(){
	//script para evento click y ajax 
		$('#btnActualizaUsuario').click(function(){
			datos=$('#frmUsuarioU').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/Usuario/actualizaUsuario.php",
				success:function(r){
					if(r==1){
						$('#tablaUsuarioLoad').load("Usuario/tablaUsuario.php");
						alertify.success("Usuario Eliminado con Exito");
					}
					else{
						alertify.error("No se pudo Eliminar al usuario");
					}
				}
			});
		});
	});
</script>

<!-- Script para Eliminar Usuario -->
<script>
	function eliminarUsuario(idUsuario){
		alertify.confirm("¿Desea eliminar Usuario?", function(){
			$.ajax({
				type:"POST",
				data:"idUsuario="+idUsuario,
				url:"../procesos/Usuario/eliminarUsuario.php",
				success:function(r){
					if(r==1){
						$('#tablaUsuarioLoad').load("Usuario/tablaUsuario.php");
						alertify.success("Usuario Eliminado");
					}else{
						alertify.error("No se pudo Eliminar");
					}
				}
			});
		}, function(){
			alertify.error("¡Canceló!");
		});
	}	
</script>
<?php 
	}else {
		header("location:../index.php");
	}

?>