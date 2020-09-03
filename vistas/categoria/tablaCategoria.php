<?php
    require_once "../../clases/conexion.php";
    $c= new conectar();
    $conexion=$c-> conexion();
    
    $sql="SELECT id_categoria, nombreCategoria FROM categorias";
    $result= mysqli_query($conexion,$sql);

?>

<div class="table-responsive">
    <table class="table table-hover table-condensed table-bordered" style="text-align:center">
        <thead class="thead-dark">
            <tr>
                <th>Categoria</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
<?php
    while($ver=mysqli_fetch_row($result)):
?>
    <tbody>
        <tr>
            <td><?php echo $ver[1] ?></td>
            <td>
                <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#actualizaCategoria" onclick="agregarCategoria('<?php echo $ver[0]?>','<?php echo $ver[1]?>')">
                    <span class="bx bx-pencil"></span>
                </span>
            </td>
            <td>
                <span class="btn btn-danger btn-sm" onclick="eliminarCategoria('<?php echo $ver[0]?>','<?php echo $ver[1]?>')">
                    <span class="bx bx-trash"></span>
                </span>
            </td>
        </tr>
    </tbody>
        
<?php
endwhile;
?>        
    </table>
</div>