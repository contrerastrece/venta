<?php
    require_once "../../clases/conexion.php";
    $c=new conectar();
    $conexion=$c->conexion();
    $sql="SELECT id_cliente, nombre, apellido, direccion, email, telefono, rfc from clientes";

    $result=mysqli_query($conexion,$sql);
?>

<div class="table-responsive">
    <table id="tbl_clientes" class="table table-hover table-bordered  display nowrap" cellspacing="0" width="100%">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>  
                <th>Dirección</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>RFC</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while($ver=mysqli_fetch_row($result)):
        ?>
            <tr>
                <td><?php echo $ver[1] ; ?></td>
                <td><?php echo $ver[2] ; ?></td>
                <td><?php echo $ver[3] ; ?></td>
                <td><?php echo $ver[4] ; ?></td>
                <td><?php echo $ver[5] ; ?></td>
                <td><?php echo $ver[6] ; ?></td>
                <td>
                    <span class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalActualizarCliente" onclick="agregarDatosClientes('<?php echo $ver[0]; ?>')">
                        <span class="bx bx-pencil"></span>
                    </span>
                </td>
                <td>
                    <span class="btn btn-warning btn-sm" onclick="eliminarCliente('<?php echo $ver[0]; ?>')">
                        <span class="bx bx-trash"></span>
                    </span>
                </td>
            </tr>
        <?php
            endwhile;
        ?>    
        </tbody>
    </table>

</div>
<!-- script para hacer responsive la tabla -->
<script>
    $(document).ready(function() {
        $('#tbl_clientes').DataTable({
            responsive:true
        });
        
    } );
</script>