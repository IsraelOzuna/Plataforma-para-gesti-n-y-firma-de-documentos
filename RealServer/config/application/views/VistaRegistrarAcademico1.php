<!DOCTYPE html>
<html>
	<head>
		<title>Nuevo registro</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/EstilosRegistrar/main.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/comportamientoRegistrarAcademico.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.form.js"></script>
	</head>
	<body>
		<div class="limiter">
			<div class="container-login100">
				<div class="login100-more"></div>
				<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
					<form class="login100-form validate-form" id="formularioRegistrar" method="post">
						<h2 class="login100-form-title p-b-59">
						Registrate
						</h2>
						<div class="wrap-input100 validate-input">
							<span class="label-input100">Nombre</span>
							<input required class="input100" type="text" name="nombre" id="nombre">
							<span class="focus-input100"></span>
						</div>
						<div class="wrap-input100 validate-input">
							<span class="label-input100">Apellidos</span>
							<input required class="input100" type="text" name="apellidos" id="apellidos">
							<span class="focus-input100"></span>
						</div>
						<div class="wrap-input100 validate-input">
							<span class="label-input100">Correo</span>
							<input required class="input100" type="email" name="correo" id="correo">
							<span class="focus-input100"></span>
						</div>
						<div class="wrap-input100 validate-input">
							<span class="label-input100 input-number">Teléfono</span>
							<input required class="input100" type="text" name="telefono" id="telefono">
							<span class="focus-input100"></span>
						</div>
						<div class="wrap-input100 validate-input">
							<span class="label-input100">Contraseña</span>
							<input required class="input100" type="password" name="contrasena" id="contrasena">
							<span class="focus-input100"></span>
						</div>
						<div class="container-login100-form-btn">
							<input type="submit" id="" class="login100-form-btn btnRegistrar" value="Registrar"></input>
						</div>
					</form>
					<form method="post">
						<div class="modal fade" id="modalRegistro" role="dialog" data-backdrop="static" data-keyboard="false">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Ingresa la clave</h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label for="text">Ingresa la clave:</label>
											<input required max="4" type="num" class="form-control" id="claveConfirmacion" name="claveConfirmacion">
										</div>
										<div class="form-group">
											<input class="btn btn-block btn-primary" type="submit" id="btnConfirmar" name="confirmar" value="Confirmar">
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</body>
</html>