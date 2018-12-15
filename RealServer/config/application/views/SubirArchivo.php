<!DOCTYPE html>
<html>
	<head>
		<title>Subir archivo</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/main.js"></script>
	</head>
	<body>
		<div class="container">
			<h2>Nueva acta</h2>
			<form class="form-horizontal" action="<?php echo base_url()?>index.php/ControladorSubirArchivo/registrarArchivo" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="control-label col-sm-2">Nombre:</label>
					<div class="col-sm-10">
						<input required type="text" class="form-control" name="nombre" placeholder="Nombre del acta">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Tema:</label>
					<div class="col-sm-10">
						<input required type="text" class="form-control" name="tema" placeholder="Tema a tratar">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Fecha:</label>
					<div class="col-sm-10">
						<input required type="text" class="form-control" name="fecha" placeholder="Fecha">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Academia:</label>
					<div class="col-sm-10">
						<input required type="text" class="form-control" name="academia" placeholder="Academia"">
					</div>
				</div>				
				<div class="form-group">
					<label class="control-label col-sm-2">Archivo:</label>
					<div class="col-sm-10">
						<input required type="file" name="documento" id="documento" accept="application/pdf">
					</div>
				</div>
				<div class="form-group">					
					<div class="col-sm-10">
						<input type="submit" name="subir" value="Subir" class="btn btn-primary">
					</div>
				</div>
			</form>
		</div>
	</body>
</html>