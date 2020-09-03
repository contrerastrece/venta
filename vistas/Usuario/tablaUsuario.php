<?php
    require_once "../../clases/conexion.php";
    

    $c=new conectar();
    $conexion=$c->conexion();

    $sql="SELECT id_usuario, nombre, apellido, email FROM usuarios" ;

    $result=mysqli_query($conexion,$sql);

?>


<table class="table table-hover table-bordered  display nowrap" cellspacing="0" width="100%" style="text-align:center" id="tbl_usuarios">    
   <thead class="thead-dark">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Usuario</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>   
   </thead>

    <?php  while($ver=mysqli_fetch_row($result)):  ?>
    <tr>
        <td><?php echo $ver[1]; ?></td>
        <td><?php echo $ver[2]; ?></td>
        <td><?php echo $ver[3]; ?></td>
        <td>
            <span class="btn btn-danger btn-sm" data-toggle="modal" data-target="#actualizaUsuario" onclick="agregarDatoUsuario('<?php echo $ver[0];?>')">
                <span class="bx bx-pencil"></span>
            </span>
        </td>
        <td>
            <span class="btn btn-warning btn-sm" onclick="eliminarUsuario('<?php echo $ver[0];?>')">
                <span class="bx bx-trash"></span>
            </span>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<script>
$(document).ready(function() {
    $('#tbl_usuarios').DataTable({
        responsive:true
    });
    
} );

</script>