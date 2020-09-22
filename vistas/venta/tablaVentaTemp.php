<?php
require_once "../../clases/conexion.php";
    session_start();    
    // print_r($_SESSION['tablaVentaTemp']);
    $c=new conectar();
    $conexion=$c->conexion();
    
?>
<style>
    table.dataTable.dataTable_width_auto {
  width: auto;
    }

</style>

<div class="row mb-2">                         
    <div class="col-md-12 p-0">
        <div class="input-group">
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
                                            
            <div class="input-group-append ml-2" >
                <span class="btn btn-success" onclick="generarVenta()">Generar Venta</span>
            </div> 
        </div>                 
    </div>
</div>
<div class="row">   
    <table class="table table-hover responsive table-bordered  display nowrap dataTable_width_auto" cellspacing="0" style="text-align:center" id="tablaVenta">    
        <thead class="thead-dark">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Importe</th>
                    <th>Acción</th>
                </tr>   
        </thead>
        <?php
                //    El carácter @ se utiliza para que PHP no devuelva los errores
                //    si una llamada a una función causa un error en tiempo de ejecución.
                //    También bloquea los posibles warning.
                //    Simplemente lo que se consigue es que PHP no muestre el típico
                //    mensaje de error con el motivo del error, el archivo y la línea
                //    de código específica donde se ha provocado.
            if(isset($_SESSION['tablaVentaTemp'])):
                $i=0;
                $total=0;
                foreach (@$_SESSION['tablaVentaTemp'] as $key) {
                    $datos=explode("||", @$key);
        ?>
            <tr>
                <td><?php echo $datos[1]; ?></td>
                <td><?php echo $datos[2]; ?></td>
                <td><?php echo $datos[3]; ?></td>
                <td><?php echo $datos[4]; ?></td>
                <td>S/ <?php echo $datos[5]; ?></td>
                <td>
                    <div class="btn-group">
                        <span class="btn btn-warning btn-sm mr-2">
                            <span class="bx bx-pencil"></span>
                        </span>
                        <span class="btn btn-danger btn-sm" onclick="quitar('<?php echo $i; ?>')"> 
                            <span class="bx bx-trash"></span>
                        </span>
                    </div>
                </td>
            </tr>
        <?php
                $total+=$datos[5];
                $i++;
            }
            endif;
        ?>
        <tr class="thead-dark">
            <th colspan="4">Total venta</th>
            <th>S/ <?php echo @$total; ?></th>
            <th>
                <span class="btn btn-danger btn-sm" onclick="quitar('<?php  ?>')"> 
                    <span class="bx bx-trash"></span> Limpiar
                </span>
            </th>
        </tr>
    </table>

</div>

<script>
    $(document).ready(function() {
        $('#tablaVenta').DataTable({
            responsive:true,
            // autoWidth=false;
            columnDefs:[
            {orderable:false , targets: 0, searchable:false, width: "10%"},
            {orderable:false , targets: 1, searchable:false, width: "10%"},
            {orderable:false , targets: 2, searchable:false, width: "10%"},
            {orderable:false , targets: 3, searchable:false, width: "10%"},
            {orderable:false , targets: 4, searchable:false, width: "10%"},
            {orderable:false , targets: 5, searchable:false, width: "10%"}

            ];
        });

        
        
    } );
    
    

</script>
<!-- script para la libreria select -->
<script>
	$(document).ready(function(){
		$('#clienteVenta').select2();
	});
</script>