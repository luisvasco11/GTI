<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {
include("../../modelo/conexion.php");

$tiempo = $_POST['tiempo'];
$user_id = $_POST['user'];

$wish = new conexion; 
$wish->tiempo($tiempo,$user_id);
$wish->cerrar(); 
}
?>