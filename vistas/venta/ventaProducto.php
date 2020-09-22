<?php
    require_once "../../clases/conexion.php";
    $c=new conectar();
    $conexion=$c->conexion();
?>

<div class="container-fluid" id="ventaProducto">
    <div class="row">
        <div class="col-md-4">
            <form id="frmVentaProducto">
                <!-- <label for="">Cliente</label>
                <select class="form-control input-sm" name="clienteVenta" id="clienteVenta">
                    <option value="A">Selecione Cliente</option>
                    <option value="0">Publico General</option>
                    <?php
                        $sql="SELECT id_cliente, nombre, apellido from clientes"; 
                        $result=mysqli_query($conexion,$sql);    
                        while($ver=mysqli_fetch_row($result)):            
                    ?>              
                    <option value="<?php echo $ver[0]?>"><?php echo $ver[1]." ".$ver[2]; ?></option>
                    <?php endwhile; ?>
                </select>
                <p></p>             -->
                <!-- <label for="">Producto</label> -->
                <select class="form-control" name="productoVenta" id="productoVenta" style="width:100%">
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

                <div class="card">
                    <div id="imgProducto"></div>
                    <div class="card-body">
                        <!-- <label for="">Descripcion</label> -->
                        <textarea readonly="" name="descripcion" id="descripcion"  class="form-control"></textarea>
                        <p></p>
                    
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Stock</label>
                                <input readonly="" type="text" class="form-control input-sm" id="cantidad" name="cantidad">
                            </div>

                            <div class="col-md-6">
                                <label for="">Precio</label>
                                <input readonly="" type="text" class="form-control input-sm" id="precio" name="precio">
                            </div>
                        </div>
                        
                        <p></p>
                        <div class="row">                            
                            <div class="col-md-12">
                                <div class="input-group">
                                    <select class="custom-select">
                                        <option value="1" name="opc_1">10</option>
                                        <option value="2" name="opc_2">20</option>
                                        <option value="1" name="opc_1">30</option>
                                        <option value="2" name="opc_2">40</option>
                                        <option value="1" name="opc_1">50</option>
                                        <option value="2" name="opc_2">60</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" id="btnAdd_Vender">Añadir a canasta</button>
                                    </div> 
                                </div>         
                            </div> 
                        </div>                       
                    </div>
                </div>                
            </form>
        </div>
        <div class="col-md-8">
            <div id="tablaVentaTempLoad"></div>
        </div>
    </div>
</div>

<!--AgregarProducto, quitaProducto de la canasta  -->
<script>    
    $(document).ready(function(){
        $('#tablaVentaTempLoad').load("venta/tablaVentaTemp.php");
        // script para asignar valores dependiendo del producto
        $('#productoVenta').change(function(){    
            datos=$('#imgProducto').serialize();       
            $.ajax({
                type:"POST",
                data:"idProducto=" + $('#productoVenta').val(),
                url:"../procesos/Venta/llenarFormProducto.php",
                success:function(r){              
                    dato=jQuery.parseJSON(r);
                    
                    $('#descripcion').val(dato['descripcion']);
                    $('#cantidad').val(dato['cantidad']);
                    $('#precio').val(dato['precio']);
                    $('#imgProducto').prepend('<img id="imgp" class="card-img-top" style="whidth:100%; height:10rem" src="'+dato['ruta']+'"/>');
                    
                }
            });
        });

        // script para agregar producto a la canasta
        $('#btnAdd_Vender').click(function(){/*agregar el id de donde ocurrirá el evento del click*/		
            // validar vacios
            vacios=validarFormVacio('frmVentaProducto');
			if (vacios > 0) {
				alertify.alert("Debes llenar todos los campos.");
				return false;
			}

			datos=$('#frmVentaProducto').serialize();/*agregar el id de donde se sacará los datos*/
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/Venta/agregarProductoVenta.php",
				success:function(r){
                    if(r==1){
						// $('#frmVentaProducto')[0].reset();//nos permite limpiar el formulario al registrar 
						// $('#tablaVentaTempLoad').load("venta/tablaVentaTemp.php");
                        alertify.success("Agregado a la Canasta");
					}
					else{
						alertify.error("No se pudo agregar a la Canasta");
					}
				}
			});
		});        
    });

    // funcion para elimiar producto de la canasta
    function quitar(index){       
        $.ajax({
            type:"POST",
            data:"INDEX=" + index,
            url:"../procesos/Venta/quitarProducto.php",
            success:function(r){
                $('#tablaVentaTempLoad').load("venta/tablaVentaTemp.php");
                alertify.warning("Producto retirado");
            }
        });
    }

    // funcion para crear venta
    function generarVenta(){
        $.ajax({
			url:"../procesos/Venta/crearVenta.php",
			success:function(r){
                alert(r);
                if(r > 0){
                    $('#tablaVentaTempLoad').load("venta/tablaVentaTemp.php");
                    $('#frmVentaProducto')[0].reset();
                    alertify.alert("Venta agregado");
                }else if(r==0){
                    alertify.alert("No hay producto en la canasta");
                }else{
                    alertify.error("No se pudo crear venta");
                }
			}
		});
    }
</script>

<!-- script para la libreria select -->
<script>
	$(document).ready(function(){
		$('#clienteVenta').select2();
		$('#productoVenta').select2();

	});
</script>