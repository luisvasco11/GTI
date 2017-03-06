<?php

if(array_key_exists($report,$_REPORTS_CONFIG)){
	$res = $_REPORTS_CONFIG[$report];
	$query = $res["query"];
	$columns = $res["columnas"];
	$titulo = $res["titulo"];
	include "pages/components/reportes_component.php";
}else{
	include $vista->_PAGE_CONFIG["500"]["link"];
}

?>