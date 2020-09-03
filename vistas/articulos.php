<?php 
	session_start();
	//si está llena nos mostrará el html
	if (isset($_SESSION['usuario'])) {
?>

<!DOCTYPE html>
<html>
<head>
	<title>Articulos</title>
	<?php require_once "menu.php"; ?>
	<?php require_once "../clases/conexion.php"; 
		$c= new conectar();
		$conexion=$c->conexion();
		//mostraremos las categorias en la etiqueta option
		$sql="SELECT id_categoria,nombreCategoria FROM categorias ";

		$result=mysqli_query($conexion,$sql);
	
	?>
</head>
<body>
	<div class="container">
		<div class="row my-3">			
			<h1 class="d-inline">Articulos</h1>	

			<!-- Button trigger modal -->
			<button class="btn btn-success ml-2 btn-lg" data-toggle="modal" data-target="#exampleModal">
				<span class="bx bx-plus-circle"></span> Agregar
			</button>		
			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header bg-primary text-white">
							<h5 class="modal-title m-auto" id="exampleModalLabel">Agregar Articulos</h5>
							<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="" id="frmArticulo" enctype="multipart/form-data"><!--ectype sirver para enviar archivos-->
								<label for="">Categoria</label>
								<select class="form-control input-sm" name="categoriaSelect" id="categoriaSelect">
									<option value="A">Selecciona Categoria</option>
								<?php while($ver=mysqli_fetch_row($result)):  ?>
									<option value="<?php echo $ver[0]?>"><?php echo $ver[1]; ?></option>
								<?php endwhile; ?>
								</select>
								<label for="">Nombre</label>
								<input type="text" class="form-control input-sm" id="nombre" name="nombre">
								<label for="">Descripcion</label>
								<input type="text" class="form-control input-sm" id="descripcion" name="descripcion">
								<label for="">Cantidad</label>
								<input type="text" class="form-control input-sm" id="cantidad" name="cantidad">
								<label for="">Precio</label>
								<input type="text" class="form-control input-sm" id="precio" name="precio">
								<label for="" class="control-label">Agregar Imagen del Articulo</label>
								<input type="file" id="imagen" name="imagen" class="form-control">
							</form>		
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							<button type="button" class="btn btn-success" id="agregarArticulo">Agregar</button>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>	
	
	<div class="container-fluid">
		<div class="row mx-2">		
			<div class="col-md-12" id="tablaArticuloLoad">
			</div>
		</div>
	</div>

	<!-- Modal ArticuloUpdate -->
	<div class="modal fade" id="articuloU" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-warning text-white">
					<h5 class="modal-title mx-auto" id="exampleModalLabel">Actualizar Articulo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
				<?php
					 //mostraremos las categorias en la etiqueta option
					$sql="SELECT id_categoria,nombreCategoria FROM categorias ";

					$result=mysqli_query($conexion,$sql);
				
				?>
					<form action="" id="frmArticuloU" enctype="multipart/form-data"><!--ectype sirver para enviar archivos-->
						<input type="text" id="idArticulo" hidden="" name="idArticulo"> <!-- nos servirá para buscar por el idproducto -->
						<label for="">Categoria</label>
						<select class="form-control input-sm" name="categoriaSelectU" id="categoriaSelectU">
							<option value="A">Selecciona Categoria</option>
						<?php while($ver=mysqli_fetch_row($result)):  ?>
							<option value="<?php echo $ver[0]?>"><?php echo $ver[1]; ?></option>
						<?php endwhile; ?>
						</select>
						<label for="">Nombre</label>
						<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
						<label for="">Descripcion</label>
						<input type="text" class="form-control input-sm" id="descripcionU" name="descripcionU">
						<label for="">Cantidad</label>
						<input type="text" class="form-control input-sm" id="cantidadU" name="cantidadU">
						<label for="">Precio</label>
						<input type="text" class="form-control input-sm" id="precioU" name="precioU">
						<label for="" class="control-label">Agregar Imagen del Articulo</label>
						<input type="file" id="imagenU" name="imagenU" class="form-control">
					</form>	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-warning" id="btnActualizarArticulo" data-dismiss="modal">Actualizar Articulo</button>
				</div>
			</div>
		</div>  
	</div>			

</body>
</html>
<!-- Script para obtener datos  -->
<script>
	function agregarDatoArticulo(idarticulo){
		$.ajax({
			type:"POST",
			data:"idart=" + idarticulo,
			url:"../procesos/Articulo/obtenerDatoArticulo.php",
			success:function(r){
				dato=jQuery.parseJSON(r);
				$('#idArticulo').val(dato['id_producto']);
				$('#categoriaSelectU').val(dato['id_categoria']);
				$('#nombreU').val(dato['nombre']);
				$('#descripcionU').val(dato['descripcion']);
				$('#cantidadU').val(dato['cantidad']);
				$('#precioU').val(dato['precio']);

			}
		});
	}

</script>
<!-- Script para actualizar -->
<script>
	$(document).ready(function(){
		$('#btnActualizarArticulo').click(function(){

			datos=$('#frmArticuloU').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/Articulo/actualizaArticulo.php",
				success:function(r){
					if(r==1){
						$('#tablaArticuloLoad').load("articulo/tablaArticulo.php");
						alertify.success("Actualizado con exito");
					}else{
						alertify.error("Error al Actualizar");
					}
				}
			});
		});
	})

	function eliminarArticulo(idArticulo){
		alertify.confirm('¿Desea eliminar el Articulo?', 
			function(){
				$.ajax({
				type:"POST",
				data: "idArticulo="+ idArticulo,
				url:"../procesos/Articulo/eliminarArticulo.php",
					success:function(r){
						if(r==1){
							$('#tablaArticuloLoad').load("articulo/tablaArticulo.php");
							alertify.success("Eliminado con exito");
						}
						else{
							alertify.error("No se pudo Eliminar Articulo");
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

<!-- script par Insertar Articulos -->
<script type="text/javascript">
	$(document).ready(function(){
		/*traemos el id  para que carge la tabla */
		$('#tablaArticuloLoad').load("articulo/tablaArticulo.php");

		$('#agregarArticulo').click(function(){

			//validar vacio
			vacios=validarFormVacio('frmArticulo');
			//crear un mensaje de alerta
			if (vacios > 0) {
				alertify.alert("Debes llenar todos los campos.");
				return false;
			}

			var formData = new FormData(document.getElementById("frmArticulo"));

			$.ajax({
					url: "../procesos/Articulo/insertaArticulo.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success:function(r){			
							
						if(r == 1){
							$('#frmArticulo')[0].reset();
							$('#tablaArticuloLoad').load('articulo/tablaArticulo.php');
							alertify.success("Agregado con exito :D");
						}else{
							alertify.error("Fallo al subir el archivo :(");
						}
					}
			});		
		});

	});
</script>

<?php 
	}else {
		header("location:../index.php");
	}

?>