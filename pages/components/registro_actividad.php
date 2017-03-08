
<script src="dist/js/pages/registro_actividad.js"></script>
<script src="dist/js/pages/jquery.js"></script>
<script src="dist/js/pages/operaciones.js"></script>



<?php

$query = "select id from actividad where area=8 or area=" . $userinfo->area . "";
$re = $wish->conexion->query ( $query );
$fila = mysqli_fetch_row ( $re );

$queryContratos = "SELECT codigo,alias FROM new_lider_contratos where id_lider = $lider_id;";
$rContratos = $wish->conexion->query ( $queryContratos );

$editar = 0;
$editar_res = null;
if (isset ( $_GET ['editar'] )) {
	$editar = 1;
	$id_editar = $_GET ['editar'];
	$query = "select * from registro_actividad where id = " . $id_editar . "";
	$editar_res = $wish->conexion->query ( $query );
}

ini_set ( 'display_errors', 'Off' );
$tiempo = $_POST ["endTime"];
$h = date ( 'H', round ( strtotime ( $tiempo ) ) );
$h = $h * 60;
$m = date ( 'i', round ( strtotime ( $tiempo ) ) );
$tiempo = $h + $m;

?>




<!-- Main content -->


	<!-- SELECT2 EXAMPLE -->
	<div class="box box-default">

		<!-- /.box-header -->
		<div class="box-body">
			<form action="pages/backend/actividad.php" method="POST"  onsubmit="return validacion(this)"> 
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Actividad</label> <input type="text" id="actividad"
								class="form-control" disabled>
						</div>
						<div class="form-group">
							<label>Categoria</label> <input type="text" id="categoria"
								required class="form-control" disabled>
						</div>
						<div class="form-group">
							<label>Plataforma</label> <input id="plataforma" type="text"
								class="form-control" disabled>
						</div>






						<!-- /.form-group -->
						<div class="form-group">
							<label>Contrato</label> <select id="id_contrato"
								name="id_contrato" class="form-control select2"
								style="width: 100%;" required>
								<option value="" id=""></option>          
                  
			 <?php
				
while ( $row = $rContratos->fetch_object () ) {
					?>

                    <option id="<?php echo $row->codigo; ?>"
									value="<?php echo $row->codigo; ?>"><?php echo $row->alias;?></option>
                    <?php } ?>  
                </select>
						</div>


						<div class="form-group">
							<label>Tiempo</label>

							<div class="input-group" style="width: 50%;">
								<input disabled id="tiempo_calculado"
									name="tiempo_calculado_show" value="<?php echo $tiempo; ?>"
									type="text" class="form-control" disabled>

								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
							<!-- /.input group -->
						</div>

						<!-- hidden elements -->
						<input type="hidden" id="user_id" value="<?php echo $user_id ?>">

						<input id="tiempo_calculado" name="tiempo_calculado"
							value="<?php echo $tiempo; ?>" type="hidden">



						<!-- /.form-group -->
					</div>
					<!-- /.col -->

					<div class="col-md-6">
						<div class="form-group">
							<div class="form-group">
								<label>Id Actividad</label> <br> <select
									class="form-control select2" style="width: 50%;"
									id="id_actividad" name="id_actividad"
									onchange="queryActividad();" required>
									<option value="" id=""></option>
                  <?php
																		
while ( $row = $re->fetch_object () ) {
																			?>
                   <option value="<?php echo $row->id; ?>"><?php echo $row->id; ?></option>
                   <?php } ?>    
                </select>


							</div>
							<div class="form-group">
								<label>N° de tiquete</label> <input id="numerotiquete"
									name="numerotiquete" type="text" class="form-control"
									style="width: 50%;">
							</div>

							<div class="form-group">
								<label>Descripción</label>
								<textarea id="descripcion" name="descripcion"
									class="form-control" rows="5" placeholder="Descripción" required></textarea>
							</div>

							<div class="form-group">
								<label>Tiempo Real  (minutos)</label>

								<div class="input-group" style="width: 50%;">
									<input type="number" id="tiempoReal" name="tiempoReal"
										value="<?php echo $tiempo; ?>" type="text"
										class="form-control">

									<div class="input-group-addon">
										<i class="fa fa-clock-o"></i>
									</div>
								</div>
								<!-- /.input group -->
							</div>
						</div>
              
              
              <?php
														if ($editar) {
															?>
															<script>
																<?php
																$row_editar= $editar_res->fetch_object();
																$id_actividad = $row_editar->id_actividad;
																$numerotiquete = $row_editar->numerotiquete;
																$descripcion = $row_editar->descripcion;
																$id_contrato = $row_editar->id_contrato;
																$tiempoReal = $row_editar->tiempoReal;
																$tiempo_calculado = $row_editar->tiempo_calculado;
																?>
							                                     document.getElementById("id_actividad").value="<?php echo $id_actividad;  ?>";
							                                     queryActividad();
							                                     document.getElementById("numerotiquete").value="<?php echo $numerotiquete;  ?>";
							                                     document.getElementById("descripcion").value="<?php echo $descripcion;  ?>";
							                                     document.getElementById("<?php echo $id_contrato; ?>").selected = true;
							                                     document.getElementById("tiempo_calculado").value="<?php echo $tiempo_calculado;  ?>";
							                                     document.getElementById("tiempoReal").value="<?php echo $tiempoReal;  ?>";
							                                     
															  </script>  
															
                                            <input type="hidden" id="id"
							name="id" value="<?php echo $id_editar; ?>" /> <input
							type="hidden" id="editar" name="editar" value="1" />
                                                        <?php
														} else {
															?>
                                                         <input
							type="hidden" name="editar" value="0" />
                                                         <?php
														}
														
														?>        
              
              
              
              
            <!-- /.col -->
					</div>
					<div class="col-md-6 col-sm-offset-4">
						<div class="form-group">
							<button type="submit" class="btn btn-success"
								style="width: 150px;">Guardar</button>
							&nbsp; &nbsp; &nbsp; &nbsp; <a href="index.php"><button
									type="button" class="btn btn-danger" style="width: 150px;">Cancelar</button></a>
						</div>
					</div>
			</div>
			</form>
			<!-- /.row -->
		</div>
		<!-- /.box-body -->

	</div>
	<!-- /.box -->