<?php
    require_once "../../clases/conexion.php";
    session_start();    
    // print_r($_SESSION['tablaVentaTemp']);
    $c=new conectar();
    $conexion=$c->conexion();
    $sql="SELECT COUNT(id_venta), id_cliente, id_usuario, fechaCompra,SUM(precio) from detal_ventas GROUP BY id_venta";
    $result=mysqli_query($conexion,$sql);
?>

<div class="container">
    <div class="row">
        <div class="table-responsive">
            <table  id="tbl_ventaRealizada" class="table table-hover table-bordered  display nowrap" cellspacing="0" width="100%">       
                <thead class="thead-dark">
                    <tr>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Cliente</th>
                        <th>Total de Compra</th>
                        <th>Ticket</th>
                        <th>Reporte</th>
                    </tr>
                </thead>
            <?php
                while($ver=mysqli_fetch_row($result)):
            ?>
                <tbody>
                        <tr>
                            <td><?php echo $ver[0]." Productos" ?></td>
                            <td><?php echo $ver[3] ?></td>
                            <td><?php echo $ver[2] ?></td>
                            <td><?php echo $ver[1] ?></td>
                            <td><?php echo "S/ ".$ver[4] ?></td>
                            <td><?php echo "btnTicket" ?></td>
                            <td><?php echo  "btnReporte"?></td>
                        </tr>           
                </tbody>
            <?php
                endwhile;
            ?>
            </table>
            
        </div>       

    </div>

</div>

<!-- script para hacer responsive la tabla -->
<script>
    $(document).ready(function() {
        $('#tbl_ventaRealizada').DataTable({
            responsive:true
        });
        
    } );
</script>