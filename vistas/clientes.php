<?php 
	session_start();
	//si está llena nos mostrará el html
	if (isset($_SESSION['usuario'])) {
?>

<!DOCTYPE html>
<html>
<head>
	<title>Clientes</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
	<div class="container">
		<div class="row my-3">
			<h1>Clientes</h1>
			<!-- Button trigger modal -->
			<button class="btn btn-success ml-2 btn-lg" data-toggle="modal" data-target="#modalRegistrarCliente">
				<span class="bx bx-plus-circle"></span> Agregar
			</button>		
			<!-- Modal -->
			<div class="modal fade" id="modalRegistrarCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header bg-primary text-white">
							<h5 class="modal-title m-auto" id="exampleModalLabel">Agregar Clientes</h5>
							<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body">
							<form id="frmCliente">						
								<label>Nombre</label>
								<input type="text" class="form-control input-sm" name="nombre" id="nombre">
								
								<label>Apellido</label>							
								<input type="text" class="form-control input-sm" name="apellido" id="apellido">
								
								<label>Dirección</label>							
								<input type="text" class="form-control input-sm" name="direccion" id="direccion">
							
								<label>Email(usuario)</label>							
								<input type="email" class="form-control input-sm" name="usuario" id="usuario">
								
								<label>Telefono</label>							
								<input type="tel" class="form-control input-sm" name="telefono" id="telefono" pattern='\d{9}'>
								
								<label>RFC</label>							
								<input type="text" class="form-control input-sm" name="rfc" id="rfc">						
							</form>		
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
							<button type="button" class="btn btn-success" id="btnAgregarCliente" data-dismiss="modal">Agregar</button>
						</div>
					</div>
				</div>
			</div>		
		
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12" id="tablaClienteLoad"></div>
		</div>
	</div>

	<!-- Modal UPDATE-->
				<div class="modal fade" id="modalActualizarCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary text-white">
								<h5 class="modal-title m-auto" id="exampleModalLabel">Actualizar Datos</h5>
								<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
								<form id="frmClienteU">	
									<input type="text" hidden="" name="id_cliente" id="id_cliente">					
									<label>Nombre</label>
									<input type="text" class="form-control input-sm" name="nombreU" id="nombreU">
									
									<label>Apellido</label>							
									<input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU">
									
									<label>Dirección</label>							
									<input type="text" class="form-control input-sm" name="direccionU" id="direccionU">
								
									<label>Email(usuario)</label>							
									<input type="email" class="form-control input-sm" name="usuarioU" id="usuarioU">
									
									<label>Telefono</label>							
									<input type="tel" class="form-control input-sm" name="telefonoU" id="telefonoU" pattern='\d{9}'>
									
									<label>RFC</label>							
									<input type="text" class="form-control input-sm" name="rfcU" id="rfcU">						
								</form>		
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
								<button type="button" class="btn btn-success" id="btnActualizarCliente" data-dismiss="modal">Actualizar</button>
							</div>
						</div>
					</div>
				</div>							

</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaClienteLoad').load("cliente/tablaCliente.php");


		$('#btnAgregarCliente').click(function(){/*agregar el id de donde ocurrirá el evento del click*/
			
			vacios=validarFormVacio('frmCliente');

			//crear un mensaje de alerta
			if (vacios > 0) {
				alertify.alert("Debes llenar todos los campos.");
				return false;
			}

			datos=$('#frmCliente').serialize();/*agregar el id de donde se sacará los datos*/
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/Cliente/agregarCliente.php",
				success:function(r){
					if(r==1){
						$('#frmCliente')[0].reset();
						$('#tablaClienteLoad').load("cliente/tablaCliente.php");
						alertify.success("Cliente agregado con exito");
					}
					else{
						alertify.error("No se pudo agregar Cliente");
					}

				}
			});
		});
	})
</script>

<!-- script para obtener datos de cliente -->
<script>
	function agregarDatosClientes(idCLIENTE){
		$.ajax({
			type:"POST",
			data:"idCliente=" + idCLIENTE,
			url:"../procesos/Cliente/obtenerDatoCliente.php",
			success:function(r){
				dato=jQuery.parseJSON(r);
				$('#id_cliente').val(dato['id_cliente']);
				$('#nombreU').val(dato['nombre']);
				$('#apellidoU').val(dato['apellido']);
				$('#direccionU').val(dato['direccion']);
				$('#usuarioU').val(dato['email']);
				$('#telefonoU').val(dato['telefono']);
				$('#rfcU').val(dato['rfc']);
			}
		});
	}

</script>

<!-- script para actualizar datos de cliente -->
<script>
	$(document).ready(function(){
		$('#btnActualizarCliente').click(function(){

			datos=$('#frmClienteU').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/Cliente/actualizarCliente.php",
				success:function(r){
					if(r==1){
						$('#tablaClienteLoad').load("cliente/tablaCliente.php");
						alertify.success("Actualizado con exito");
					}else{
						alertify.error("Error al Actualizar");
					}
				}
			});	
		});
	});
</script>

<!-- script para eliminar cliente -->
<script>
	function eliminarCliente(idCLIENTE){
			alertify.confirm('¿Desea eliminar este Cliente?', function(){ 
				$.ajax({
					type:"POST",
					data:"idCliente=" + idCLIENTE,
					url:"../procesos/cliente/eliminarCliente.php",
					success:function(r){
						if(r==1){
							$('#tablaClienteLoad').load('cliente/tablaCliente.php');
							alertify.success("Eliminado con exito!!");
						}else{
							alertify.error("No se pudo eliminar :(");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo !')
			});
		}
</script>
<?php 
	}else {
		header("location:../index.php");
	}

?>