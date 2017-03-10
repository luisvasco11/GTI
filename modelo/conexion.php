<?php
class conexion {
	public $conexion;
	private $server = "bitacora.arus.com.co";
	private $usuario = "root";
	private $pass = "pruebas48";
	private $db = "gti";
	public $pdo_conn;

	
	public function __construct() {
		$this->conexion = new mysqli ( $this->server, $this->usuario, $this->pass, $this->db );
		
		if ($this->conexion->connect_errno) {
			
			die ( "Fallo al tratar de conectar con MySQL: (" . $this->conexion->connect_errno . ")" );
		}
		$this->conexion->query ( "SET NAMES 'utf8'" );
		$this->pdo_conn = new PDO ( "mysql:host=$this->server;dbname=$this->db", $this->usuario, $this->pass );
	}
	public function cerrar() {
		$this->conexion->close ();
	}
	public function login($correo, $password) {
		
		$query = "select p.cedula,p.nombre,u.id,p.proyecto,u.fecha_control,p.cargo,p.correo_personal,p.jefe,p.celular,u.rol from new_usuario u,new_personas p where u.correo = '$correo' and u.correo = p.correo and u.password = '$password' and u.estado='A'";
		$consulta = $this->conexion->query ( $query );
		$num = mysqli_num_rows ( $consulta );
		if ($num == 1) {
			$row = mysqli_fetch_array ( $consulta );
			$id = $row ['cedula'];
			$proyecto = $row ['proyecto'];
			$lider_id = $row ['jefe'];
			$cargo = $row ['cargo'];
			$area = $this->getAreaByUserId ( $id );
			$name = $row ['nombre'];
			session_start ();
			$_SESSION ['authenticated'] = 1;
			$_SESSION ['rol'] = $row ['rol'];
			$_SESSION ['user_id'] = $id;
			$_SESSION ['user_name'] = $name;
			$_SESSION ['lider_id'] = $lider_id;
			$_SESSION ['proyecto'] = $proyecto;
			$_SESSION ['cargo'] = $cargo;
			$_SESSION ['area'] = $area;
		}
		echo "index.php";
	}
	public function tiempo($tiempo, $user_id) {
		$this->tiempo = $tiempo;
		$query = "INSERT INTO registro_actividad (id_actividad,cedula,fecha_inicio,estado,id_contrato) VALUES ( '0','" . $user_id . "','" . $tiempo . "','R',76)";
		$consulta = $this->conexion->query ( $query );
	}
	public function registrarActividad($user_id, $id, $descripcion, $fecha_final, $tiempoReal, $numerotiquete, $id_contrato) 

	{
		$query = "update registro_actividad set id_actividad=" . $id . ", descripcion='" . $descripcion . "', id_contrato='" . $id_contrato . "', numerotiquete='" . $numerotiquete . "' ,tiempo_calculado='" . $fecha_final . "', fecha_fin=now(),tiempoReal='" . $tiempoReal . "', estado='F' where cedula=" . $user_id . " and estado='R';";
		echo $query;
		$consulta = $this->conexion->query ( $query );
	}
	public function actualizarActividad($id_reg, $user_id, $id, $descripcion, $fecha_final, $tiempoReal, $numerotiquete, $id_contrato) 

	{
		$query = "update registro_actividad set id_actividad=" . $id . ", descripcion='" . $descripcion . "', id_contrato='" . $id_contrato . "', numerotiquete='" . $numerotiquete . "' , tiempoReal='" . $tiempoReal . "' where id=" . $id_reg . " and cedula=" . $user_id . " and estado='F';";
		
		echo $query;
		$consulta = $this->conexion->query ( $query );
	}
	public function getLiderByUserID($id) {
		$query = "select cedula from new_usuario where cedula = " . $id . ";";
		$res = $this->conexion->query ( $query );
		return $res;
	}
	public function getActiveTaskForUser($user_id) {
		$query = "select * from registro_actividad where estado ='R' and cedula = " . $user_id . ";";
		$res = $this->conexion->query ( $query );
		return $res;
	}
	public function getActividadesByID($id) {
		$query = "select actividad from actividad where id = " . $id . ";";
		$res = $this->conexion->query ( $query );
		return $res;
	}
	public function getPlataformaByID($id) {
		$query = "select plataforma from actividad where id = " . $id . ";";
		return $this->conexion->query ( $query );
	}
	public function getCategoriaByID($id) {
		$query = "select categoria from actividad where id = " . $id . ";";
		return $this->conexion->query ( $query );
	}
	public function cambiopass($user_id, $cambiopass) {
		$query = "UPDATE new_usuario set password='" . $cambiopass . "'WHERE cedula='" . $user_id . "'";
		$consulta = $this->conexion->query ( $query );
	}
	public function cambiopasssuper($user_id, $cambiopass) {
		$query = "UPDATE new_usuario set password='" . $cambiopass . "'WHERE cedula='" . $user_id . "'";
		$consulta = $this->conexion->query ( $query );
	}
	public function registrarPendiente($id_actividad, $user_id, $fecha_inicio, $tiempoReal, $numerotiquete, $descripcion, $id_contrato) {
		$query = "INSERT INTO registro_actividad (id_actividad,cedula,fecha_inicio,estado,tiempoReal,numerotiquete,descripcion,id_contrato) VALUES ('" . $id_actividad . "','" . $user_id . "','" . $fecha_inicio . "','P','" . $tiempoReal . "','" . $numerotiquete . "','" . $descripcion . "','" . $id_contrato . "')";
		$consulta = $this->conexion->query ( $query );
	}
	public function actualizarEstado($id, $nuevoEstado) {
		$query = "update registro_actividad set estado='" . $nuevoEstado . "' where id=" . $id . ";";
		
		$consulta = $this->conexion->query ( $query );
	}
	public function activarContrato($codigo, $alias, $lider) {
		$query = "insert into new_lider_contratos values('" . $codigo . "','" . $alias . "'," . $lider . ");";
		
		$consulta = $this->conexion->query ( $query );
	}
	public function desactivarContrato($codigo, $lider) {
		$query = "delete from new_lider_contratos where codigo = '" . $codigo . "' and id_lider = '" . $lider . "';";
		$consulta = $this->conexion->query ( $query );
	}
	/*public function registro_analista($nombre, $area, $correo, $pass, $horario, $lider) {
		$this->nombre = $nombre;
		$this->area = $area;
		$this->correo = $correo;
		$this->pass = $pass;
		$this->horario = $horario;
		$this->lider = $lider;
		
		$query = "INSERT INTO new_usuario (id,nombre,correo,horalaboral,area,lider,password,cargo_id,estado,ubicacion,educacion,habilidades) VALUES ('','" . $nombre . "','" . $correo . "','" . $horario . "','" . $area . "','" . $lider . "','" . $pass . "','2','A','','','')";
		$consulta = $this->conexion->query ( $query );
	}*/
	public function getAreaByUserId($user_id) {
		$queryArea = "select area from new_usuario where cedula=" . $user_id . "";
		$resArea = $this->conexion->query ( $queryArea );
		$area_user = $resArea->fetch_object ();
		$area_user = $area_user->area;
		return $area_user;
	}
	/*public function actualizarperfil1($nombre, $user_id, $ubicacion, $educacion) {
		$query = "update new_usuario set nombre='" . $nombre . "',ubicacion='" . $ubicacion . "',educacion='" . $educacion . "' where id=" . $user_id . "";
		
		$consulta = $this->conexion->query ( $query );
	}
	public function actualizarperfil($nombre, $user_id, $ubicacion, $habilidades, $educacion) {
		$query = "update usuario set nombre='" . $nombre . "',ubicacion='" . $ubicacion . "',educacion='" . $educacion . "', habilidades='" . $habilidades . "' where id=" . $user_id . "";
		
		$consulta = $this->conexion->query ( $query );
	}*/
	function mysqli_result($res, $row, $field = 0) {
		$res->data_seek ( $row );
		$datarow = $res->fetch_array ();
		return $datarow [$field];
	}
	public function actualizarPersonasNomus() {
		set_time_limit ( 1000 );
		include_once 'modelo/conexion_nomus.php';
		$nomus = new NomusIntegracion ();
		$personas = $nomus->getUsuariosNomus ();
		$this->conexion->query ( "truncate table new_personas;" );
		// print_r($personas);
		foreach ( $personas as $key => $registro ) {
			
			$cedula = $registro ["CEDULA"];
			$nombre = $registro ["NOMBRE"];
			$correo = $registro ["CORREO_CORPORATIVO"];
			$correo_personal = $registro ["CORREO_PERSONAL"];
			$celular = $registro ["TEL_CELULAR"];
			$cargo = $registro ["CARGO"];
			$proyecto = $registro ["COD_PROYECTO"];
			$jefe = $registro ["CEDULA_JEFE"];
			$insert = "insert into new_personas (cedula,nombre,proyecto,cargo,jefe,correo,correo_personal,celular) 
 		 			values('$cedula','$nombre','$proyecto','$cargo','$jefe','$correo','$correo_personal','$celular')";
			$this->conexion->query ( $insert );
		}
	}
	// Cantidad de analistas
	function getColaboradoresFromLider($lider) {
		$query = "SELECT COUNT(*) FROM new_personas where jefe='$lider'";
		$numanalista = $this->conexion->query ( $query );
		return $numanalista;
	}
	// cantidad de actividades de mis analistas
	function getProductividadColaboradores($lider) {
		$query = "SELECT sum(a.tiempo_calculado)/count(*) FROM registro_actividad a,new_personas r WHERE a.cedula=r.cedula  and r.jefe='$lider' and MONTH(fecha_inicio) = MONTH(NOW())";
		$numeroactividades = $this->conexion->query ( $query );
		return $numeroactividades;
	}
	// Cantidad de contratos
	function getContratosByLider($lider) {
		$query = "SELECT COUNT(*) FROM new_lider_contratos where id_lider='$lider'";
		$contratos = $this->conexion->query ( $query );
		return $contratos;
	}
	// cantidad de pendientes
	function getPendientesByLider($lider) {
		$query = "SELECT COUNT(*) FROM registro_actividad a,new_personas r WHERE a.cedula=r.cedula and jefe='$lider' AND a.estado='P'";
		$pendientes = $this->conexion->query ( $query );
		return $pendientes;
	}
	// cantidad de actividades mes
	function getActividadesMesAnalista($cedula) {
		$query = "SELECT COUNT(*) FROM registro_actividad WHERE cedula='$cedula'and estado='F' and MONTH(fecha_inicio) = MONTH(NOW())";
		$actividadesdelmes = $this->conexion->query ( $query );
		return $actividadesdelmes;
	}
	
	// productividad
	function getProductividad($cedula) {
		$query = " SELECT  round ((avg(a.tiempoReal)),1) productividad  FROM registro_actividad a,new_personas r WHERE a.cedula='$cedula' and MONTH(fecha_inicio) = MONTH(NOW())";
		$productividad = $this->conexion->query ( $query );
		return $productividad;
	}
	function getFechaControlUser($cedula) {
		$ctrl_q = "select fecha_control from new_usuario where cedula = '$cedula' ";
		$ctrl_r = $this->conexion->query ( $ctrl_q );
		$ctrl_arr = $ctrl_r->fetch_array ();
		$ctrl = $ctrl_arr ["fecha_control"];
		return $ctrl;
	}
	
	
	public function registrarAusentismo($user_id, $proyecto, $fecha_inicio, $fecha_fin, $tipo, $comentario) {
		$query =	"insert into
					registro_actividad (id_actividad,fecha_inicio,estado,tiempoReal,descripcion,id_contrato,cedula)
					select
					'8' as id_actividad,
					date_format(v.selected_date,'%Y-%m-%d 07:30:00') as fecha_inicio,
					'F' as estado,
<<<<<<< HEAD
					'8.5' as tiempoReal,
=======
					'510' as tiempoReal,
>>>>>>> refs/heads/pruebas
					'$tipo - $comentario' as descripcion,
					'$proyecto' as id_proyecto,
					'$user_id' as cedula
					from
					(select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
							(select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v
							where v.selected_date between '$fecha_inicio' and '$fecha_fin' - INTERVAL 1 DAY
							and DATE_FORMAT(v.selected_date,'%w') <> 0
							and DATE_FORMAT(v.selected_date,'%w') <> 6";
		
		$consulta = $this->conexion->query ( $query );
	}
	
	
	

	
	

	
	
	
	
	
	
	
	
	
	
}

?>
