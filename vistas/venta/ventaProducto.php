<?php
    require_once "../../clases/conexion.php";

    $c=new conectar();
    $conexion=$c->conexion();
?>

<div class="row">
    <div class="col-sm-4">
        <form action="" id="frmVentaProducto">
            <label for="">Cliente</label>
            <select class="form-control input-sm" name="clienteVenta" id="clienteVenta">
                <option value="A">Selecione Cliente</option>
                <?php
                    $sql="SELECT id_cliente, nombre, apellido from clientes"; 
                    $result=mysqli_query($conexion,$sql);    
                    while($ver=mysqli_fetch_row($result)):            
                ?>              
				<option value="<?php echo $ver[0]?>"><?php echo $ver[1]." ".$ver[2]; ?></option>
				<?php endwhile; ?>
            </select>
            <p></p>            
            <label for="">Producto</label>
            <select class="form-control input-sm" name="productoVenta" id="productoVenta">
                <option value="A">Seleccione Producto</option>
                <?php
                    $sql="SELECT id_producto, nombre from articulos"; 
                    $result=mysqli_query($conexion,$sql);    
                    while($ver=mysqli_fetch_row($result)):            
                ?>
				<option value="<?php echo $ver[0]?>"><?php echo $ver[1]; ?></option>
				<?php endwhile; ?>
            </select>
            <p></p>
            <label for="">Descripcion</label>
            <textarea name="" id="" class="form-control"></textarea>
            <p></p>
          
            <label for="">Cantidad</label>
            <input type="text" class="form-control input-sm" id="cantidad" name="cantidad">
          
            <label for="">Precio</label>
            <p></p>
            <input type="text" class="form-control input-sm" id="precio" name="precio">
            
            <p></p>
            <button class="btn btn-success" id="btnVender">Vender</button>
        </form>
    </div>
</div>
<!-- Script para jalar el precio -->
<script>
    $(#)

</script>
<script>
	$(document).ready(function(){
		$('#clienteVenta').select2();
		$('#productoVenta').select2();

	});
</script>