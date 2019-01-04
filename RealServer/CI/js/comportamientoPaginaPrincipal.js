$(function(){

  var base_url = window.location.origin;
  $('input#buscar').quicksearch('table tbody tr');

  $('.editar').click(function(){ 
      var nombreDocumento = $(this).parents("tr").find('td:first-child').text().trim();
      nombreDocumento = encodeURIComponent(btoa(nombreDocumento));
      window.location.href = base_url + "/RealServer/index.php/ControladorEditor/abrirDocumento/"+ nombreDocumento;
   });

   $(".btnFlotante").click(function(e){
      e.preventDefault();
      $.ajax({                      
         success: function(response){           
            $("#modalArchivo").modal("show");
         }
      });      
   });

   $(".firmar").click(function(e){
      e.preventDefault();
      $nombreArchivo = $(this).parents("tr").find('td:first-child').text().trim();
       $('#documentoFirmar').html($nombreArchivo);
      $.ajax({                      
         success: function(response){           
            $("#modalFirmar").modal("show");
         }
      });      
   });

   $("#botonFirmar").click(function(e){ 
      e.preventDefault();  
      var nombreDocumento = $("#documentoFirmar").text().trim();
      $.ajax({
        type: "POST",
         url: base_url + "/RealServer/index.php/ControladorPaginaPrincipal/firmarPDF",                             
         data: {'nombreArchivo': nombreDocumento
         },                      
         success: function(response){     
            if(response == "firmaExitosa"){
              alert("Firma exitosa");
              window.location.href = base_url + "/RealServer/index.php/ControladorPaginaPrincipal/index";
            }else{
              alert("Ocurrió un problema al firmar, intente de nuevo");
            }
         }
      });   
   }); 

 

   $("#botonCancelarFirma").click(function(e){
      e.preventDefault();
      $("#modalFirmar").modal("hide");
  
   }); 

   $(".btnCompartir").click(function(e){
      e.preventDefault();
       $nombreArchivo = $(this).parents("tr").find('td:first-child').text().trim();
       $('#nombreDocumento').html($nombreArchivo);
      $.ajax({                      
         success: function(response){           
            $("#modalCompartir").modal("show");
         }
      });   
   });         

   $(".btnCompartirModal").click(function(e){               
      e.preventDefault();
      var correo = $("#correo").val().trim();
      var nombreArchivo = $('#nombreDocumento').text().trim();
      $.ajax({                   
         type: "POST",
         url: base_url + "/RealServer/index.php/ControladorPaginaPrincipal/compartirArchivo",                             
         data: {'correo': correo,
         'nombreArchivo': nombreArchivo
         },
         success: function(response){
            alert(response);         
                                      
         }
      });      
   });   

   
   $(".descargar").click(function(e){
     e.preventDefault();
     var nombreDocumento = $(this).parents("tr").find('td:first-child').text().trim();
     $('#documentoDescargar').html(nombreDocumento);
     $("#modalDescargar").modal("show");
  });


   $("#botonPDF").click(function(e){
         var nombreDocumento = $("#documentoDescargar").text().trim();
         var tipoDocumento = encodeURIComponent(btoa('propio'));
         nombreDocumento = encodeURIComponent(btoa(nombreDocumento));
         window.open(base_url + '/RealServer/index.php/ControladorPaginaPrincipal/descargarPDF/' + nombreDocumento + '/' + tipoDocumento);

      });

   $("#botonWORD").click(function(e){

      var nombreDocumento = $("#documentoDescargar").text().trim();
      nombreDocumento = encodeURIComponent(btoa(nombreDocumento));
      window.open(base_url + '/RealServer/index.php/ControladorPaginaPrincipal/descargarWord/' + nombreDocumento);
    
 }); 

   $(".descargarCargado").click(function(e){
     e.preventDefault();
     var tipoDocumento = encodeURIComponent(btoa('cargado'));
     var nombreDocumento = $(this).parents("tr").find('td:first-child').text().trim();
     nombreDocumento = encodeURIComponent(btoa(nombreDocumento));
     window.open(base_url + '/RealServer/index.php/ControladorPaginaPrincipal/descargarPDF/' + nombreDocumento + '/' + tipoDocumento);
  });
});	