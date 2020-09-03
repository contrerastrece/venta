<?php 
	session_start();
	//si está llena nos mostrará el html
	if (isset($_SESSION['usuario'])) {
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ventas</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
	<div class="container">
		<div class="row my-3">
			<div class="col-sm-12">
				<ul class="nav nav-pills" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="btnVenderProducto" data-toggle="pill" href="#ventaProducto" role="tab" aria-controls="pills-contact" aria-selected="false">Vender Productos</a>			
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="btnVentaRealizada" data-toggle="pill" href="#ventaRealizada" role="tab" aria-controls="pills-contact" aria-selected="false">Ventas realizadas</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="row"> 
			<div class="col-sm-12 tab-content" id="pills-tabContent">
				<div id="ventaProducto" class="tab-pane fade" role="tabpanel" aria-labelledby="btnVenderProducto"></div>
				<div id="ventaRealizada" class="tab-pane fade" role="tabpanel" aria-labelledby="btnVentaRealizada"></div>
			</div>
		</div>
	</div>

</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btnVenderProducto').click(function(){
			esconderSeccionVenta();
			$('#ventaProducto').load('venta/ventaProducto.php');
			$('#ventaProducto').show();
		});
		$('#btnVentaRealizada').click(function(){
			esconderSeccionVenta();
			$('#ventaRealizada').load('venta/ventaRealizada.php');
			$('#ventaRealizada').show();
		});
	});
	function esconderSeccionVenta(){
		$('#ventaProducto').hide();
		$('#ventaRealizada').hide();
	}

</script>
<?php 
	}else {
		header("location:../index.php");
	}

?>