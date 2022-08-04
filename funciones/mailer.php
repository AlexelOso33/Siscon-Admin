<?php function templateRecepcionDatos($destinatario, $sistema){
    
    $html = '<html>
        <head>
            <title>SISCON® | Recibimos tu solicitud</title>
        </head>
        <body>
            <h1 style="margin-bottom: 45px;text-align: center;font-family: Open Sans, Arial;text-index:25px;">Recimos tu solicitud correctamente</h1>
            <h3 style="margin-bottom: 15px;font-family: Open Sans, Arial;text-index:25px;">Hola, <strong>'.$destinatario.'</strong>.</h3>
            <p style=" margin-bottom: 5px;font-family: Open Sans, Arial;text-index:25px;">Hemos recibido tu Solicitud de Demostración de nuestro sistema SISCON® <strong>'.$sistema.'</strong>.</p>
            <p style=" margin-bottom: 5px;font-family: Open Sans, Arial;text-index:25px;">En breve vas a recibir otro correo con tu <strong>usuario</strong> y <strong>contraseña</strong> para que puesdas empezar a disfrutar de nuestra <strong>demostración gratuita</strong>.</p>
            <p style=" margin-bottom: 5px;font-family: Open Sans, Arial;text-index:25px;">Ten en cuenta que la demostración que vas a probar es un "maquetado" ya que maneja unos datos de <strong>facturación, clientes, productos</strong> y demás por defecto. Las mismas son tomadas de información ficticia, por lo que cualquier semejanza con la realidad es pura coincidencia.</p>
            <p style=" margin-bottom: 5px;font-family: Open Sans, Arial;text-index:25px;">Si deseas contratar un plan para comenzar a utilizar el sistema te dejamos <a href="https://www.hello.siscon-system.com#planes" style="color: #6896a0;padding: 0 5px;text-decoration: none;font-family: Open Sans, Arial;">el siguiente link</a> para que puedas ingresar y contratar el plan que <strong>mas se ajuste a tus necesidades</strong>.</p>
            <p style=" margin-bottom: 5px;font-family: Open Sans, Arial;text-index:25px;">Recuerda <strong>NO RESPONDER ESTE MENSAJE</strong> ya que el mismo se genera de manera automática.</p>
            <p style=" margin-bottom: 5px;font-family: Open Sans, Arial;text-index:25px;">Si deseas contactarnos te dejamos los siguientes links:</p>
            <br>
            <div style="text-align:center;">
                <a href="https://www.facebook.com/ags.desarrollo.web" target="_blank" style="color: #6896a0;padding: 0 5px;text-decoration: none;margin: 0 40px;"><img src="https://www.hello.siscon-system.com/img/mailer/facebook.png" alt="Facebook Siscon" width="60" style="display:block;"></a>
                <a href="https://www.www.linkedin.com/company/ags-desarrollo-web/" target="_blank" style="color: #6896a0;padding: 0 5px;text-decoration: none;margin: 0 40px;"><img src="https://www.hello.siscon-system.com/img/mailer/linkedin.png" alt="Facebook Siscon" width="60" style="display:block;"></a>
                <a href="https://www.t.me/Alex_Sanc" target="_blank" style="color: #6896a0;padding: 0 5px;text-decoration: none;margin: 0 40px;"><img src="https://www.hello.siscon-system.com/img/mailer/telegrama.png" alt="Facebook Siscon" width="60" style="display:block;"></a>
            </div>
            <br>
            <p style=" margin-bottom: 5px;font-family: Open Sans, Arial;text-index:25px;">Puedes contactarnos al mail:</p>
            <a href="mailto:contacto@siscon-system.com" target="_blank" style="color: #6896a0;padding: 0 5px;text-decoration: none;">contacto@siscon-system.com</a>
            <br>
            <div width="500" style="margin: 50px auto;text-align: center;">
                <a href="https://www.hello.siscon-system.com" style="color: #6896a0;padding: 0 5px;text-decoration: none;"><img src="https://www.hello.siscon-system.com/img/siscon64.png" width="60" style="display:block;" alt="Siscon LOGO"></a>
                <h3 style="margin-bottom: 15px;font-family: Open Sans, Arial;">SISCON® Systems</h3>
                <h4 style="margin-bottom: 15px;font-family: Open Sans, Arial;"><em>By <a href="https://www.facebook.com/ags.desarrollo.web" style="color: #6896a0;padding: 0 5px;text-decoration: none;">AGS - Desarrollo Web</a></em></h4>
            </div>
        </body>
    </html>';
    return $html;
} ?>
