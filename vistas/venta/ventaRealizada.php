

<div class="container">
    <div class="row">
        <div class="table-responsive">
            <table  id="tbl_ventaRealizada" class="table table-hover table-bordered  display nowrap" cellspacing="0" width="100%">       
                <thead class="thead-dark">
                    <tr>
                        <th>Foto</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Total de Compra</th>
                        <th>Ticket</th>
                        <th>Reporte</th>
                    </tr>
                </thead>

            <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>           
            </tbody>
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