$(function(){
	 var base_url = window.location.origin;
	$(".btnRegistrar").click(function(e){ 
			alert("e: " + e);
			var prueba = confirm();
			alert("1: " + prueba);

		e.preventDefault();
		alert("2: " + e.preventDefault());
		var correo = $("#correo").val();
		var claveGenerada = Math.round(Math.random() * (10000 - 1000) + 1000);
		alert("3");
		var prueba =  $(".btnRegistrar").submit(); 
		alert("4: " + prueba);


		/*
		$.ajax({                   
			type: "POST",
			url: base_url + "/RealServer/index.php/ControladorRegistrar/enviarCorreo",                             
			data: {'correo': correo,                              
			'claveGenerada': claveGenerada
		},
		success: function(response){
		if(response == "yaRegistrado"){
			alert("El correo ya se encuentra registrado");
		}else{
			$("#modalRegistro").modal("show");
			$("#btnConfirmar").click(function(e){              
				if($("#claveConfirmacion").val() == claveGenerada){
					registrarAcademico();               
				}else{
					alert("La clave no coincide");
				}
			}); 
		}              
			                                   
		}
	});   */   
	});

	/*$(".btnRegistrar").click(function(e){							
		$("#formularioRegistrar").validate({
			rules: {
				nombre: {required:true, maxlength: 50},
				apellidos: {required:true, maxlength: 100},
				correo: {required:true, email: true},
				telefono: {required:true, maxlength: 10, pattern: "[0-9]{1,10}" },
				contrasena: {required:true}
			},
			messages: {
				nombre: "Campo obligatorio",
				apellidos: "Campo obligatorio",
				correo: "Campo obligatorio",
				telefono:"Campo obligatorio",
				contrasena: "Campo obligatorio",
			},
			invalidHandler: function(form){
				alert("Llenar todos los campos");
			},

			submitHandler: function(form){
				var correo = $("#correo").val();
				var claveGenerada = Math.round(Math.random() * (10000 - 1000) + 1000);
				$.ajax({   		 				
					type: "POST",
					url: base_url + "/RealServer/index.php/ControladorRegistrar/enviarCorreo",	   								
					data: {'correo': correo,										
					'claveGenerada': claveGenerada
				},
				success: function(response){      			  
					if(response == "yaRegistrado"){
						alert("El correo ya se encuentra registrado");
					}else{
						$("#modalRegistro").modal("show");
						$("#btnConfirmar").click(function(e){              
							if($("#claveConfirmacion").val() == claveGenerada){
								registrarAcademico();               
							}else{
								alert("La clave no coincide");
							}
						}); 
					}         			        		        		
				}
			});
			}
		});				
	});*/

	function registrarAcademico() {        
		var nombre = $("#nombre").val().trim();
		var apellidos = $("#apellidos").val().trim();
		var correo = $("#correo").val().trim();
		var telefono = $("#telefono").val().trim();
		var contrasena = $("#contrasena").val().trim();        

		$.ajax({
			type: "POST",
			url: base_url + "/RealServer/index.php/ControladorRegistrar/registrarAcademico",
			data: {'nombre': nombre,
			'apellidos': apellidos,
			'correo': correo,
			'telefono': telefono,
			'contrasena': contrasena
		},
		success: function(response){    
			if(response == "noRegistrado"){
				alert("Registro incorrecto, intente de nuevo");
				window.location.href = base_url + "/RealServer/index.php/ControladorRegistrar/index"; 
			}else{
				alert("Registro correctamente realizado");  
				window.location.href = base_url + "/RealServer/";  
			}	                          
		}
		});
	} 
});	