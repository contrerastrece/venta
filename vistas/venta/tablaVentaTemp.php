<?php
    session_start();    
    // print_r($_SESSION['tablaVentaTemp']);
    
?>
<style>
    table.dataTable.dataTable_width_auto {
  width: auto;
    }

</style>

<div class="row">
    <div class="h2">Cliente</div>
    
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
                <td><?php echo $datos[0]; ?></td>
                <td><?php echo $datos[1]; ?></td>
                <td><?php echo $datos[2]; ?></td>
                <td><?php echo $datos[3]; ?></td>
                <td><?php echo $datos[4]; ?></td>
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
                $i++;
            }
            endif;
        ?>
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