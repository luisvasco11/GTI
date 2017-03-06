<?php
$queryArea = "select area from usuario where id=" . $user_id . "";
$resArea = $wish->conexion->query ( $queryArea );
$area_user = $resArea->fetch_object ();
$area_user = $area_user->area;

// Cantidad de analistas
$query = "SELECT COUNT(*) FROM usuario where lider='$user_id' and estado='A'";
$numanalista = $wish->conexion->query ( $query );

// Cantidad de contratos
$query = "SELECT COUNT(*) FROM proyecto where estado='A'";
$contratos = $wish->conexion->query ( $query );

// cantidad de actividades de mis analistas
$query = "SELECT sum(a.tiempo_calculado)/count(*) FROM registro_actividad a,usuario r WHERE a.user_id=r.id  and lider='$user_id' and MONTH(fecha_inicio) = MONTH(NOW())";
$numeroactividades = $wish->conexion->query ( $query );

// fecha_inicio > CURDATE()
// SELECT COUNT(*) FROM registro_actividad a,usuario r WHERE a.user_id=r.id and lider='r.user_id' JOIN WHERE r.fecha_inicio > CURDATE()
// $query="SELECT COUNT(*) FROM registro_actividad a,usuario r WHERE a.user_id=r.id and lider='$user_id'";

// cantidad de pendientes
$query = "SELECT COUNT(*) FROM registro_actividad a,usuario r WHERE a.user_id=r.id and lider='$user_id' AND a.estado='P'";
$pendientes = $wish->conexion->query ( $query );

// cantidad de pendientes para mensaje
$query = "SELECT COUNT(*) FROM registro_actividad a,usuario r WHERE a.user_id=r.id and lider='$user_id' AND a.estado='P'";
$pendientess = $wish->conexion->query ( $query );

// preparamos la consulta
$query = "select DATE_FORMAT(fecha_inicio, '%Y/%m/%d') dia, sum(tiempoReal) tiempo from registro_actividad group by DATE_FORMAT(fecha_inicio, '%Y/%m/%d')";
$result = $wish->conexion->query ( $query );

$numFilas = mysqli_num_rows ( $result );

// cargamos array con los nombres de las métricas a visualizar
$datos [0] = array (
		'distancia',
		'fecha' 
);

// recorremos filas
for($i = 1; $i < ($numFilas + 1); $i ++) {
	$datos [$i] = array (
			$wish->mysqli_result ( $result, $i - 1, "dia" ),
			( int ) $wish->mysqli_result ( $result, $i - 1, "tiempo" ) 
	);
}

?>



<!-- /.row -->

<!-- Main row -->
<div class="row">
	<!-- Left col -->
	<div class="col-md-12">
		<!-- MAP & BOX PANE -->
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Mis Colaboradores</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool"
						data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body no-padding">
				<div class="row">
					<div class="col-md-12 col-sm-8">
						<div class="pad">
							<!-- Map will be created here -->
							<table id="example" class="table table-striped table-bordered"
								cellspacing="0" width="100%">
								<thead>
									<tr>
										<th></th>
										<th>Nombre</th>
										<th>Productividad</th>
										<th>N° Actividades</th>
									</tr>
								</thead>
								<tbody>
                                            <?php
																																												$consulta = "SELECT convert(r.nombre using latin1) AS nombre, (avg(a.tiempo_calculado)) prod , (count(a.tiempo_calculado)) cantidad FROM registro_actividad a,usuario r WHERE a.user_id=r.id and lider='$user_id' and MONTH(fecha_inicio) = MONTH(NOW()) GROUP by r.nombre order by prod desc";
																																												
																																												if ($consulta = $wish->conexion->query ( $consulta )) {
																																													while ( $obj = $consulta->fetch_object () ) {
																																														?>
                                            <tr>
										<td><a class="glyphicon glyphicon-user"></a></td>
										<td><?php printf($obj->nombre);?></td>
										<td><?php printf($obj->prod);?></td>
										<td><?php printf($obj->cantidad);?></td>
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
					<!-- /.TABLA DE DATA TABLE -->





				</div>
				<!-- /.row -->
			</div>
			<!-- /.box-body -->
		</div>
	</div>
</div>