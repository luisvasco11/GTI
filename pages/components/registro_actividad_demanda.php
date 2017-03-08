
<script src="dist/js/pages/registro_actividad.js"></script>
<script src="dist/js/pages/jquery.js"></script>
<script src="dist/js/pages/operaciones.js"></script>

    
<?php

$query = "select actividad from actividad";
$res = $wish->conexion->query ( $query );

$query = "select id from actividad where area=8 or area=" . $userinfo->area . "";
$re = $wish->conexion->query ( $query );
$fila = mysqli_fetch_row ( $re );

$query1 = "select id from actividad where area=" . $userinfo->area . "";
$reimp = $wish->conexion->query ( $query1 );

$query = "select * from proyecto";
$rea = $wish->conexion->query ( $query );

$query = "select categoria from actividad";
$rep = $wish->conexion->query ( $query );

$queryContratos = "SELECT codigo,alias FROM new_lider_contratos where id_lider = $lider_id;";
$rContratos = $wish->conexion->query ( $queryContratos );


?>




<!-- Main content -->


<div class="col-md-12">
	<!-- SELECT2 EXAMPLE -->
	<div class="box box-default">

		<!-- /.box-header -->
		<div class="box-body">
			<form action="pages/backend/pendientes.php" method="POST" onsubmit="return validacion(this)">

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Actividad</label> <input type="text" id="actividad"
								class="form-control" disabled required>
						</div>
						<div class="form-group">
							<label>Categoria</label> <input type="text" name="categoria"
								id="categoria" required class="form-control" disabled  required>
						</div>
						<div class="form-group">
							<label>Plataforma</label> <input id="plataforma" type="text"
								class="form-control" disabled  required>
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
							<label>Descripción</label>
							<textarea id="descripcion" name="descripcion"
								class="form-control" rows="5" placeholder="Descripción" required></textarea>
						</div>
						<!-- /.form-group -->
					</div>
					<!-- /.col -->
					<div class="col-md-6">
						<div class="form-group">
							<label>Id actividad</label> <select id="id_actividad"
								name="id_actividad" class="form-control select2"
								style="width: 100%;" onchange="queryActividad();" required>
								<option value="" id=""></option>
                 <?php
																	
while ( $row = $re->fetch_object () ) {
																		$row->id;
																		?>

                    <option value="<?php echo $row->id; ?>"><?php echo $row->id; ?></option>
                    <?php } ?>  
                </select>














						</div>
						<div class="form-group">
							<label>N° Tiquete</label> <input type="text" id="numerotiquete"
								name="numerotiquete" class="form-control">
						</div>


						<div class="form-group">
							<i class="fa fa-calendar"></i> <label>Fecha y hora de inicio</label>
							<input id="fecha_inicio" name="fecha_inicio" required value=""
								type="datetime-local" class="form-control">
						</div>
						<div class="form-group">
							<label>Tiempo Real</label> <input id="tiempoReal"
								name="tiempoReal" type="number" class="form-control">
						</div>




						<br> <br> <br>

						<button type="submit" class="btn btn-success"
							style="width: 150px;">Guardar</button>
						&nbsp; &nbsp; &nbsp; &nbsp; <a href="index.php"><button
								type="button" class="btn btn-danger" style="width: 150px;">Cancelar</button></a>


						<!-- /.form-group -->
					</div>
					<!-- /.col -->
				</div>





			</form>
			<!-- /.row -->
		</div>
		<!-- /.box-body -->

	</div>
	<!-- /.box -->
</div>




