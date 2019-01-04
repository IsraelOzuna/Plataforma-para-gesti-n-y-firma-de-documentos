$(function(){
	var base_url = window.location.origin;
	$("tr").click(function(){
		$("#receptorForm").val($(this).children().eq(0).text().trim());
		$("#modalMensaje").modal("show");
	});

	$("#botonEnviarMensaje").click(function(e){
	var receptor = $("#receptorForm").val();
	var mensaje = $("#mensajeForm").val();
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: base_url + "/RealServer/index.php/ControladorMensajes/enviarMensaje", 
			data: {
				'receptor': receptor,
				'mensaje': mensaje
			},
			success: function(response){
				alert("Mensaje Enviado");
				window.location.href = base_url + "/RealServer/index.php/ControladorMensajes/index";
			}
		});
	});


	$("#botonNuevoMensaje").click(function(e){
		e.preventDefault();
		$("#modalNuevoMensaje").modal("show");
	});


	$("#botonEnviarNuevoMensaje").click(function(e){
		var receptor = $("#correoForm").val();
		var mensaje = $("#nuevoMensajeForm").val();
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: base_url + "/RealServer/index.php/ControladorMensajes/enviarNuevoMensaje", 
			data: {
				'receptor': receptor,
				'mensaje': mensaje
			},
			success: function(response){
				if(response == "guardado"){
					alert("Mensaje Enviado");
					window.location.href = base_url + "/RealServer/index.php/ControladorMensajes/index";
				}else{
					alert("El correo no se encuentra registrado");	
				}
				
			}
		});



	});



});	