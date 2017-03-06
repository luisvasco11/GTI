<?php 
if($rol == 1){ //lider
	include "pages/components/metricas_ingeniero.php";
	include "pages/components/reloj.php";
	include "pages/components/metricas_lider.php";
	include "pages/components/productiviad_recursos_lider.php";
}
if($rol == 2){ //analista
	include "pages/components/metricas_ingeniero.php";
	include "pages/components/reloj.php";
}
if($rol == 3){ //cordinador
	include "pages/components/metricas_lider.php";
}



?>