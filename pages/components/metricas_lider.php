<?php

$queryArea = "select area from usuario where id=" . $user_id . "";
$resArea = $wish->conexion->query ( $queryArea );
$area_user = $resArea->fetch_object ();
$area_user = $area_user->area;

// Cantidad de analistas
$query = "SELECT COUNT(*) FROM usuario where lider='$user_id' and estado='A'";
$numanalista = $wish->conexion->query ( $query );

// Cantidad de contratos
$query = "SELECT COUNT(*) FROM bitacora.new_lider_contratos where id_lider='$user_id'";
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

        <div class="row">
        
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-aqua">
				<i class="fa fa-users" aria-hidden="true"></i>
			</div>
			<div class="content">
				<div class="text">N° Colaboradores</div><br>
				<div class="number">
                    <?php	
						while ( $row = $numanalista->fetch_array ( MYSQLI_NUM ) ) {
						echo $row [0] . "<br/>\n";
						}
							?></div>
			</div>
		</div>

	</div>
	
	
	
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-red">
				<i class="fa fa-line-chart" aria-hidden="true"></i>
			</div>
			<div class="content">
				<div class="text">Productividad</div><br>
				<div class="number">
                    <?php
										while ( $row = $numeroactividades->fetch_array ( MYSQLI_NUM ) ) 
										{
										echo round ( $row [0] ) . "<br/>\n";
										}
								?></div>
			</div>
		</div>

	</div>



	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-green">
				<i class="fa fa-file" aria-hidden="true"></i>
			</div>
			
			<div class="content">
				<div class="text">N° Contratos</div><br>
				<div class="number">
				<a href="index.php?page=011"> 
                    <?php	
									while ( $row = $contratos->fetch_array ( MYSQLI_NUM ) ) {
									echo $row [0] . "<br/>\n";
									}
								 ?></a></div>
			
			</div>
			
		</div>

	</div>	



	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-yellow">
				<i class="fa fa-envelope-o" aria-hidden="true"></i>
			</div>
			
			<div class="content">
				<div class="text">N° Pendientes</div><br>
				<div class="number">
				<a href="index.php?page=010"> 
                    <?php	
									while ( $row = $pendientes->fetch_array ( MYSQLI_NUM ) ) {
									echo $row [0] . "<br/>\n";
									}
								?></a></div>
			</div>
		</div>

	</div>	
       

      </div>
      <!-- /.row -->
