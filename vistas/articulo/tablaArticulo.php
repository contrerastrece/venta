<?php
    require_once "../../clases/conexion.php";

    $c=new conectar();
    $conexion=$c->conexion();

    $sql="SELECT art.nombre, art.descripcion, art.cantidad, art.precio, img.ruta, cat.nombreCategoria, art.id_producto
                from articulos as art
                inner join imagenes as img
                on art.id_imagen=img.id_imagen
                inner join categorias as cat
                on art.id_categoria= cat.id_categoria
                
                ";
    $result=mysqli_query($conexion,$sql);
?>

<div class="table-responsive">
    <table id="example" class="table table-hover table-bordered  display nowrap" cellspacing="0" width="100%">        
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Categoria</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <!-- inicio del whie -->
            <?php
                while($ver=mysqli_fetch_row($result)):
            ?>
            <tr>
                <td><?php echo $ver[0]; ?></td>
                <td><?php echo $ver[1]; ?></td>
                <td><?php echo $ver[2]; ?></td>
                <td><?php echo "S/ ".$ver[3]; ?></td>
                <td>
                    <?php 
                    $imgVer=explode("/",$ver[4]);
                    $img_ruta=$imgVer[1]."/".$imgVer[2]."/".$imgVer[3]; 
                    ?>
                <img width="80" height="80" src="<?php echo $img_ruta ?>" alt="">
                </td>
                <td><?php echo $ver[5]; ?></td>
                <td>
                    <span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#articuloU" onclick="agregarDatoArticulo('<?php echo $ver[6]; ?>')">
                        <span class="bx bx-pencil"></span>
                    </span>
                </td>
                <td>
                    <span class="btn btn-danger btn-sm" onclick="eliminarArticulo('<?php echo $ver[6] ?>')">
                        <span class="bx bx-trash"></span>
                    </span>
                </td>
            </tr>            
            <?php
                endwhile;
            ?>
            <!-- fin del while -->
        </tbody>
        <tfoot class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Categoria</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </tfoot>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive:true
        });
        
    } );
</script>