<?php
$query = $wish->getActiveTaskForUser ( $user_id );

$row = mysqli_fetch_array ( $query );
$numero_filas = mysqli_num_rows ( $query );
$initialDate = $row ['fecha_inicio'];

// Actividades del mes
$query = "SELECT COUNT(*) FROM registro_actividad WHERE user_id='$user_id'and estado='F' and MONTH(fecha_inicio) = MONTH(NOW())";
$actividadesdelmes = $wish->conexion->query ( $query );

// Nombre y Area
$query = "select u.nombre, (select a.area from areas a where a.id =u.area) area from usuario u where u.id='$user_id'";
$nameandarea = $wish->conexion->query ( $query );

// productividad
$query = " SELECT  round ((avg(a.tiempoReal)),1) productividad  FROM registro_actividad a,usuario r WHERE a.user_id='$user_id' and MONTH(fecha_inicio) = MONTH(NOW())";
$productividad = $wish->conexion->query ( $query );

?>

<div class="row">       
        
        <?php
								
								echo "
             <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                    <div class='info-box hover-zoom-effect'>
                        <div class='icon bg-blue'>
                            <i class='fa fa-spinner fa-spin fa-3x fa-fw'></i>
                        </div>
                        <div class='content'>
                            <div class='text'>Próximamente</div>
                            <div class='number'><span class=''></span></div>
                    
                        </div>
                    </div>

                </div>
          
        <!-- ./col -->
        <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                    <div class='info-box hover-zoom-effect'>
                        <div class='icon bg-green'>
                            <i class='fa fa-spinner fa-spin fa-3x fa-fw'></i>
                        </div>
                        <div class='content'>
                            <div class='text'>Próximamente</div>
                            <div class='number'><span class=''></span></div>
                    
                        </div>
                    </div>

                </div>                 
                ";
								
								?>



<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-yellow">
				<i class="fa fa-line-chart" aria-hidden="true"></i>
			</div>
			<div class="content">
				<div class="text">Productividad del mes</div><br>
				<div class="number">
                    <?php
																				while ( $row = $productividad->fetch_array ( MYSQLI_NUM ) ) {
																					
																					echo $row [0] . "<br/>\n";
																				}
																				?></div>
			</div>
		</div>

	</div>








	<!-- ./col -->

	<!-- ./col -->
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="info-box hover-zoom-effect">
			<div class="icon bg-red">
				<i class="fa fa-clock-o" aria-hidden="true"></i>
			</div>
			<div class="content">
				<div class="text">Actividades del mes</div><br>
				<div class="number">
					<span class="count"><?php
					while ( $row = $actividadesdelmes->fetch_array ( MYSQLI_NUM ) ) {
						echo $row [0] . "<br/>\n";
					}
					?></span>
				</div>

			</div>
		</div>

	</div>
	<!-- ./col -->
</div>