    
    <script>
            document.getElementById("inicio").disabled = true;             
            $(document).ready(function() {
                $('#zctb').DataTable( {
                    "aaSorting": [[ 4, "desc" ]]
                } );
            } );

            function test(link){
                var id = link.name;
                console.log("Link seleccionado: "+link.name);
                $('html,body').scrollTop(0);
            }
        </script>
    

<?php

// Nombre y Area
$query ="select u.nombre, (select a.area from areas a where a.id =u.area) area from usuario u where u.id='$user_id'";
$nameandarea = $wish->conexion->query ( $query );




$queryArea="select area from usuario where id=".$user_id."";
$resArea= $wish->conexion->query($queryArea);
$area_user = $resArea->fetch_object();
$area_user = $area_user->area;



$editar=0;
$editar_res=null;
if( isset($_GET['editar']) ){
	$editar=1;
	$id_editar = $_GET['editar'];
	$query="select * from registro_actividad where id = ".$id_editar."";
	$editar_res=$wish->conexion->query($query);
}



$query="select actividad from actividad";
$res=$wish->conexion->query($query);


$query="select id from actividad where area=8 or area=".$area_user."";
$re=$wish->conexion->query($query);

$query="select * from proyecto";
$rea=$wish->conexion->query($query);


$query="select categoria from actividad";
$rep=$wish->conexion->query($query);



//Contratos
$queryContratos="select * from proyecto where estado='A'";
$rContratos=$wish->conexion->query($queryContratos);








//Nombre del usuario
$query="SELECT nombre FROM usuario WHERE id='$user_id'";
$nombre = $wish->conexion->query ( $query );


//Nombre del usuario1
$query="SELECT nombre FROM usuario WHERE id='$user_id'";
$nombre1 = $wish->conexion->query ( $query );



//Nombre del usuario2
$query="SELECT nombre FROM usuario WHERE id='$user_id'";
$nombre2 = $wish->conexion->query ( $query );



		?>	  
    
    
   

 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>                                             
                                                    <th>Actividad</th>                                                    
                                                    <th>Contrato</th>                                               
                                                    <th>Descripción</th> 
                                                    <th>Fecha inicio</th>
                                                    <th>Fecha fin</th> 
                                                    <th>Duración</th>                                            
                                                    <th>Editar</th>
                                                </tr>  
                                            </thead>
                                            <tbody>
                                                <?php      
    $consulta ="SELECT 
             r.id,
             a.categoria,
             a.actividad,
             a.plataforma,
             p.nombre as proyecto,
             r.descripcion,
             r.fecha_inicio,
             r.numerotiquete,
             r.fecha_fin,
             r.tiempo_calculado,
             r.tiempoReal,
             r.estado  

             FROM registro_actividad r,
                  actividad a,
                  new_proyectos p

             where a.id = r.id_actividad and 
                          r.user_id = $user_id
                      and r.id_contrato = p.codigo 
                     and MONTH(fecha_inicio) = MONTH(NOW())
                    order by  r.fecha_inicio desc
                    ";



    if($consulta = $wish->conexion->query($consulta))
    {
        while($obj = $consulta->fetch_object())

        {?>
                                                <tr>                                                
                                                    <td><?php printf($obj->actividad);?></td>
                                                    <td><?php printf($obj->proyecto);?></td>
                                                    <td><?php printf($obj->descripcion);?></td>
                                                    <td><?php printf($obj->fecha_inicio);?></td>
                                                    <td><?php printf($obj->fecha_fin);?></td>
                                                    <td><?php printf($obj->tiempoReal);?></td>                                              
                                                    <td><?php if($obj->estado != 'R'){ ?>
                                                        <a href="index.php?page=004&editar=<?php echo $obj->id ?>">
                                                            <?php } ?>
                                                            <input  type="image" src="dist/img/edit.svg"></a></td>   
                                                </tr> 
                                                <?php }
        $consulta->close();
    }?>         
                                            </tbody>                                        
                                        </table> 
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      
        