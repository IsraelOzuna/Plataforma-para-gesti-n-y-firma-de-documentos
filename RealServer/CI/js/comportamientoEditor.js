$(function(){
	
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
					alert("Si cambias el nombre del archivo se creará un nuevo documento con el contenido actual después de guardar los cambios");
					$("#nombreArchivo").prop('disabled', false);

				});
});