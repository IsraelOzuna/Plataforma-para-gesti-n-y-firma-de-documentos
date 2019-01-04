
(function ($) {
    "use strict";

        var base_url = window.location.origin;
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.input-number').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});

    $('.validate-form').on('submit',function(e){
        e.preventDefault();
        var check = true;
        
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        if(check == true){
        
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
        

        return check;
    });

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


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    

})(jQuery);