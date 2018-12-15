<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Editar Documento</title>		
		<script type="text/javascript" src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome-4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<style type="text/css">
			.div{
				display: block
			}

		</style>
	</head>
	<body>
		<h3></h3>
		<br>
		<br>
		<br>
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
	  				<label id="confirmacion" class="text-success">Cambios Guardados</label>
				</div>
			</div>
			<textarea name="editor" id="editor" cols="30" rows="10"><?php if(isset($contenido)){echo $contenido;}?></textarea>	
			<input type="button" name="guardar" id="guardar" value="Guardar">
		</form>
		
		
		<script>
			$(document).ready(function(){
				CKEDITOR.replace('editor');//CKEDITOR.instances.editor1.getData();
				if($("#nombreArchivo").val() === ""){
					$("#nombreArchivo").prop('disabled', false);
				}

				$("#confirmacion").hide();
				$("#guardar").click(function(e){	
					e.preventDefault();
					var nombreArchivo = $("#nombreArchivo").val();
					var nombreArchivoEditando = "";
					
					if(nombreArchivo == ""){
						alert("Es necesario poner un titulo al documento");
					}else{
						var contenido = CKEDITOR.instances.editor.getData();
						var estatusTitulo = $("#nombreArchivo").prop("disabled");
						$.ajax({   		 				
							type: $('#formEditor').attr('method'),
							url: $('#formEditor').attr('action'),
							data:{
								'nombreArchivo':nombreArchivo,
								'contenido':contenido,
								'estatusTitulo': estatusTitulo
							},
				    		success: function(response){
				    
				    			//var resultado = response.substring(12);	
				    			//alert(resultado);
				    			
				    			if(response == "true"){
				    				$("#confirmacion").show();
				    				$("#nombreArchivo").prop('disabled', true);
				    				setTimeout(function(){ $("#confirmacion").hide(); }, 2000);	
				    			}else if(response == "false"){
				    				alert('No fue posible guardar los cambios');
				    			}else{
				    				alert("Es necesario poner un titulo al documento");
				    			}
				    				    					        		        		
							}
						});	
					}

						
				});

				$("#editarNombre").click(function(){
					$("#nombreArchivo").prop('disabled', false);

				});
				
			});
			
			

			
		</script>
		
	</body>
</html>