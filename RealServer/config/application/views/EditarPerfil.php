<!DOCTYPE html>
<html>
	<head>
		<title>Editar perfil</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/EstilosRegistrar/main.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>		
	</head>
	<body>
		<div class="limiter">
			<div class="container-login100">
				<div class="login100-more"></div>
				<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
					<form class="login100-form validate-form" id="forma" method="POST" action="<?php echo base_url()?>index.php/ControladorEditarPerfil/editarAcademico">
						<h2 class="login100-form-title p-b-59">
						Editar Perfil
						</h2>
						<div class="wrap-input100 validate-input">
							<span class="label-input100">Nombre</span>
							<input required class="input100" type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
							<span class="focus-input100"></span>
						</div>
						<div class="wrap-input100 validate-input">
							<span class="label-input100">Apellidos</span>
							<input required class="input100" type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>">
							<span class="focus-input100"></span>
						</div>						
						<div class="wrap-input100 validate-input">
							<span class="label-input100">Teléfono</span>
							<input required class="input100" type="number" name="telefono" id="telefono" value="<?php echo $telefono; ?>">
							<span class="focus-input100"></span>
						</div>
						<div class="wrap-input100 validate-input">
							<span class="label-input100">Contraseña</span>
							<input required class="input100" type="password" name="contrasena" id="contrasena" placeholder="*************">
							<span class="focus-input100"></span>
						</div>						
						<div class="container-login100-form-btn">
							<input type="submit" id="" class="login100-form-btn btnRegistrar" value="Registrar"></input>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>