<?php

$_PAGE_PERMISSIONS = array(
	"1" => array(
		
	),
	"2" => array(
		"011" => false
	),
	"3" => array(
		
	)
);

// Pagina Actual : 011 

$_PAGE_CONFIG = array(
		//000 siempre es la home
		"000" => array(
			"show" => true,
			"isSubmenu" => false,
			"big" => "GTI",
			"small" => "Tablero de control",
			"menu" => "Tablero de control",
			"menu_css_class" => "fa-dashboard",
			"link" => 'pages/tablero/body.php'
		),
		
		"009" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"menu_css_class" => "fa-clock-o",
				"small" => "Bitacora de Operacion",
				"menu" => "Bitacora de Operacion",
				"submenu" => array(
						"1" => "005",
						"2" => "006",
						"3" => "010",
						"4" => "011"
				)
		),
		
		"005" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Bitacora de operacion",
				"small" => "Actividades por demanda",
				"menu" => "Actividades por demanda",
				"link" => 'pages/bitacora_operacion/registro_demanda/body.php',
				"menu_css_class" => "fa-pencil-square-o"
		),
		"006" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Bitacora de operacion",
				"small" => "Actividades del mes",
				"menu" => "Actividades del mes",
				"link" => 'pages/bitacora_operacion/actividades_mes/body.php',
				"menu_css_class" => "fa-list"
		),
		"010" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Bitacora de operacion",
				"small" => "Pendientes aprobacion",
				"menu" => "Pendientes aprobacion",
				"link" => 'pages/bitacora_operacion/actividades_pendientes/body.php',
				"menu_css_class" => "fa-edit"
		),
		"011" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Bitacora de operacion",
				"small" => "Asignacion de contratos",
				"menu" => "Asignacion de contratos",
				"link" => 'pages/bitacora_operacion/asignacion_contratos/body.php',
				"menu_css_class" => "fa-edit"
		),
		"012" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"menu_css_class" => "fa-info",
				"small" => "Gestion de eventos",
				"menu" => "Gestion de eventos",
				"submenu" => array(
						"1" => "013",
						"2" => "014"
				)
		),
		"013" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Gestion de eventos",
				"small" => "Nuevo evento",
				"menu" => "Nuevo evento",
				"link" => 'pages/nuevo_evento/body.php',
				"menu_css_class" => "fa-plus"
		),
		"014" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Gestion de eventos",
				"small" => "Nuevo evento 2",
				"menu" => "Nuevo evento 2",
				"link" => 'pages/nuevo_evento/body.php',
				"menu_css_class" => "fa-plus"
		),
		"007" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"small" => "Cambiar contraseña",
				"menu" => "Cambiar contraseña",
				"link" => 'pages/cambiar_contrasena/body.php',
				"menu_css_class" => "fa-key"
		),
		
		"001" => array(
				"show" => true,
				"isSubmenu" => false,
				"big" => "GTI",
				"menu_css_class" => "fa-line-chart",
				"small" => "Reportes",
				"menu" => "Reportes",
				"submenu" => array(
						"page1" => "003",
						"page2" => "008"
				)
		),
		"003" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Contratos",
				"menu" => "Contratos",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/contratos/body.php"
		),
		"008" => array(
				"show" => true,
				"isSubmenu" => true,
				"big" => "Reportes",
				"small" => "Productividad",
				"menu" => "Productividad",
				"menu_css_class" => "fa-file-pdf-o",
				"link" => "pages/reportes/productividad/body.php"
		),
		
		
		"002" => array(
			"show" => true,
			"isSubmenu" => false, 
			"big" => "GTI",
			"small" => "Sugerencias",
			"menu" => "Sugerencias",
			"menu_css_class" => "fa-envelope",
			"link" => 'pages/sugerencias/body.php'
		),
		
		"004" => array(
				"show" => false,
				"isSubmenu" => false,
				"big" => "GTI",
				"small" => "Registro actividad",
				"link" => 'pages/bitacora_operacion/registro/body.php'
		),

		"500" => array(
				"show" => false,
				"link" => 'pages/error/500.php'
		),
		"404" => array(
				"show" => false,
				"link" => 'pages/error/404.php'
		)
		
);
