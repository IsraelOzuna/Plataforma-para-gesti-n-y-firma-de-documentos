<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Editar Documento</title>
		<script type="text/javascript" src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome-4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/comportamientoEditor.js"></script>
	</head>
	<body>
		<div class="container">
			<h2 class="text"><?php if(isset($nombreArchivo)){echo "Editar Documento";}else{echo "Crear Documento";}?></h2>
			<form id="formEditor" action="<?php echo base_url()?>index.php/ControladorEditor/guardarDocumento" method="post" enctype="multipart/form-data">
				<div class="form-row">
					<div class="form-group col-md-1">
						<label>Documento:</label>
					</div>
					<div class="form-group col-md-4">
						<input type="text" class="form-control" size="30" name="nombreArchivo" id="nombreArchivo" disabled="true" placeholder="Nombre del archivo" value="<?php if(isset($nombreArchivo)){echo $nombreArchivo;}?>">
					</div>
					<div class="form-group col-md-4">
						<a class="btn btn-large btn-primary" href="#" id="editarNombre">
						<i class="fa fa-edit"></i></a>
						<a class="btn btn-large btn-primary" href="#" id="guardar" name="guardar">
						<i class="fa fa-save"></i></a>
						<label id="confirmacion" class="text-success">Cambios Guardados</label>
					</div>
				</div>
				<textarea name="editor" id="editor" cols="30" rows="10"><?php if(isset($contenido)){echo $contenido;}?></textarea>
			</form>
		</div>
	</body>
</html>