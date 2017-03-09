<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- Estilo DataTable  -->
<link
	href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css"
	rel="stylesheet" />
<link
	href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.1/semantic.min.css"
	rel="stylesheet" />
<link
	href="https://cdn.datatables.net/1.10.12/css/dataTables.semanticui.min.css"
	rel="stylesheet" />








<script>
		$(document).ready(function(){
		$("#myModal").modal('show');
		});
            document.getElementById("inicio").disabled = true;             
            $(document).ready(function() {
                $('#zctb').DataTable( {
                    "aaSorting": [[ 1, "desc" ]]
                } );
            } );

            function test(link){
                var id = link.name;
                console.log("Link seleccionado: "+link.name);
                $('html,body').scrollTop(0);
            }
        </script>
        
        
        
        
        





<?php 

function printFilterModal() {
	?>	
	<div class="panel-body">
            <button class="btn btn-info" data-toggle="modal" data-target="#myModal">
                 <i class="fa fa-filter" aria-hidden="true"></i>
                      Filtrar
                       </button>
                         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                         <h4 class="modal-title" id="myModalLabel" align="center">Filtros</h4>
                                        	</div>
                                        	<div class="modal-body">
                                        	
                                        		<div class="col-md-13">

          <div class="box box-info">
            
            <div class="box-body">
              <!-- Date dd/mm/yyyy -->
              <div class="form-group">
                <label>DATE:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control" >
                </div>
                <!-- /.input group -->
              </div>
              <!-- phone mask -->
              <div class="form-group">
                <label>NUMBER:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="number" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- phone mask -->
              <div class="form-group">
                <label>TEXT:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                  </div>
                  <input type="text" class="form-control">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>   
                         
                                        </div>
                                        <div class="modal-footer">
                                                                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                    




	<?php 
}

?>

                   

<div class="panel-body">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
      <div class="box-header">
              <h3 class="box-title"><?php echo $titulo; ?></h3>
            </div>
            
            	<?php printFilterModal(); ?>
            
				<div class="box-body">
					<table id="dataTable-<?php echo $report;?>"
						class="table table-bordered table-striped">
						<thead>
							<tr>
                <?php
																
foreach ( $columns as $col => $show_col ) {
																	?>
														<th><?php printf($show_col)?></th>
													<?php
																}
																?>
                </tr>
						</thead>
						<tbody>
                <?php
																
																if ($consulta = $wish->conexion->query ( $query )) {
																	while ( $arr = $consulta->fetch_array () ) 

																	{
																		?>
												<tr>
													<?php
																		
foreach ( $columns as $col => $show_col ) {
																			?>
														<td><?php printf($arr[$col])?></td>
													<?php
																		}
																		?>
													 
												</tr>
												<?php
																	
}
																	$consulta->close ();
																}
																?>
                </tbody>

					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- DataTables -->
<script
	src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
	src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script
	src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script
	src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script
	src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script
	src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script
	src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script
	src="https://cdn.datatables.net/1.10.12/js/dataTables.semanticui.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.1/semantic.min.js"></script>

<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->

<script>
        $(document).ready(function() {
            $('#dataTable-<?php echo $report;?>').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                     'excel'
                ]
            } );
        } );
        
    </script>



