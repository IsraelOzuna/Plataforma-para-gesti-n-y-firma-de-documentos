<!DOCTYPE html>
<html>
<head>
 		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css"/>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>     
   		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/comportamientoModalMensajes.js"></script>

	<title></title>
</head>
<body>
	<br>
	<br>
	<br>
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

	<div class="modal fade" id="modalMensaje" role="dialog">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
				    <h4 class="modal-title">Responder mensaje</h4>
				</div>
				    <div class="modal-body">
				        <form id="formulario" >
				        	<label for="text">Para:</label>
	    					<input type="text" class="form-control" id="receptorForm" name="receptorForm" disabled>
	    					<label for="text">Mensaje:</label>
	    					<input type="text" class="form-control" id="mensajeForm" name="mensajeForm">
						    <input type="submit" name="enviarMensaje" id="botonEnviarMensaje" value="Enviar">
				        </form>
				    </div> 
    		</div>
    	</div>
   	</div>


	 <input type="submit" name="nuevoMensaje" id="botonNuevoMensaje" value="Nuevo mensaje">
	 

		<div class="modal fade" id="modalNuevoMensaje" role="dialog">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
				    <h4 class="modal-title">Nuevo Mensaje</h4>
				</div>
				    <div class="modal-body">
				        <form id="formulario" >
						<label for="text">Para:</label>
	    					<input type="email" class="form-control" id="correoForm" name="correoForm">
	    					<label for="text">Mensaje:</label>
	    					<input type="text" class="form-control" id="nuevoMensajeForm" name="mensajeForm">
						    <input type="submit" name="enviarNuevoMensaje" id="botonEnviarNuevoMensaje" value="Enviar">
				        </form>
				    </div> 
    		</div>
    	</div>
   	</div>


</body>
</html>