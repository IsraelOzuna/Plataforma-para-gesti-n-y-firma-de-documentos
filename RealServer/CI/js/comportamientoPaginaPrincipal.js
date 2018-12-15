$(function(){
  $('input#buscar').quicksearch('table tbody tr');


  $('#editar').click(function(){
   var children = $(this).children().eq(0).text();
   window.location.href = "<?php echo base_url();?>index.php/ControladorEditor/abrirDocumento/"+ children;

   });
      				 //Es para seleccionar una fila de la tabla y obtener los datos
      				 /*$("tr").click(function(){
      				 	var children = $(this).children().eq(1).text();
      				 	window.location.href = "<?php //echo base_url();?>index.php/ControladorEditor/abrirDocumento/" + children;

      				 });*/


   $(".btnFlotante").click(function(e){
      e.preventDefault();
      $.ajax({                      
         success: function(response){           
            $("#modalArchivo").modal("show");
         }
      });      
   });

   $(".btnCompartir").click(function(e){
      e.preventDefault();

    
       $nombreArchivo = $(this).parents("tr").find('td:first-child').text().trim();
       $('#nombreDocumento').html($nombreArchivo);
          console.log($nombreArchivo);
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
         url: "http://localhost/RealServer/index.php/ControladorPaginaPrincipal/compartirArchivo",                             
         data: {'correo': correo,
         'nombreArchivo': nombreArchivo
         },
         success: function(response){
            alert(response);         
                                      
         }
      });      
   });   

   $(".btnRegistrar").click(function(e){              
      e.preventDefault();
      var correo = $("#correo").val();
      var claveGenerada = Math.round(Math.random() * (10000 - 1000) + 1000);
      $.ajax({                   
         type: "POST",
         url: "http://localhost/RealServer/index.php/ControladorRegistrar/enviarCorreo",                             
         data: {'correo': correo,                              
               'claveGenerada': claveGenerada
         },
         success: function(response){              
            $("#modalRegistro").modal("show");
            $("#btnConfirmar").click(function(e){              
               if($("#claveConfirmacion").val() == claveGenerada){
                  registrarAcademico();               
               }else{
                  alert("La clave no coincide");
               }
            });                                    
         }
      });      
   });

   

   function registrarAcademico() {        
      var nombre = $("#nombre").val();
      var apellidos = $("#apellidos").val();
      var correo = $("#correo").val();
      var telefono = $("#telefono").val();
      var contrasena = $("#contrasena").val();        
      
      $.ajax({
         type: "POST",
         url: "http://localhost/RealServer/index.php/ControladorRegistrar/registrarAcademico",
         data: {'nombre': nombre,
               'apellidos': apellidos,
               'correo': correo,
               'telefono': telefono,
               'contrasena': contrasena
            },
            success: function(response){                          
               alert("Registro correctamente realizado");  
               window.location.href = "http://localhost/RealServer/"                            
            }
        });
   }  
});	