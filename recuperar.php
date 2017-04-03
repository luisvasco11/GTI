<!DOCTYPE html>
<html>
<head>
<title>SISTEMA DE INFORMACIÓN GTI</title>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="dist/css/AdminLTE.css">
<link rel="shortcut icon" href="dist/img/favicon.ico">
</head>
<style>
body {
	background-image: url(dist/img/logo_bitacora.jpg);
	background-repeat: no-repeat;
}
</style>
<body>
<br>
<br>
<br>
<br>
<br>
<br>
	<div class="login-box">		
		<div class="login-box-body">
			<p class="login-box-msg">SISTEMA DE INFORMACIÓN GTI</p>
			
			<form method="post" action="pages/backend/recuperar_pass.php">
				<div class="form-group has-feedback">
					<input type="email" class="form-control" id="correo"
						value="@arus.com.co" name="correo"> <span
						class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="row">			
				
					<div class="col-sm-5 col-sm-offset-1">
						<button style="width: 100px; height: 40px" id="guardar"
							class="btn btn-primary" type="submit">Enviar</button>
					</div>

					<div class="col-sm-5">
						<a href="login.php"><button class="btn btn-default"
								style="width: 100px; height: 40px" type="button">Cancelar</button></a>
					</div>
				</div>
			</form>
		</div>		
	</div>

	<!-- jQuery 2.2.3 -->
	<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="bootstrap/js/bootstrap.min.js"></script>

	
</body>
</html>