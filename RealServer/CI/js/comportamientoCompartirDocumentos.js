$(function(){
	$(document).ready( function () {
   	$('input#buscar').quicksearch('table tbody tr');
           		
	  
      $('.nombre').click(function(){
        var listaDocumentos = JSON.parse(JSON.stringify(listaphp));
        var nombreArchivo = $(this).parents("tr").find('td:eq(1)').text().trim();
        var correo = $(this).parents("tr").find('td:eq(3)').text().trim();

         var idRemitente = "";
         for (var i = 0; i < listaDocumentos.length; i++) {
            //alert("i: " + i);

            if(listaDocumentos[i]['nombreArchivo'].trim() == nombreArchivo && listaDocumentos[i]['correo'].trim() == correo){
               idRemitente = listaDocumentos[i]['idRemitente'];
               break;
            }
         }  


          $.ajax({                   
                  type: "POST",
                  url: "http://localhost/RealServer/index.php/ControladorDocumentosCompartidos/abrirArchivo",                             
                  data: {'idRemitente': idRemitente,                              
                  'nombreArchivo': nombreArchivo
                  },
                  success: function(response){  
                        alert(response);        
                    // var blob=new Blob([response]);

                    /*var file = new Blob([response], {type: 'application/pdf'});
                     var fileURL = URL.createObjectURL(file);*/
                     window.open(response);             
                  }
               });                
      });
	});
});	