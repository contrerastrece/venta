<?php 
	session_start();
	//si está llena nos mostrará el html
	if (isset($_SESSION['usuario'])) {
?>

<!DOCTYPE html>
<html>
<head>
	<title>Categorias</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
	<div class="container">
		<h1>Categorias</h1>
		<div class="row">
			<div class="col-sm-4">
				<form id="frmCategoria" action="">
					<label for="">Categoria</label>
					<input type="text" class="form-control input-sm" name="categoria" id="categoria">
					<p></p>
					<span class="btn btn-primary" id="btnAgregarCategoria">Agregar</span>	
				</form>		
			</div>
			<div class="col-sm-6">
				<div id="tablaCategoriaLoad"></div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="actualizaCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualiza Categoria</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" id="frmCategoriaU">				
						<input type="text" id="idCategoria" hidden="" name="idCategoria">
						<label for="">Categoria</label>
						<input type="text" id="categoriaU" name="categoriaU" class="form-control input-sm">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" id="btnActualizaCategoria" class="btn btn-warning" data-dismiss="modal">Guardar</button>		
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<!-- script para agregar Categoria -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaCategoriaLoad').load("categoria/tablaCategoria.php");

		$('#btnAgregarCategoria').click(function(){/*agregar el id de donde ocurrirá el evento del click*/			
			vacios=validarFormVacio('frmCategoria');
			//crear un mensaje de alerta
			if (vacios > 0) {
				alertify.alert("Debes llenar todos los campos.");
				return false;
			}

			datos=$('#frmCategoria').serialize();/*agregar el id de donde se sacará los datos*/
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/categoria/agregaCategoria.php",
				success:function(r){
					if(r==1){
						$('#frmCategoria')[0].reset();//nos permite limpiar el formulario al registrar 
						$('#tablaCategoriaLoad').load("categoria/tablaCategoria.php");
						alertify.success("Categoria agregada con exito");
					}
					else{
						alertify.error("No se pudo agregar categoria");
					}

				}
			});
		});
	})
</script>

<!-- script para Actualizar Categoria -->
<script type="text/javascript">
	$(document).ready(function(){
	//script para evento click y ajax 
		$('#btnActualizaCategoria').click(function(){
			datos=$('#frmCategoriaU').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/Categoria/actualizaCategoria.php",
				success:function(r){
					if(r==1){
						$('#tablaCategoriaLoad').load("categoria/tablaCategoria.php");
						alertify.success("Categoria Actualizado");
					}
					else{
						alertify.error("No se pudo actualizar Categoria");
					}
				}
			});
		});
	})
</script>

<!-- script para Eliminar Categoria -->
<script type="text/javascript">
	function agregarCategoria(idCategoria, categoria){
		$('#idCategoria').val(idCategoria);
		$('#categoriaU').val(categoria);
	}
	function eliminarCategoria(idCategoria){
		alertify.confirm('¿Desea eliminar la Categoria?', 
			function(){
				$.ajax({
				type:"POST",
				data: "idCategoria="+ idCategoria,
				url:"../procesos/categoria/eliminarCategoria.php",
				success:function(r){
					if(r==1){
						$('#tablaCategoriaLoad').load("categoria/tablaCategoria.php");
						alertify.success("Eliminado con exito");
					}
					else{
						alertify.error("No se pudo Eliminar categoria");
					}
			}
		});
			}, 
			function(){ 
				alertify.error('Se Canceló la operación')
			}
		);
	}

</script>
	
<?php 
	}else {
		header("location:../index.php");
	}

?>