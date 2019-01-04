<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css"/>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/comportamientoModalMensajes.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/EstilosPaginaPrincipal/estilos.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome-4.7.0/css/font-awesome.min.css">
		<title>Mensajes</title>
	</head>
	<body>
		<div class="container">
			<h2 class="text">Mis mensajes</h2>
			<table class="table table-hover">
				<thead class="thead-dark">
					<th width="30%">Académico</th>
					<th>Mensaje</th>
				</thead>
				<?php foreach ($mensajes as $mensaje): ?>
				<tr $emisor="<?php echo $mensaje['emisor']; ?>">
					<td>
						<?php echo $mensaje['emisor']; ?>
					</td>
					<td>
						<?php echo $mensaje['mensaje']; ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<form method="post">
				<div class="modal fade" id="modalMensaje" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Responder mensaje</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="text">Para:</label>
									<input type="text" class="form-control" id="receptorForm" name="receptorForm" disabled>
								</div>
								<div class="form-group">
									<label for="text">Mensaje:</label>
									<input type="text" class="form-control" id="mensajeForm" name="mensajeForm">
								</div>
								<div class="form-group">
									<input type="submit" name="enviarMensaje" id="botonEnviarMensaje" class="btn btn-primary"value="Enviar">
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<form method="post">
				<input type="submit" class="btnFlotante" name="nuevoMensaje" id="botonNuevoMensaje" value="+">
				<div class="modal fade" id="modalNuevoMensaje" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Nuevo Mensaje</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="text">Para:</label>
									<input type="email" class="form-control" id="correoForm" name="correoForm">
								</div>
								<div class="form-group">
									<label for="text">Mensaje:</label>
									<input type="text" class="form-control" id="nuevoMensajeForm" name="mensajeForm">
								</div>
								<div class="form-group">
									<input type="submit" name="enviarNuevoMensaje" id="botonEnviarNuevoMensaje" value="Enviar" class="btn btn-primary"> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>