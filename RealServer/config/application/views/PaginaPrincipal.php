<!DOCTYPE html>
<html>
	<head>
		<title>Página principal</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/EstilosPaginaPrincipal/estilos.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.quicksearch.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/comportamientoPaginaPrincipal.js"></script>
	</head>
	<body>
		<div class="limiter">
			<form method="post" enctype="multipart/form-data" action="<?php echo base_url()?>index.php/ControladorPaginaPrincipal/registrarArchivo">
				<div class="modal fade" id="modalArchivo" role="dialog" data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Subir documento</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="formulario">
									<div class="form-group">
										<input required type="file" name="documento" accept="application/pdf, application/msword, .docx, .doc">
									</div>
									<div class="form-group">
										<input class="btn btn-block btn-primary" type="submit" name="subir" value="Subir">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</form>

			<div class="modal fade" id="modalCompartir" role="dialog" data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Compartir documento</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="formulario">
									<label>Documento:</label>
									<label id="nombreDocumento" name="nombreDocumento"></label>
									<div class="form-group validate-input">
										<input required class="form-control" type="email" placeholder="Ingresa el correo destinatario" name="correo" id="correo">
									</div>
									<div>
										<input class="btnCompartirModal btn btn-block btn-primary" type="submit" name="compartir" value="Compartir">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			<div class="container">
			</br>
			</br>
			</br>
				<h2 class="text">Mis documentos</h2>
				<div class="form-group">
					<div class="col-sm-10">
						<input type="text" class="form-control" id="buscar" name="buscar" placeholder="Busca un archivo">
					</div>
				</div>
				
				
				
					<table class="table table-hover">
						<thead class="thead-dark">
							<th>Nombre del archivo</th>
							<th>Tamaño</th>
							<th>Ultima modificación</th>
							<th>Ext</th>
							<th>Acciones</th>
						</thead>
						<?php foreach ($listaArchivos as $item):  ?>
						<tr>
							<td>
								<a target="_blank" href="<?php echo base_url();?>index.php/ControladorPaginaPrincipal/abrirArchivo/<?php echo $item['Nombre'];?>"><?php echo $item['Nombre'];?></a>				
							</td>
							<td>
								<?php echo $item['Tam'] ?>
							</td>
							<td>
								<?php echo $item['Modificado'] ?>
							</td>
							<td>
								<?php echo $item['Extension'] ?>
							</td>
							<td>
								<a href="#" class="btn btn-sm btn-info">Descargar</a>
								<a id="editar" class="btn btn-sm btn-secondary">Editar</a>					
								<a href="#" class="btn btn-sm btn-primary">Firmar</a>
								<a href="#" class="btnCompartir btn btn-sm btn-info">Compartir</a>
							</td>

						</tr>
					<?php endforeach; ?>
					</table>
			</div>
			<form>
				<button class="btnFlotante">+</button>
			</form>
		</div>
		
	</body>
</html>

