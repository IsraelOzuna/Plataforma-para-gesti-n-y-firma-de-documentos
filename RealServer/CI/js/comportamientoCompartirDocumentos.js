$(function(){
	 var base_url = window.location.origin;
		$('input#buscar').quicksearch('table tbody tr');

		$(".descargar").click(function(e){
			e.preventDefault();
			var nombreDocumento = $(this).parents("tr").find('td:first-child').text().trim();
			var correo = $(this).parents("tr").find('td:eq(2)').text().trim();
			$('#documentoDescargar').html(nombreDocumento);
			$('#correoDescargar').html(correo);
			$("#modalDescargar").modal("show");
		});


		$("#botonPDF").click(function(e){

			var nombreDocumento = $("#documentoDescargar").text();
			var correo = $("#correoDescargar").text().trim();
			correo = encodeURIComponent(btoa(correo));
			nombreDocumento = encodeURIComponent(btoa(nombreDocumento));
			window.open(base_url + '/RealServer/index.php/ControladorDocumentosCompartidos/descargarPDF/' + correo + '/' + nombreDocumento);

		});

		$("#botonWORD").click(function(e){
			var correo = $("#correoDescargar").text().trim();
			correo = encodeURIComponent(btoa(correo));
			var nombreDocumento = $("#documentoDescargar").text().trim();
			nombreDocumento = encodeURIComponent(btoa(nombreDocumento));
			window.open(base_url + '/RealServer/index.php/ControladorDocumentosCompartidos/descargarWord/' + correo + '/' + nombreDocumento);

		}); 

		$('.editar').click(function(){ 
			var nombreDocumento = $(this).parents("tr").find('td:first-child').text().trim();
			var correo = $(this).parents("tr").find('td:eq(2)').text().trim();
			correo = encodeURIComponent(btoa(correo));
			nombreDocumento = encodeURIComponent(btoa(nombreDocumento));
			window.location.href = base_url + '/RealServer/index.php/ControladorEditor/abrirDocumentoCompartido/' + correo + '/' + nombreDocumento;
		});
});	