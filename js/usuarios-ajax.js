$(document).ready(function() {

    //-- Para poner con login --
    $('#login-admin-form').on('submit', function(e) {
        e.preventDefault();
        var datos =  $(this).serializeArray();
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                var resultado = data;
                if(resultado.respuesta == 'exitoso') {
                    if(resultado.redir !== 0){
                        var redirect = resultado.redir;
                        Swal.fire(
                        '¡Login correcto!',
                        'Bienvenid@ '+resultado.usuario+'.',
                        'success').then(() => {
                                window.location.href= redirect;
                        })
                    } else {
                        Swal.fire(
                        '¡Login correcto!',
                        'Bienvenid@ '+resultado.usuario+'.',
                        'success').then(() => {
                                window.location.href= '../pages/main-sis.php';
                        })
                    }
                } else {
                    Swal.fire(
                        '¡Error!',
                        'Usuario o contraseña incorrectos.',
                        'error'
                        )
                }
            }
        })
    })

    // Mensaje de sitio solo administradores //
    /* var dir = window.location.href;
    if(dir.indexOf('login.php') > 0){
        swal.fire(
            '¡Atención!',
            'Este sitio es para uso exclusivo de administradores y desarrolladores del sistema SISCON®.',
            'warning'
        )
    } */

    // Guardar formularios //
    $('#save-forms').on('submit', function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();
        $.ajax({
            type : 'POST',
            data : datos,
            url : '../funciones/actions.php',
            success : function(data){
                console.log(data);
                var d = JSON.parse(data);
                console.log(d);
                if(d.respuesta == 'ok'){
                    swal.fire(
                        '¡Genial!',
                        'Datos guardados correctamente.',
                        'success'
                    ).then(()=>{
                        window.location.reload();
                    })
                } else {
                    swal.fire(
                        '¡Oh, no!',
                        'Error al guardar los datos.',
                        'error'
                    )
                }
            }
        })
    })

    // Realizar contrato
    $('#save-contract').on('submit', function(e){
        e.preventDefault();
        var subm = e.originalEvent.submitter.id;
        var datos = $(this).serializeArray();
        $('input[type=text], input[type=number], input[type=email]').attr('readonly', true);
        $('#plan_sel').attr('disabled', true);
        if(subm == 'cobrar'){
            $.ajax({
                type : 'POST',
                data : datos,
                url : '../funciones/actions.php',
                success : function(data){
                    var d = JSON.parse(data);
                    if(d.respuesta == 'ok'){
                        var id = d.id;
                        var tel = d.tel;
                        var url = 'https://app.sisconsystem.online/procesador-pago.php?id='+id+'&response_paym=0';
                        swal.fire({
                            title: '¿Vas a cobrar desde este dispositivo?',
                            showCancelButton: true,
                            confirmButtonText: 'Si, desde aquí',
                            cancelButtonText: 'No, compartir link'
                        }).then((result) => {
                            if(result.value){
                                window.open(url, '_blank');
                            } else {
                                var text = "*Siscon system* te envía este link de pago para comenzar a utilizar tu plan: ";
                                var message = encodeURIComponent(text) + " " + encodeURIComponent(url);
                                var whatsapp_url = "whatsapp://send?text="+message+"&phone=+54"+tel+"&abid=+54"+tel;
                                window.location.href = whatsapp_url;
                            }
                        })
                    } else {
                        swal.fire(
                            '¡Oh, no!',
                            'Ha ocurrido un error al intentar cargar los datos para la cobranza.',
                            'error'
                        )
                    }
                }
            })            
        } else if(subm == 'crearBD'){
            /* window.open("http://siscon-system.com/cpanel");
            swal.fire({
                text: '¿Creaste la BD?',
                allowOutsideClick: false,
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
                showCancelButton: true,
            }).then((result) => {
                if(result.value){ */
                    Swal.fire({
                        html: '<strong>Realizando acciones de alta de contrato</strong><br><br><strong><span id="chtxtpopup">Paso 1 de 3</span></strong><br><small id="smallpopup" style="font-size: 1.2rem;">Insertando datos de empresa y usuario en la BD</small>',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        },
                    });

                    // Generamos el primer paso Business y Usuario
                    $.ajax({
                        type: 'POST',
                        data: datos,
                        url: '../funciones/create_bd.php',
                        // dataType: 'json',
                        success: function(data){
                            console.log(data);
                            let d = JSON.parse(data);
                            console.log(d);
                            if(d.respuesta == 'ok'){
                                $('#swal2-content #chtxtpopup').html('Paso 2 de 3');
                                $('#swal2-content #smallpopup').html('Creando base de datos');
                                var bd = d.bd;
                                var mail = d.mail;
                                var name = d.name;
                                var id = d.id;
                                var user = d.user;
                                $.ajax({
                                    type: 'POST',
                                    data: {
                                        'bd' : bd,
                                        'action' : 'create-crud'
                                    },
                                    url: '../funciones/create_bd.php',
                                    success: function(data){
                                        console.log(data);
                                        var d = JSON.parse(data);
                                        if(d.respuesta == 'finish'){
                                            $('#swal2-content #chtxtpopup').html('Paso 3 de 3');
                                            $('#swal2-content #smallpopup').html('Enviando correo electrónico');     
                                            $.ajax({
                                                type: 'post',
                                                data: {
                                                    'name' : name,
                                                    'email' : mail,
                                                    'user' : user,
                                                    'id' : id,
                                                    'accion' : 'mail-alta-contrato'
                                                },
                                                url: '../funciones/model.php',
                                                dataType: 'json',
                                                success: function(d){
                                                    console.log(d);
                                                    if(d.respuesta == 'ok'){
                                                        swal.fire(
                                                            'Excelente!',
                                                            'Se han completado todos los pasos correctamente. Puede continuar con el COBRO.',
                                                            'success'
                                                        )
                                                    } else {
                                                        swal.fire(
                                                            'Error',
                                                            'Ha ocurrido un error al enviar el correo electrónico.',
                                                            'error'
                                                        );
                                                    }
                                                }
                                            })                                         
                                        } else if(d.respuesta == 'error') {
                                            clearInterval(enviarInfo);
                                            var step = d.step;
                                            swal.fire(
                                                'Error',
                                                'Ha ocurrido un error al crear TyD en el paso '+step+', intente nuevamente.',
                                                'error'
                                            );
                                        }
                                    }
                                });
                            } else {
                                swal.fire(
                                    'Error',
                                    'Ha ocurrido un error al crear BU, intente nuevamente.',
                                    'error'
                                );
                            }
                        }
                    });
                /* } else {
                    $('input[type=text], input[type=number], input[type=email]').attr('readonly', false);
                    $('#plan_sel').attr('disabled', false);
                }
            }) */
        } else if(subm == 'guardar') {
            var user = $('#usuario').val();
            $.ajax({
                type: 'post',
                data: {
                    'usuario' : user,
                    'action' : 'dar-prueba'
                },
                url: '../funciones/actions.php',
                dataType: 'json',
                success: function(d){
                    console.log(d);
                    if(d.respuesta == 'ok'){
                        swal.fire(
                            'Correcto',
                            'Se otorgaron los 15 días de prueba gratuitos.',
                            'success'
                        )
                    } else {
                        swal.fire(
                            'Error',
                            'Ha surgido un error al GUARDAR DATOS.',
                            'error'
                        )
                    }
                }
            })
        }
    })

    $('#sabe-contract').on('reset', function(){
        $('input[type=text], input[type=number], input[type=email]').attr('readonly', false);
        $('#plan_sel').attr('disabled', false);
    })

    // Cambio de precios al seleccionar en contrato de plan
    $('#plan_sel').on('select2:select', function(){
        var plan = $(this).select2('val');
        $.ajax({
            type: 'post',
            data: {
                'plan' : plan,
                'action' : 'precio-plan'
            },
            url: '../funciones/actions.php',
            dataType: 'json',
            success: function(data){
                var pr = data.precio;
                $('#price-plan').html(pr);
            }
        })
    })
    
    // Enviar correos no enviados
    $(document).on('click', 'a.send-mail', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        Swal.fire({
            text: 'Enviando mail, espere por favor...',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading()
            },
        })
        $.ajax({
            type: 'POST',
            data: {
                'id' : id,
                'action' : 'enviar-mail'
            },
            url: '../funciones/actions.php',
            success: function(data){
                var d = JSON.parse(data);
                if(d.respuesta == 'ok'){
                    var mail = d.mail;
                    jQuery('[data-id="'+id+'"]').attr('disabled', true);
                    jQuery('[data-id="'+id+'"]').removeClass('send-mail');
                    jQuery('[data-id="'+id+'"]').parents('tr').remove();
                    swal.fire({
                        title : 'Mensaje enviado',
                        html : 'El correo se envió correctamente a '+mail+'.',
                        icon : 'success'
                    })
                } else {
                    swal.fire(
                        'Error',
                        'Ha ocurrido un error al enviar el correo, intente nuevamente.',
                        'error'
                    )
                }
            }
        })
    })

    // Generar Tables y Data BD
    $(document).on('click', 'a.make-crud', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var bd = $(this).closest('tr').find('td').eq(9).children('input.name-bd').val();
        if(bd === ''){
            swal.fire(
                'Atención',
                'Se debe confirmar un nombre de base de datos antes de llevar a cabo la acción Create CRUD.',
                'warning'
            );
        } else {
            Swal.fire({
                text: 'Guardando información en la BD...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                },
            });

            // Generamos el primer paso Business y Usuario
            $.ajax({
                type: 'POST',
                data: {
                    'id' : id,
                    'bd' : bd,
                    'action' : 'create-bu'
                },
                url: '../funciones/create_bd.php',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    if(data.respuesta == 'ok'){
                        Swal.fire({
                            text: 'Generando las tablas y los datos de la nueva BD...',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading();
                            },
                        });
                        var user = data.user;
                        var name = data.name;
                        var system = data.system;
                        var mail = data.mail;

                        // Comienza loop de carga de partes BD
                        var i = 0;
                        let enviarInfo = setInterval(function() {
                            if(i == 38){
                                clearInterval(enviarInfo);
                            }
                            $.ajax({
                                type: 'POST',
                                data: {
                                    'nstep' : i,
                                    'bd' : bd,
                                    'action' : 'create-crud'
                                },
                                url: '../funciones/create_bd.php',
                                success: function(data){
                                    var d = JSON.parse(data);
                                    console.log(d);
                                    if(d.respuesta == 'finish'){
                                        Swal.fire({
                                            text: 'Enviando mail con usuario...',
                                            allowOutsideClick: false,
                                            showConfirmButton: false,
                                            willOpen: () => {
                                                Swal.showLoading();
                                            },
                                        });
                                        
                                        // Envío del correo con info usuario
                                        $.ajax({
                                            type: 'POST',
                                            data: {
                                                'name' : name,
                                                'user' : user,
                                                'email' : mail,
                                                'sistema' : system,
                                                'accion' : 'mailer-user'
                                            },
                                            url: '../funciones/model.php',
                                            success: function(d){
                                                console.log(d);
                                                var data = JSON.parse(d);
                                                if(data.respuesta == 'ok'){
                                                    swal.fire(
                                                        '¡Joya!',
                                                        'Se concretó la creación de toda la información en la BD y se envió el correo con info usuario.',
                                                        'success'
                                                    ).then(()=>{
                                                        window.location.reload();
                                                    });
                                                } else {
                                                    swal.fire(
                                                        'Oh, no...',
                                                        'Se ha producido un error al crear la base de datos. Vamos a recargar el sitio.',
                                                        'error'
                                                    ).then(()=>{
                                                        window.location.reload();
                                                    });
                                                }
                                            }
                                        });
                                        
                                    } else if(d.respuesta == 'error') {
                                        var step = d.step;
                                        swal.fire(
                                            'Error',
                                            'Ha ocurrido un error al crear TyD en el paso '+step+', intente nuevamente.',
                                            'error'
                                        );
                                    }
                                }
                            });
                            i = i+1;
                        }, 5000);
                            
                    } else {
                        swal.fire(
                            'Error',
                            'Ha ocurrido un error al crear BU, intente nuevamente.',
                            'error'
                        );
                    }
                }
            }); 
        }
    });

    // Validación repetición de contraseña
    $(document).on('input', '#password-rep', function() {
        var password_nuevo = $('#password').val();
        if($(this).val() == "") {
          $('#password-rep').parents('.form-group').removeClass('has-error has-success');
          $('#password').parents('.form-group').removeClass('has-error has-success');
          $('#resultado_password').text("");
        } else {
          if($(this).val() == password_nuevo) {
            $('#resultado_password').text('¡Correcto!');
            $('#resultado_password').addClass('text-green').removeClass('text-red');
            $('#password-rep').parents('.form-group').addClass('has-success').removeClass('has-error');
            $('#password').parents('.form-group').addClass('has-success').removeClass('has-error');
            $('#btn-submit').attr('disabled', false);
          } else {
            $('#resultado_password').text('¡Las contraseñas no coinciden!');
            $('#resultado_password').addClass('text-red').removeClass('text-green');
            $('#password-rep').parents('.form-group').addClass('has-error').removeClass('has-success');
            $('#password').parents('.form-group').addClass('has-error').removeClass('has-success');
            $('#btn-submit').attr('disabled', true);
          }
        }
    })

    $(document).on('focus', '#password', function(){
        $('#password-rep').val("");
        $('#password-rep').parents('.form-group').addClass('has-success').removeClass('has-error has-success');
        $('#password').parents('.form-group').addClass('has-success').removeClass('has-error has-success');
        $('#resultado_password').text("");
    })

    $('#usuario').blur(function(){
        var user = $(this).val();
        var dir = '../funciones/actions.php';
        if(user !== ''){
            $.ajax({
                type: 'post',
                data: {
                    'user': user,
                    'action': 'comp-user'
                },
                url: dir,
                dataType: 'json',
                success: function(d){
                    if(d.respuesta == 'no'){
                        swal.fire({
                            title: 'Existe el usuario ingresado',
                            html: '¿Deseas cargar los datos existentes del usuario?',
                            showCancelButton: true,
                            cancelButtonText: 'No',
                            confirmButtonText: 'Si'
                        }).then((result) => {
                            if(result.value){
                                $.ajax({
                                    type: 'post',
                                    data: {
                                        'user' : user,
                                        'action' : 'cargar-user'
                                    },
                                    url: dir,
                                    dataType: 'json',
                                    success: function(d){
                                        if(d.respuesta == 'ok'){
                                            console.log(d);
                                            var razon = d.razon;
                                            var name = d.name;
                                            var tel = d.tel;
                                            var mail = d.mail;
                                            var bd = d.bd;
                                            var cuit = d.cuit;
                                            var address = d.address;
                                            var sistema = d.sistema.toString();
                                            var price = d.price;
                                            $('#razon-social').val(razon);
                                            $('#nombre').val(name);
                                            $('#cuit').val(cuit);
                                            $('#telefono').val(tel);
                                            $('#direccion').val(address);
                                            $('#email').val(mail);
                                            $('#plan_sel').select2('val', sistema);
                                            $('#usuario').val(user);
                                            $('#name-bd').val(bd);
                                            $('#price-plan').html(price);
                                        }
                                    }
                                })
                            } else {
                                $('#usuario').val('');
                            }
                        })
                    }
                }
            })
        }
    })

// Cierre del Document.ready
})