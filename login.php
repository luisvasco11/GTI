<!DOCTYPE html>
<?php
session_start ();
if (isset($_SESSION['authenticated'])){
if ($_SESSION ['authenticated'] == 1) {
	header ( "Location: index.php" );
}}
?>
<html>
    <head>
        <title>SISTEMA DE INFORMACI�N GTI</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="dist/css/reset.css" type="text/css" rel="stylesheet" />
        <link href="dist/css/home.css" type="text/css" rel="stylesheet" />
        <link href="dist/css/input.css" type="text/css" rel="stylesheet" />
        <link rel="shortcut icon"  href="dist/img/favicon.ico">
    </head>
      <style>
   body {  background-image: url(dist/img/login-bg.jpg); 
        
       
       background-repeat: no-repeat;
       
        } 
    
    
    </style>
    <body>

        <header> 
			<div id="wrapper" style="overflow:hidden;">
				<img src="dist/img/unnamed.png" class="logo"/>
				

				<div id="wrapper" class="small" style="max-width:600px;">
					
					
				</div>
				
				
			</div>
			<div id="wrapper" class="big" style="max-width:600px;">
				
				
			</div>
        </header>
        <form class="form" style="max-width:400px;" action = "seguridad/login.php" method = "POST">
        
				<span class="title">Login</span>
                <p id="mensaje" style="color: red;"></p>
                <div class="group">      
                  <input type="email" id="correo"  value="@arus.com.co" name="correo" required>
                  <span class="highlight"></span>
                  <span class="bar"></span>                  
                </div>
				
                <div class="group">      
                  <input type="password" id="password" name="password" required>
                  
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Contraseña</label>
                   
                </div>
				
                
				
				<input id="envia" type="button" value="Ingresar" />
                
                
            <br>
             <a href="recuperar.php">Olvidaste la contraseña ?</a>
		</form>
		<!-- jQuery 2.2.3 -->
		<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
    
        <script src="dist/js/pages/operaciones.js"></script>
    
     <script>
            $( document ).ready(function() {
                

                

                $('#envia').click(function(){
                    var correo = $('#correo').val();
                    var password = $('#password').val();
                    console.log(correo);
                    console.log(password);
                    if(correo != '' && password != ''){

                        $.ajax({
                            url: 'seguridad/login.php',
                            method: 'POST',
                            data: {correo: correo, password: password},
                            success: function(msg){

                                if(msg=='1'){

                                    $("#envia").click(function (){
                                        $('#mensaje').html('DATOS INCORRECTOS');
                                    });
                                }else{
                                    window.location = msg;
                                }
                            }
                        });

                    }else{
                        $('#mensaje').html('INGRESE LOS DATOS');
                    }
                });
                
                $("input").keypress(function(event) { 
                    if (event.which == 13) { 
                        event.preventDefault(); 
                        $('#envia').click();
                    } 
                });

            });
         
         
        </script>
	
    </body>
</html>