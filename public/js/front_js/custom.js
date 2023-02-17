
(function($) { 

    $("#frmReserva").validate({

        event: "blur",
        rules: {
            'nombre': "required",
            'email': "required email",
            'telefono': "required",
        },
        messages: {
            'nombre': "Por favor ingrese su nombre.",
            'email': "Ingrese un e-mail válido.",
            'telefono': "Por favor ingrese teléfono.",
            /*'emailRep': "Error : los emails no coinciden.",*/
        },
        debug: true,
        errorElement: "label",
        submitHandler: function(form){

            var baseUrl = document.getElementById('baseUrl').value;

            //$('#conteOpcionesPago').hide();
            //$('#loadingOpcionesPago').fadeIn();
            //$('#loadingOpcionesPago').html('<div class="cssload-loading"><i></i><i></i><i></i><i></i></div><br><p style="text-align: center">Procesando el pago...</p><div id="cambioPago"></div>');
         
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                }
            })

            $.ajax({
                type: "POST",
                url: baseUrl+"/enviarReserva",
                contentType: "application/x-www-form-urlencoded",
                processData: true,
                dataType: "json",
                data: $("#frmReserva").serialize(),
                success: function() {

                    $(".mercadopago-button").trigger("click")   

                    //setTimeout('mostrarBotonCancelar()', 20000);
                  /*  
                    setTimeout(
                        function(){
                            $('#cambioPago').html('<button onclick="displayOpcionesPago()" id="botonCancelar" type="button" class="btn btn-success" style="width: 100%" > CANCELAR</button>');
                        },
                         20000);
                    */ 
                }
            });
        }
    }); 


    $("#frmContacto").validate({
        event: "blur",rules: {
            'nombre': "required",
            'email': "required email",
            'comentario': "required"
        },
        messages: {
            'nombre': "Por favor ingrese su nombre",
            'email': "Ingrese un e-mail válido",
            'comentario': "Por favor, ingrese sus comentarios"
        },
        debug: true,errorElement: "label",
        submitHandler: function(form){

    /*
            if (grecaptcha === undefined) {
                alert('Recaptcha not defined'); 
                return; 
            }

            var response = grecaptcha.getResponse();

            if (!response) {
                $("#mensaje_captcha").show();
                $("#mensaje_captcha").html("Por favor, marque la casilla...");

                //alert('Coud not get recaptcha response'); 
                return; 
            }    
    */
            var baseUrl = document.getElementById('baseUrl').value;

            $("#frmContacto").hide();
            $("#responseContacto").show();
            $("#responseContacto").html("<div style='text-align:center'><img class='loading-contact-logo' src='"+baseUrl+"/images/logo.png'><br><img class='loading-contact-loading' src='"+baseUrl+"/images/loading.gif'></div>");
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                }
            })
            $.ajax({

                url: baseUrl+"/enviarContacto",
                method: "post",
                data: $('#frmContacto').serialize(),
                success: function(msg){
                    $('#responseContacto').html(msg);
                }
            });
        }
    }); 

})(jQuery);