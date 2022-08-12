<?php

    // ***** PHPMailer() ***** //
    use PHPMailer\PHPMailer\PHPMailer;

    require '../vendor/autoload.php';

    // echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n";

    $name = 'Alexis Sanchez'; //$_POST['name'];
    $email = 'alesan33_1@hotmail.com'; //$_POST['email'];
    $sistema = 2; //intval($_POST['sistema']);
    $user = 'asanchez'; //$_POST['user'];

    //Convertimos a string sistema
    $system = ($sistema == 1) ? "POS" : "Distribucion";

    $title = 'Ingreso al sistema SISCON�0�3';
    $mensaje = file_get_contents('mailer-user.php');
    
    // Replace variables en HTML
    $mensaje = str_replace('%sistema%', $system, $mensaje);
    $mensaje = str_replace('%nombre%', $name, $mensaje);
    $mensaje = str_replace('%usuario%', $user, $mensaje);
    
    $alt_msg = 'Se ha generado el alta de tu acceso a Siscon�0�3 correctamente. Ingresa a https://app.sisconsystem.online con tu nuevo usuario '.$user.' y empieza a distrutar de la nueva #ExperienciaSiscon.';

    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 587; // 465
    $mail->SMTPAuth = true;
    $mail->Username = 'no-responder@sisconsystem.online';
    $mail->Password = 'Alex3344/';
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Este era el error 'ssl'
    $mail->setFrom('no-responder@sisconsystem.online', 'Siscon System');
    $mail->addAddress($email, $name);
    $mail->Subject = $title;
    $mail->isHTML(true);
    $mail->msgHTML($mensaje);
    $mail->AltBody = $alt_msg;
    //$mail->addAttachment('test.txt');
    if (!$mail->send()) {
        echo "<pre>";
        var_dump($mail->ErrorInfo);
        echo "</pre>";
    } else {
        echo "<pre>";
        echo "Correo enviado.";
        echo "</pre>";
    }

?>