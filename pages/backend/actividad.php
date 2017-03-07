<?php
session_start ();
if ($_SESSION ['authenticated'] == 1) {

include("../../modelo/conexion.php");

$editar             =$_POST['editar'];
$user_id            = $_SESSION['user_id'];
$id                 =$_POST['id_actividad'];
$numerotiquete      =$_POST['numerotiquete'];
$descripcion        =$_POST['descripcion'];
$id_contrato        =$_POST['id_contrato'];
$tiempoReal         =$_POST['tiempoReal'];
$fecha_final =$_POST['tiempo_calculado'];

$wish = new conexion; 
echo $editar;
    

if($editar == 0){
    $wish->registrarActividad ($user_id,$id,$descripcion,$fecha_final,$tiempoReal,$numerotiquete,$id_contrato);
}else{
	$id_reg             = $_POST['id'];
    $wish->actualizarActividad ($id_reg,$user_id,$id,$descripcion,$fecha_final,$tiempoReal,$numerotiquete,$id_contrato);
}
$wish->cerrar(); 

header("Location: ../../index.php");
}
?>