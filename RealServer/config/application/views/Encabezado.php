<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/EstilosEncabezado/estiloMenuNav.css">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a href="<?php echo base_url()?>index.php/ControladorPaginaPrincipal/index"   class="navbar-brand">Gestor de documentos</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a href="<?php echo base_url()?>index.php/ControladorPaginaPrincipal/index" class="nav-link">Mis documentos</a>
					</li>
					<li class="nav-item active">
						<a href="<?php echo base_url()?>index.php/ControladorDocumentosCompartidos/index"" class="nav-link">Compartidos</a>
					</li>
					<li class="nav-item active">
						<a href="<?php echo base_url()?>index.php/ControladorEditor/index" class="nav-link" class="nav-link">Crear documento</a>
					</li>
					<li class="nav-item active">
						<a href="<?php echo base_url()?>index.php/ControladorEditarPerfil/index" class="nav-link"><?php echo $nombre; ?></a>
					</li>
					<li class="nav-item active">
						<a href="<?php echo base_url()?>index.php/ControladorMensajes/index" class="nav-link">Mensajes</a>
					</li>
					<li class="nav-item active">
						<a href="<?php echo base_url()?>index.php/ControladorIniciarSesion/cerrarSesion" class="nav-link">Salir</a>
					</li>
				</ul>
			</div>
		</nav>