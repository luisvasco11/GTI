<?php

class conexion  {

    public $conexion;
    private $server = "localhost";
    private $usuario = "root";
    private $pass = "";
    private $db = "bitacora";
    private $correo ;
    private $password;


    public function __construct(){

        $this->conexion = new mysqli ($this->server, $this->usuario, $this->pass, $this->db);
        
        if($this->conexion->connect_errno){

            die("Fallo al tratar de conectar con MySQL: (". $this->conexion->connect_errno.")");

        }
        $this->conexion->query("SET NAMES 'utf8'");
    }

    public function cerrar(){

        $this->conexion->close();

    }

    public function login($correo, $password){

        $this->correo = $correo;
        $this->password = $password;

        $query = "select * from usuario where correo = '".$this->correo."' and password = '".$this->password."' and estado='A'";
        $consulta = $this->conexion->query($query);
        $num = mysqli_num_rows($consulta);
        if($num == 1){
        $row = mysqli_fetch_array($consulta);
        $id = $row['id'];
        $lider_res = $this->getLiderByUserID($id);
        $lider_arr = mysqli_fetch_array($lider_res);
        $lider_id = $lider_arr["lider"];
        $area = $this->getAreaByUserId($id);
        
       // $lider = mysqli_fetch_object($q_lider_id);
        //$lider_id =  $lider->id_lider;
        
        $name = $row['nombre'];
        session_start();
        $_SESSION ['authenticated'] = 1;
        $_SESSION ['rol'] = $row['cargo_id'];
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $name;
        $_SESSION['lider_id'] = $lider_id;
        $_SESSION['area'] = $area;
        
        }
        echo "index.php";
    }

    public function tiempo($tiempo,$user_id)
    {
        $this->tiempo = $tiempo;
        $query = "INSERT INTO registro_actividad (id_actividad,user_id,fecha_inicio,estado,id_contrato) VALUES ( '0','".$user_id."','".$tiempo."','R',76)";
        $consulta = $this->conexion->query($query); 
    }

    public function registrarActividad ($user_id,$id,$descripcion,$fecha_final,$tiempoReal,$numerotiquete,$id_contrato)

    { 
        $query ="update registro_actividad set id_actividad=".$id.", descripcion='".$descripcion."', id_contrato='".$id_contrato."', numerotiquete='".$numerotiquete."' ,tiempo_calculado='".$fecha_final."', fecha_fin=now(),tiempoReal='".$tiempoReal."', estado='F' where user_id=".$user_id." and estado='R';" ;
        echo $query;
        $consulta = $this->conexion->query($query); 
    } 

    public function actualizarActividad ($id_reg,$user_id,$id,$descripcion,$fecha_final,$tiempoReal,$numerotiquete,$id_contrato)

    { 
        $query ="update registro_actividad set id_actividad=".$id.", descripcion='".$descripcion."', id_contrato='".$id_contrato."', numerotiquete='".$numerotiquete."' , tiempoReal='".$tiempoReal."' where id=".$id_reg." and user_id=".$user_id." and estado='F';" ;


        echo $query;
        $consulta = $this->conexion->query($query);


    } 

    public function getLiderByUserID($id){
    	$query="select lider from usuario where id = ".$id.";";
    	$res = $this->conexion->query($query);
    	return $res;
    }

    public function getActiveTaskForUser($user_id){
        $query="select * from registro_actividad where estado ='R' and user_id = ".$user_id.";";
        $res = $this->conexion->query($query); 
        return $res;
    }

    public function getActividadesByID($id){
        $query="select actividad from actividad where id = ".$id.";";
        $res = $this->conexion->query($query); 
        return $res;
    }
    public function getPlataformaByID($id){
        $query="select plataforma from actividad where id = ".$id.";";
        return $this->conexion->query($query); 
    }
    public function getCategoriaByID($id){
        $query="select categoria from actividad where id = ".$id.";";
        return $this->conexion->query($query); 
    }

    public function cambiopass($user_id,$cambiopass){
        $query ="UPDATE usuario set password='".$cambiopass."'WHERE id='".$user_id."'";
        $consulta = $this->conexion->query($query);

    }
    public function cambiopasssuper($user_id,$cambiopass){
    	$query ="UPDATE usuario set password='".$cambiopass."'WHERE id='".$user_id."'";
    	$consulta = $this->conexion->query($query);
    
    }

    public function registrarPendiente($id_actividad,$user_id,$fecha_inicio,$tiempoReal,$numerotiquete,$descripcion,$id_contrato){
        $query = "INSERT INTO registro_actividad (id_actividad,user_id,fecha_inicio,estado,tiempoReal,numerotiquete,descripcion,id_contrato) VALUES ('".$id_actividad."','".$user_id."','".$fecha_inicio."','P','".$tiempoReal."','".$numerotiquete."','".$descripcion."','".$id_contrato."')";
        $consulta = $this->conexion->query($query); 



    }
     public function actualizarEstado ($id,$nuevoEstado)
    { 
        $query ="update registro_actividad set estado='".$nuevoEstado."' where id=".$id.";" ;
        
        $consulta = $this->conexion->query($query); 
    } 
    
    public function activarContrato ($codigo,$alias,$lider)
    {
    	$query ="insert into bitacora.new_lider_contratos values('".$codigo."','".$alias."',".$lider.");" ;
    
    	$consulta = $this->conexion->query($query);
    }
    

    public function desactivarContrato ($codigo,$lider)
    {
    	$query ="delete from bitacora.new_lider_contratos where codigo = '".$codigo."' and id_lider = '".$lider."';" ;
    	$consulta = $this->conexion->query($query);
    }
    




    public function registro_analista($nombre,$area,$correo,$pass,$horario,$lider)
    {

        $this->nombre =$nombre;
        $this->area =$area;
        $this->correo =$correo;
        $this->pass =$pass;
        $this->horario =$horario;
        $this->lider =$lider; 

        $query ="INSERT INTO usuario (id,nombre,correo,horalaboral,area,lider,password,cargo_id,estado,ubicacion,educacion,habilidades) VALUES ('','".$nombre."','".$correo."','".$horario."','".$area."','".$lider."','".$pass."','2','A','','','')";
        $consulta = $this->conexion->query($query);
        
        
        
    }
    
    
    public function getAreaByUserId($user_id){
    	$queryArea="select area from usuario where id=".$user_id."";
    	$resArea= $this->conexion->query($queryArea);
    	$area_user = $resArea->fetch_object();
    	$area_user = $area_user->area;
    	return $area_user;
    }
    
   public function actualizarperfil1 ($nombre,$user_id,$ubicacion,$educacion)
    { 
        $query ="update usuario set nombre='".$nombre."',ubicacion='".$ubicacion."',educacion='".$educacion."' where id=".$user_id."";

        $consulta = $this->conexion->query($query); 
    } 


     public function actualizarperfil ($nombre,$user_id,$ubicacion,$habilidades,$educacion)
    { 
        $query ="update usuario set nombre='".$nombre."',ubicacion='".$ubicacion."',educacion='".$educacion."', habilidades='".$habilidades."' where id=".$user_id."";

        $consulta = $this->conexion->query($query); 
    } 


    function mysqli_result($res, $row, $field = 0) {
    	$res->data_seek ( $row );
    	$datarow = $res->fetch_array ();
    	return $datarow [$field];
    }





}









?>
