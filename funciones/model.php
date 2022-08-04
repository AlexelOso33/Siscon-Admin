<?php

    //Llamada a la BD "solamente guardar datos"
    include_once 'bd_conexion.php';

    //Variable global fecha_actual
    $date= date('Y-m-d H:i:s');
    $hoy = strtotime('-3 hour', strtotime($date));
    $hoy = date('Y-m-d H:i:s', $hoy);
    
    // ***** PHPMailer() ***** //
    use PHPMailer\PHPMailer\PHPMailer;

    require '../vendor/autoload.php';

    // Formulario DEMO siscon
    if($_POST['accion'] == 'solicitud-demo'){
        $respuesta_rec = $_POST['g-recaptcha-response'];
        if(empty($respuesta_rec)){
            $respuesta = array(
                'respuesta' => 'error-g-recaptcha'
            );
            die(json_encode($respuesta));
            exit;
        }
        
        // Variables
        $nombre = $_POST['name-demo'];
        $empresa = $_POST['business-demo'];
        $posicion = $_POST['position-demo'];
        $email = $_POST['email-demo'];
        $telefono = $_POST['tel-demo'];
        $sistema = intval($_POST['type-system']);
        $medio = 1;
        $estado = 0;
        $msg = 0;
        $no_mail = 0;
        
        // Envío de datos a Google Recaptcha
        $recaptcha = $_POST["g-recaptcha-response"];
 
    	$url = 'https://www.google.com/recaptcha/api/siteverify';
    	$data = array(
    		'header' => "Content-Type: application/x-www-form-urlencoded\r\n", 
    		'secret' => '6Legoj4bAAAAAPE7y_K325wQRZbagV6dfccgbtbB',
    		'response' => $recaptcha
    	);
    	$options = array(
    		'http' => array (
    			'method' => 'POST',
    			'content' => http_build_query($data)
    		)
    	);
    	$context  = stream_context_create($options);
    	$verify = file_get_contents($url, false, $context);
    	$captcha_success = json_decode($verify);
    	if ($captcha_success->success) {
    		try {
    		    $stmt = $conn->prepare('INSERT INTO demos_data (name_business, name_req, tel_req, mail_req, position_req, system_type, medium_req, date_include, status_demo, msg_view, mail_sent) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    		    $stmt->bind_param('sssssiisiii', $empresa, $nombre, $telefono, $mail, $posicion, $sistema, $medio, $hoy, $estado, $msg, $no_mail);
    		    $stmt->execute();
    		    if($stmt->insert_id > 0){
    		        $id_inserted = $stmt->insert_id;
    		        //Convertimos a string sistema
    		        $system = ($sistema == 1) ? "POS" : "Distribución";
    		        
    		        $title = 'Solicitud de demostración';
                    $td1 = 'Demostración de';
                    $tdDemo = '<p>Ten en cuenta que la demostración que vas a probar es un "maquetado" ya que maneja unos datos de <strong>facturación, clientes, productos y demás</strong> por defecto. Las mismas son tomadas de información ficticia, por lo que cualquier semejanza con la realidad es pura coincidencia.</p><p>Si deseas contratar un plan para comenzar a utilizar el sistema te dejamos el <a href="https://www.hello.siscon-system.com#planes" target="_blank">siguiente link</a> para que puedas ingresar y contratar el plan que mas se ajuste a tus necesidades.</p>';
                    $mensaje = file_get_contents('mailer1.php');
                    
                    // Replace variables en HTML
                    $mensaje = str_replace('%sistema%', $system, $mensaje);
                    $mensaje = str_replace('%nombre%', $nombre, $mensaje);
                    $mensaje = str_replace('%td1%', $td1, $mensaje);
                    $mensaje = str_replace('%tdDemo%', $tdDemo, $mensaje);

                    $mail = new PHPMailer;
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->SMTPDebug = 0;
                    $mail->Host = 'mail.siscon-system.com';
                    $mail->Port = 465;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'no-responder@siscon-system.com';
                    $mail->Password = 'alex2526';
                    $mail->SMTPSecure = 'ssl'; //Este era el error
                    $mail->setFrom('no-responder@siscon-system.com', 'Siscon Systems');
                    $mail->addAddress($email, $nombre);
                    $mail->Subject = $title;
                    $mail->isHTML(true);
                    $mail->msgHTML($mensaje);
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    //$mail->addAttachment('test.txt');
                    if (!$mail->send()) {
                        echo "Error al enviar el correo. Error".$mail->error;
                    } else {
                        //Si se envía el correo
                        $mail = 1;
    		            try{
    		                $bd = $conn->prepare("UPDATE demos_data SET mail_sent = ? WHERE id_demo = ?");
    		                $bd->bind_param("ii", $mail, $id_inserted);
    		                $bd->execute();
    		                $bd->close();
    		            } catch (\Throwable $th) {
                            echo "Error: " . $th->getMessage();
                        }
                        $respuesta = array(
    		            'respuesta' => 'ok',
    		            'id' => $stmt->insert_id
    		        );
                    }
    		        
    		       /*  $header  = 'MIME-Version: 1.0' . "\r\n";
                    $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                    $header .= 'From: no-responder@siscon-system.com' . "\r\n";
                    $header .= 'X-Mailer: PHP/' . phpversion();
                    
                    $success = mail($mail, $title, $mensaje, $header);
    		        if($success){ 
    		            //Si se envía el correo
    		            $mail = 1;
    		            try{
    		                $bd = $conn->prepare("UPDATE demos_data SET mail_sent = ? WHERE id_demo = ?");
    		                $bd->bind_param("ii", $mail, $id_inserted);
    		                $bd->execute();
    		                $bd->close();
    		            } catch (\Throwable $th) {
                            echo "Error: " . $th->getMessage();
                        }
    		        }*/
    		        
    		    } else {
    		        $respuesta = array(
    		            'respuesta' => 'error'  
		            );
    		    }
    		    $stmt->close();
    		} catch (\Throwable $th) {
                echo "Error: " . $th->getMessage();
            }
    	} else {
    	    $respuesta = array(
    	        'respuesta' => 'robot'  
	        );
    	}
    	die(json_encode($respuesta));
    }

    // Envío de confirmación de mail
    if($_POST['accion'] == 'mailer-confirm'){
        
        // Comprobación CHECKED ReCaptcha
        $respuesta_rec = $_POST['g-recaptcha-response'];
        if(empty($respuesta_rec)){
            $respuesta = array(
                'respuesta' => 'error-g-recaptcha'
            );
            die(json_encode($respuesta));
            exit;
        }
        
        // Envío de datos a Google Recaptcha
        $recaptcha = $_POST["g-recaptcha-response"];
 
    	$url = 'https://www.google.com/recaptcha/api/siteverify';
    	$data = array(
    		'header' => "Content-Type: application/x-www-form-urlencoded\r\n", 
    		'secret' => '6Legoj4bAAAAAPE7y_K325wQRZbagV6dfccgbtbB',
    		'response' => $recaptcha
    	);
    	$options = array(
    		'http' => array (
    			'method' => 'POST',
    			'content' => http_build_query($data)
    		)
    	);
    	$context  = stream_context_create($options);
    	$verify = file_get_contents($url, false, $context);
    	$captcha_success = json_decode($verify);
    	if ($captcha_success->success) {

            // conversión código activación
            $email = $_POST['email'];
            $name = $_POST['name'];
            $opciones = array('cost' => 12);
            $key = password_hash($name, PASSWORD_BCRYPT, $opciones);
    
            $title = 'Alta de usuario';
            $url = 'https://hello.siscon-system.com/activate?a='.$key;
            $mensaje = file_get_contents('mailer2.php');
            
            // Replace variables en HTML
            $mensaje = str_replace('%sistema%', $system, $mensaje);
            $mensaje = str_replace('%nombre%', $name, $mensaje);
            $mensaje = str_replace('%url%', $url, $mensaje);
            $mensaje = str_replace('%activacion%', $key, $mensaje);
    
            $mail = new PHPMailer;
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'mail.siscon-system.com';
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->Username = 'no-responder@siscon-system.com';
            $mail->Password = 'alex2526';
            $mail->SMTPSecure = 'ssl'; //Este era el error
            $mail->setFrom('no-responder@siscon-system.com', 'Siscon Systems');
            $mail->addAddress($email, $name);
            $mail->Subject = $title;
            $mail->isHTML(true);
            $mail->msgHTML($mensaje);
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            //$mail->addAttachment('test.txt');
            if (!$mail->send()) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'error' => $mail->ErrorInfo
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'ok'
                );
            }
    	} else {
    	    $respuesta = array(
    	        'respuesta' => 'robot'  
	        );
    	}
        die(json_encode($respuesta));
    }

    // Carga de datos en la BD
    if($_POST['accion'] == 'enviar-mail-confirm'){
        $name = $_POST['name-registro'];
        $empresa = $_POST['business-registro'];
        $email = $_POST['email-registro'];
        $telefono = $_POST['tel-registro'];
        $sistema = intval($_POST['sistema-registro']);
        $password = $_POST['password-registro'];
        $t_one = $_POST['plan'];
        $t_two = $_POST['pago'];
        $op = 0;

        $opciones = array('cost' => 12);
        $password_h = password_hash($password, PASSWORD_BCRYPT, $opciones);

        try {
            $stmt = $conn->prepare('INSERT INTO data_sent_site (name_ds, business_ds, mail_ds, password_ds, phone_ds, tsystem_ds, typeonesys_ds, typetwosys_ds, fec_includ, operation_ds, confirm_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('sssssiiisis', $name, $empresa, $email, $password_h, $telefono, $sistema, $t_one, $t_two, $hoy, $op, $hoy);
            $stmt->execute();
            if($stmt->insert_id > 0){

                //Convertimos a string sistema
                $system = ($sistema == 1) ? "POS" : "Distribución";

                // conversión código activación
                $opciones = array('cost' => 12);
                $key = password_hash($email, PASSWORD_BCRYPT, $opciones);
                $str_key = $key.'&m='.$email;
        
                $title = 'Alta de usuario';
                $url = 'https://hello.siscon-system.com/activate.php?a='.$str_key;
                $mensaje = file_get_contents('mailer2.php');
                
                // Replace variables en HTML
                $mensaje = str_replace('%sistema%', $system, $mensaje);
                $mensaje = str_replace('%nombre%', $name, $mensaje);
                $mensaje = str_replace('%url%', $url, $mensaje);
                $mensaje = str_replace('%activacion%', $str_key, $mensaje);
        
                $mail = new PHPMailer;
                $mail->CharSet = 'UTF-8';
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Host = 'mail.siscon-system.com';
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->Username = 'no-responder@siscon-system.com';
                $mail->Password = 'alex2526';
                $mail->SMTPSecure = 'ssl'; //Este era el error
                $mail->setFrom('no-responder@siscon-system.com', 'Siscon Systems');
                $mail->addAddress($email, $name);
                $mail->Subject = $title;
                $mail->isHTML(true);
                $mail->msgHTML($mensaje);
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                //$mail->addAttachment('test.txt');
                if (!$mail->send()) {
                    $respuesta = array(
                        'respuesta' => 'errorMail',
                        'error' => $mail->ErrorInfo
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'ok'
                    );
                }
            } else {
                $respuesta = array(
                    'respuesta' => 'errorBD'  
                );
            }
        } catch (\Throwable $th) {
            echo "Error: " . $th->getMessage();
        }
    	
        die(json_encode($respuesta));
        $stmt->close();
    }
    
    // Envío de mail + info usuario
    if($_POST['accion'] == 'mailer-user'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $sistema = intval($_POST['sistema']);
        $user = $_POST['user'];

        //Convertimos a string sistema
        $system = ($sistema == 1) ? "POS" : "Distribución";

        $title = 'Ingreso al sistema SISCON®';
        $mensaje = file_get_contents('mailer-user.php');
        
        // Replace variables en HTML
        $mensaje = str_replace('%sistema%', $system, $mensaje);
        $mensaje = str_replace('%nombre%', $name, $mensaje);
        $mensaje = str_replace('%usuario%', $user, $mensaje);
        
        $alt_msg = 'Se ha generado el alta de tu acceso a Siscon® correctamente. Ingresa a https://siscon-system.com con tu nuevo usuario '.$user.' y empieza a distrutar de la nueva #ExperienciaSiscon.';

        $mail = new PHPMailer;
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'mail.siscon-system.com';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->Username = 'no-responder@siscon-system.com';
        $mail->Password = 'alex2526';
        $mail->SMTPSecure = 'ssl'; //Este era el error
        $mail->setFrom('no-responder@siscon-system.com', 'Siscon Systems');
        $mail->addAddress($email, $name);
        $mail->Subject = $title;
        $mail->isHTML(true);
        $mail->msgHTML($mensaje);
        $mail->AltBody = $alt_msg;
        //$mail->addAttachment('test.txt');
        if (!$mail->send()) {
            $respuesta = array(
                'respuesta' => 'errorMail',
                'error' => $mail->ErrorInfo
            );
        } else {
            $respuesta = array(
                'respuesta' => 'ok'
            );
        }
            
        die(json_encode($respuesta));
        $stmt->close();
    }

    // Envío de mail + info usuario
    if($_POST['accion'] == 'mail-alta-contrato'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $user = $_POST['user'];
        $id = $_POST['id'];
        $url = "https://hello.siscon-system.com/newpassword.php?us=".$id;

        //Convertimos a string sistema
        // $system = ($sistema == 1) ? "POS" : "Distribución";

        $title = 'Hemos registrado tu nuevo usuario';
        $mensaje = file_get_contents('mailer-contrato.html');
        
        // Replace variables en HTML
        $mensaje = str_replace('%url%', $url, $mensaje);
        $mensaje = str_replace('%nombre%', $name, $mensaje);
        $mensaje = str_replace('%usuario%', $user, $mensaje);
        
        $alt_msg = 'Se ha generado el alta de tu usuario '.$user.' correctamente. Ingresa a '.$url.' y genera tu nueva contraseña.';

        $mail = new PHPMailer;
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'mail.siscon-system.com';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->Username = 'no-responder@siscon-system.com';
        $mail->Password = 'alex2526';
        $mail->SMTPSecure = 'ssl'; //Este era el error
        $mail->setFrom('no-responder@siscon-system.com', 'Siscon Systems');
        $mail->addAddress($email, $name);
        $mail->Subject = $title;
        $mail->isHTML(true);
        $mail->msgHTML($mensaje);
        $mail->AltBody = $alt_msg;
        //$mail->addAttachment('test.txt');
        if (!$mail->send()) {
            $respuesta = array(
                'respuesta' => 'errorMail',
                'error' => $mail->ErrorInfo
            );
        } else {
            $respuesta = array(
                'respuesta' => 'ok'
            );
        }
            
        die(json_encode($respuesta));
    }

?>