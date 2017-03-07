
<script src="dist/js/pages/registro_actividad.js"></script>
<script src="dist/js/pages/jquery.js"></script>
<script src="dist/js/pages/operaciones.js"></script>



<?php

// Nombre y Area
$query = "select u.nombre, (select a.area from areas a where a.id =u.area) area from usuario u where u.id='$user_id'";
$nameandarea = $wish->conexion->query ( $query );

$queryArea = "select area from usuario where id=" . $user_id . "";
$resArea = $wish->conexion->query ( $queryArea );
$area_user = $resArea->fetch_object ();
$area_user = $area_user->area;

$query = "select actividad from actividad";
$res = $wish->conexion->query ( $query );

$query = "select id from actividad where area=8 or area=" . $area_user . "";
$re = $wish->conexion->query ( $query );
$fila = mysqli_fetch_row ( $re );

$query1 = "select id from actividad where area=" . $area_user . "";
$reimp = $wish->conexion->query ( $query1 );

$query = "select * from proyecto";
$rea = $wish->conexion->query ( $query );

$query = "select categoria from actividad";
$rep = $wish->conexion->query ( $query );

$queryContratos = "SELECT codigo,alias FROM bitacora.new_lider_contratos where id_lider = $lider_id;";
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
									onchange="queryActividad(this);" required>
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
								<label>Tiempo Real</label>

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