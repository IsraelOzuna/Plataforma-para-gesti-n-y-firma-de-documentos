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
			</br>
			</br>
			</br>
				<h2 class="text">Documentos compartidos</h2>
				<div class="form-group">
					<div class="col-sm-10">
						<input type="text" class="form-control" id="buscar" name="buscar" placeholder="Busca un archivo">
					</div>
				</div>
					<table class="table table-hover">
						<thead class="thead-dark">
							<th>idRemitente</th>
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
								<?php echo $documento['idRemitente'] ?>
							</td>
							<td>
								<a class="nombre" target="" href="#"><?php echo $documento['nombreArchivo'];?></a>				
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
								<a href="#" class="btn btn-sm btn-info">Descargar</a>
								<a id="editar" class="btn btn-sm btn-secondary">Editar</a>					
								<a href="#" class="btn btn-sm btn-primary">Firmar</a>
							</td>

						</tr>
					<?php endforeach; ?>
					</table>
			</div>

		</div>
		
	</body>
</html>

