<!DOCTYPE html>
<html>
	<head>
		<title>Clave de confirmación</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css"/>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/comportamientoModal.js"></script>
		<script>var base_url='<?php echo base_url();?>'</script>		
	</head>
	<body>		
		<div class="modal fade" id="modalClave" role="dialog" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Completar Registro</h4>
					</div>
					<div class="modal-body">
						<form id="formulario" method="post" action="confirmarCorreo">
							<label for="text">Ingresa la clave:</label>
							<input type="text" class="form-control" id="claveConfirmacion" name="claveConfirmacion">
							<input type="submit" name="confirmar" value="Confirmar">
							<input type="submit" name="cancelar" value="Cancelar">
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>