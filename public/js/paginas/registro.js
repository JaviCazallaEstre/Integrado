$(function(){
    debugger
    
    $("form[name='registration_form']").validate({
        rules:{
            'registration_form[email]':{
                required: true,
                email:true,
            },
            'registration_form[nombre]':{
                required: true,
                lettersonly:true
            },
            'registrarion_form[apellidos]':{
                required: true,
                lettersonly:true
            },
            'registration_form[plainPassword][first]':{
                required: true
            },
            'registration_form[plainPassword][second]':{
                required: true,
                equalTo: "registration_form[plainPassword][first]"
            },
            'registration_form[agreeTerms]':{
                required: true
            },
            'registration_form[tipoVia]':{
                required: true
            },
            'registration_form[nombreVia]':{
                required: true,
                lettersonly: true
            },
            'registration_form[numeroVia]':{
                required: true,
                digits:true,
                maxLength:3
            },
            'registration_form[piso]':{
                required: false,
                digits:true,
                maxLength:3
            },
            'registration_form[puerta]':{
                required: false,
                maxLength:2
            },
            'registration_form[bloque]':{
                required: false,
                maxLength:1
            },
            'registration_form[codigoPostal]':{
                required: true,
                minLength:5,
                digits:true,
                maxLength:5
            },
            'registration_form[localidad]':{
                required:true
            }
        },
        messages :{
            'registration_form[email]':{
                required: "El campo de correo electrónico debe de estar relleno",
                email: "El correo electrónico introducido no es válido debe de ser de este estilo: ejemplo@dominio.com"
            },
            'registration_form[nombre]':{
                required: "El campo de nombre debe de estar relleno",
                lettersonly:"El campo de nombre no puede contener números"
            },
            'registrarion_form[apellidos]':{
                required: "El campo de apellidos debe de estar relleno",
                lettersonly:"El campo de apellidos no puede contener números"
            },
            'registration_form[plainPassword][first]':{
                required: "El campo de contraseña debe de estar relleno"
            },
            'registration_form[plainPassword][second]':{
                required: "El campo de repite contraseña debe de estar relleno",
                equalTo: "Las contraseñas no coinciden"
            },
            'registration_form[agreeTerms]':{
                required: "Debes de aceptar los términos"
            },
            'registration_form[tipoVia]':{
                required: "Debes de elegir una de las opciones disponibles"
            },
            'registration_form[nombreVia]':{
                required: "El campo de nombre vía debe de estar relleno",
                lettersonly:"El campo de nombre vía no puede llevar números"
            },
            'registration_form[numeroVia]':{
                required: "El número de via debe de estar relleno",
                digits: "Este campo solo admite números",
                maxLength: "La longitud máxima del campo número vía es de 3 dígitos"
            },
            'registration_form[piso]':{
                digits:"Este campo solo acepta números",
                maxLength:"La longitud máxima del campo piso es de 3 dígitos"
            },
            'registration_form[puerta]':{
                maxLength:"La longitud máxima del campo puerta es de 2"
            },
            'registration_form[bloque]':{
                maxLength:"La longitud máxima del campo bloque es de 1"
            },
            'registration_form[codigoPostal]':{
                required: "El campo de código postal debe de estar relleno",
                minLength:"La longitud mínima del código postal es de 5",
                digits:"El campo de código postal solo admite números",
                maxLength:"La longitud máxima del código postal es de 5"
            },
            'registration_form[localidad]':{
                required:"Debes de elegir una localidad"
            }
        }
    })
    $("form[name='registration_form']").on('blur', function() {
        if ($("form[name='registration_form']").valid()) {
            $('#registration_form_save').prop('disabled', false);  
        } else {
            $('registration_form[save]').prop('disabled', 'disabled');
        }
    });
    
})