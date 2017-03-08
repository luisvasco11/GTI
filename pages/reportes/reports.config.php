<?php

// Reporte de productividad
$fechainicio = '2017-02-01';
$fechafin = '2017-03-01';
$consulta = "select `r`.`id_actividad` AS `id_actividad`,`a`.`plataforma` AS `plataforma`,`a`.`categoria` AS `categoria`,`a`.`actividad` AS `actividad`
,`r`.`cedula` AS `cedula`
,(select area from areas where id=`d`.`area`) AS Namearea
,`d`.`area` AS `area`
,`r`.`fecha_inicio` AS `fecha_inicio`
,`r`.`tiempoReal` AS `tiempoReal`
,(select nombre from new_personas where cedula = r.cedula) AS nombre
,`r`.`descripcion` AS `descripcion`
,`r`.`id_contrato` AS `id_contrato`
,`p`.`proyecto` AS `proyecto`
from (((`registro_actividad` `r` join `actividad` `a`) join `new_usuario` `d`) join `proyecto` `p`)
where ((`r`.`fecha_inicio` > '$fechainicio'
and `r`.`fecha_inicio` < '$fechafin'   ) 
and (`r`.`id_actividad` = `a`.`id`) 
and (`r`.`id_contrato` = `p`.`id`) 
and (`r`.`cedula` = `d`.`cedula`) 
and (`r`.`estado` = 'F') 
and (`d`.`area`  <> 0 )) 
order by `r`.`fecha_inicio` asc";


$_REPORTS_CONFIG = array(
		"ejemplo" => array(
			"titulo" => "Reporte de ...",
			"query" => "select columnaquery1,columnaquery2,columnaquery3 from ...",
			"columnas" => array(
				"columnaquery1" => "columnatabla1",
				"columnaquery2" => "columnatabla2",
				"columnaquery3" => "columnatabla3",
			)
		),
		"contratos" => array(
				"titulo" => "Reporte de Estado de Contratos",
				"query" => "SELECT codigo,nombre,estado FROM new_proyectos;",
				"columnas" => array(
						"codigo" => "Codigo del proyecto",
						"nombre" => "Nombre",
						"estado" => "Estado",
				)
		),
		"productividad" => array(
				"titulo" => "Reporte de Productividad",
				"query" => $consulta,
				"columnas" => array(
						"fecha_inicio" => "Fecha Inicio",
						"nombre" => "Colaborador",
						"plataforma" => "Plataforma",
						"categoria" => "Categoria",
						"actividad" => "Actividad",
						"Namearea" => "Area",
						"tiempoReal" => "Tiempo Real",
						"proyecto" => "Proyecto",
				)
		)
);
