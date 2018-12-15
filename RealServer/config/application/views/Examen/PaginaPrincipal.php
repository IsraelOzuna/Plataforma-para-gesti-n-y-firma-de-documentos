<!DOCTYPE html>
<html>
	<head>
		<title>Página principal</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/main.js"></script>		
	</head>
	<body>
		<div class="container">
			<h2 class="text">Actas</h2>
			<div class="form-group">				
				<div class="col-sm-10">
					<input required type="text" class="form-control" name="buscador" placeholder="Busca un archivo">
				</div>
			</div>
			
			<table class="table table-striped table-bordered" id="tablaDocumentos">
				<thead class=thead-dark>
					<th scope="col">Nombre</th>
					<th scope="col">Fecha</th>
					<th scope="col">Tema</th>
					<th scope="col">Academia</th>
					<th scope="col">Validado</th>
				</thead>
				<?php foreach ($documentos as $documento): ?>
				<tr>
					<td>
						<a target="_blank" href="<?php echo base_url();?>archivos/<?php echo $documento['nombre'] .'.pdf' ?>"><?php echo $documento['nombre'];?></a>
					</td>
					<td>
						<?php echo $documento['fecha'];?>
					</td>
					<td>
						<?php echo $documento['tema'];?>
					</td>
					<td>
						<?php echo $documento['academia'];?>
					</td>
					<td>
						<input type="checkbox" name="valido">
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</body>
</html>