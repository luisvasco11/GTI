<?php
// session_start ();
// if ($_SESSION ['authenticated'] == 1) {
// 	include("../../modelo/conexion.php");

// $ausentismo  =$_POST['ausentismo'];
// $fini  =$_POST['fecha_inicio'];
// $ffin  =$_POST['fecha_fin'];
// $com  =$_POST['comentario'];


// $wish = new conexion; 
// $wish->activarContrato($codigo,$alias,$lider);
// $wish->cerrar(); 

// }

// Create two new DateTime-objects...
$date1 = new DateTime('2017-03-01');
$date2 = new DateTime('2017-03-02');

// The diff-methods returns a new DateInterval-object...
$diff = $date2->diff($date1);

// Call the format method on the DateInterval-object
echo $diff->format('%a Day and %h hours');


?>