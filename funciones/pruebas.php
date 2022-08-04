<?php

    // ***** PHPMailer() ***** //
    use PHPMailer\PHPMailer\PHPMailer;

    require '../vendor/autoload.php';

    $name = 'Alexis Sanchez'; //$_POST['name'];
    $email = 'alesan33_1@hotmail.com'; //$_POST['email'];
    $sistema = 2; //intval($_POST['sistema']);
    $user = 'asanchez'; //$_POST['user'];

    //Convertimos a string sistema
    $system = ($sistema == 1) ? "POS" : "Distribucion";

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
        echo "<pre>";
        var_dump($mail->ErrorInfo);
        echo "</pre>";
    } else {
        echo "<pre>";
        echo "Correo enviado.";
        echo "</pre>";
    }

?>