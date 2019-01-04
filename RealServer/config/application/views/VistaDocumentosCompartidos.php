<!DOCTYPE html>
<html>
	<head>
		<title>Documentos compartidos</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/EstilosPaginaPrincipal/estilos.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.quicksearch.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/comportamientoCompartirDocumentos.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/download.js"></script>
	</head>
	<body>
		<div class="container">
			<h2 class="text">Documentos compartidos</h2>
			<div class="form-group">
				<div class="col-sm-10">
					<input type="text" class="form-control" id="buscar" name="buscar" placeholder="Busca un archivo">
				</div>
			</div>
			<table class="table table-hover">
				<thead class="thead-dark">
					<th>Nombre del archivo</th>
					<th>Autor</th>
					<th>Correo del Autor</th>
					<th>Tamaño</th>
					<th>Ultima modificación</th>
					<th>Acciones</th>
				</thead>
				<?php foreach ($listaDocumentosPropios as $documento):  ?>
				<tr>
					<td>
						<a target="_blank" href="<?php echo base_url();?>index.php/ControladorDocumentosCompartidos/abrirArchivo/<?php echo base64_encode($documento['idRemitente']) ;?>/<?php echo $documento['nombreArchivo'];?>"><?php echo $documento['nombreArchivo'];?></a>
					</td>
					<td>
						<?php echo $documento['autor'] ?>
					</td>
					<td>
						<?php echo $documento['correo'] ?>
					</td>
					<td>
						<?php echo $documento['tam'] ?>
					</td>
					<td>
						<?php echo $documento['modificado'] ?>
					</td>
					<td>
						<a href="#" class="descargar btn btn-sm btn-info">Descargar</a>
						<a href="#" class="editar btn btn-sm btn-secondary">Editar</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<form method="post">
			<div class="modal fade" id="modalDescargar" role="dialog" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Descargar documento</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Compartido por:</label>
								<label id="correoDescargar" name="correoDescargar"></label>
							</div>
							<div class="form-group">
								<label>Documento:</label>
								<label id="documentoDescargar" name="documentoDescargar"></label>
							</div>
							<div class="form-group">
								<a class="btn btn-large btn-danger center" href="#" id="botonPDF">
									<i class="fa fa-5x fa-file-pdf-o"></i>
								</a>
								<a class="btn btn-large btn-primary" href="#" id="botonWORD">
									<i class="fa fa-5x fa-file-word-o"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</body>
</html>