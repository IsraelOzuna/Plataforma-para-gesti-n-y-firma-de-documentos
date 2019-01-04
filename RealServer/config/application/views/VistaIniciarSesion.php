<!DOCTYPE html>
<html>
	<head>
		<title>Iniciar sesión</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/EstilosIniciarSesion/main.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/main.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/comportamientoRecuperarContrasena.js"></script>
	</head>
	<body>
		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100">
					<div class="login100-form-title">
						<h1 class="login100-form-title-1">
						Inicia sesión
						</h1>
					</div>
					<form class="login100-form validate-form" method="post" action="<?php echo base_url()?>index.php/ControladorIniciarSesion/iniciar">
						<div class="wrap-input100 validate-input m-b-26">
							<span class="label-input100">Correo</span>
							<input class="input100" type="email"  name="correo" id="correo" placeholder="Ingresa tu correo" required="true">
							<span class="focus-input100"></span>
						</div>
						<div class="wrap-input100 validate-input m-b-18">
							<span class="label-input100">Contraseña</span>
							<input class="input100" type="password" name="contrasena" id="contrasena" placeholder="Ingresa tu contraseña" required="true">
							<span class="focus-input100"></span>
						</div>
						<div class="linkContrasena">
							<a href="#" class="btnRecuperarContrasena txt1">¿Olvidaste tu contraseña?</a>
						</div>
						<div class="container-login100-form-btn">
							<input type="submit" class="login100-form-btn" value="Ingresar"></input>
						</div>
						<div class="linkRegistro">
							<a href="<?php echo base_url()?>index.php/ControladorRegistrar/index" class="txt1">
								Registrate aquí
							</a>
						</div>
					</form>
				</div>
			</div>
			<form method="post">
				<div class="modal fade" id="modalRecuperarContrasena" role="dialog" data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Recupera tu Contraseña</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<input required type="email" placeholder="Ingresa tu correo" name="correo" class="form-control" id="correoRecuperar">
								</div>
								<div class="form-group">
									<input class="btn btn-block btn-primary btnRecuperar" type="submit" name="recuperarContrasena" id="recuperarContrasena" value="Recuperar contraseña">
								</div>				
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>