$(function(){
	var base_url = window.location.origin;
	$(".btnRecuperarContrasena").click(function(e){
		e.preventDefault();
		$.ajax({    		   			
			success: function(response){    			
				$("#modalRecuperarContrasena").modal("show");
			}
		});		
	});	 

	$(".btnRecuperar").click(function(e){					
		e.preventDefault();
		var correo = $("#correoRecuperar").val().trim();

		if(correo != ''){
			var caracteresPosibles = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			var nuevaContrasena = "";

			for (var i = 0; i < 10; i++)
				nuevaContrasena += caracteresPosibles.charAt(Math.floor(Math.random() * caracteresPosibles.length));		

			$.ajax({   		 				
				type: "POST",
				url: base_url + "/RealServer/index.php/ControladorIniciarSesion/enviarCorreo",	   								
				data: {'correo': correo,										
					'nuevaContrasena': nuevaContrasena
				},
				success: function(response){ 
					if(response =="correoNoExiste"){
						alert("El correo no está registrado");
					}else{
						alert("Contraseña de recuperación enviada por correo");
						window.location.href = base_url + "/RealServer/"; 
					}			 			    			  			        		        		
				}
			});	
		}else{
			alert('Ingresa tu correo');
		}	
	});	
});