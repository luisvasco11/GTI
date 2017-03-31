<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
	
	include ("../../modelo/conexion.php");
	
	$id_actividad = $_POST ['id_actividad'];
	$user_id = $_SESSION ['user_id'];
	$fecha_inicio = $_POST ['fecha_inicio'];
	$tiempoReal = $_POST ['tiempoReal'];
	$numerotiquete = $_POST ['numerotiquete'];
	$descripcion = $_POST ['descripcion'];
	$id_contrato = $_POST ['id_contrato'];
	$horaExtra = $_POST ['horaExtra'];
	
	$wish = new conexion ();
	$wish->registrarPendiente ( $id_actividad, $user_id, $fecha_inicio, $tiempoReal, $numerotiquete, $descripcion, $id_contrato, $horaExtra );
	$wish->cerrar ();
	
	header ( "Location: ../../index.php" );
}

?>