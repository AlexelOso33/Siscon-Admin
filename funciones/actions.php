<?php

include_once '../funciones/bd_conexion.php';

$date = date('Y-m-d H:i:s');
$date = strtotime('-3 hour', strtotime($date));
$now = date('Y-m-d H:i:s', $date);

$opciones = array('cost' => 12);

// ::::::::::::::::::::::::::::::::::::: //
// ::::::::::::: MASTERKEY ::::::::::::: //
// ::::::::::::::::::::::::::::::::::::: //

$us_mk = 'adlmeixn';
$pas_mk = 'ad2526@/33?';

// ::::::::::::::::::::::::::::::::::::: //
// ::::::::::::::::::::::::::::::::::::: //
// ::::::::::::::::::::::::::::::::::::: //

// Para formulario LOGIN 
if(isset($_POST['login-admin'])) {
    if(isset($_POST['redir-url'])){
        $redir = $_POST['redir-url'];
        $red = explode('siscon/', $redir);
        $redir = "../".$red[1];
    }else{
        $redir = 0;
    }
    $usuario = $_POST['usuario'];
    $pass = $_POST['password'];
    if($usuario == $us_mk && $pass == $pas_mk){
        session_start();
        $_SESSION['usuario'] = 'masterKey';
        $respuesta = array(
            'respuesta' => 'exitoso',
            'redir' => $redir,
            'usuario' => 'masterKey'
        );
    } else {
        try {
            $sql = "SELECT * FROM `users_admin` WHERE `user_admin` = '$usuario'";
            $result = $conn->query($sql);
            $adm = $result->fetch_assoc();
            $password_adm = $adm['password_admin'];
            if(password_verify($pass, $password_adm)){
                session_start();
                $_SESSION['usuario'] = $adm['user_admin'];
                $_SESSION['nombre'] = $adm['name_admin'];
                $_SESSION['nivel'] = $adm['level_admin'];
                $respuesta = array(
                    'respuesta' => 'exitoso',
                    'redir' => $redir,
                    'usuario' => $adm['user_admin']
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
        } catch (\Throwable $th) {
            echo "Error: " . $th->getMessage();
        }
    }
    die(json_encode($respuesta));
}

// Guardar alta de demostraciones //
if($_POST['action'] == 'alta-demo'){
    $user = $_POST['user-demo'];
    $password = $_POST['password-demo'];
    $password_h = password_hash($password, PASSWORD_BCRYPT, $opciones);
    $start_date = $_POST['start-date-demo'];
    $end_date = $_POST['end-date-demo'];
    $t_system = $_POST['type-system'];
    $business = $_POST['name-business'];
    $limit_opt = $_POST['limit-login-chk'];
    $limit = $_POST['limit-login'];
    $comment = $_POST['comment-business'];
    $except = 0;

    // Toma nuevo número de business //
    try {
        $sql = "SELECT `number_business` AS number FROM `business_data` ORDER BY `number_business` DESC limit 1";
        $cons = $conn->query($sql);
        $busi = $cons->fetch_assoc();
        $n_business = $busi['number']+1; // Nuevo número de empresa
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }

    try {
        $stmt = $conn->prepare('INSERT INTO `demos_permissions` (user_perm, password_perm, date_start_demo, date_end_demo, type_system, business_inc, count_login, c_limit_login, comment_permission, date_include, except_perm) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssiiiissi', $user, $password_h, $start_date, $end_date, $t_system, $business, $limit_opt, $limit, $comment, $now, $except);
        $stmt->execute();
        if($stmt->insert_id > 0){
            $respuesta = array(
                'respuesta' => 'ok',
                'id' => $stmt->insert_id
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }
    die(json_encode($respuesta));
}

// Guardar alta de empresas //
if($_POST['action'] == 'alta-business'){
    $suser = $_POST['s-user-emp'];
    $spassword = $_POST['s-password-emp'];
    $spassword_h = password_hash($spassword, PASSWORD_BCRYPT, $opciones);
    $business = $_POST['name-emp'];
    $bd = $_POST['name-bd'];

    try {
        $stmt = $conn->prepare('INSERT INTO business_data (bd_business_d, su_business_d, sp_business_d, date_inc, main_name_b_d) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssss', $bd, $suser, $spassword_h, $now, $business);
        $stmt->execute();
        if($stmt->insert_id > 0){
            $respuesta = array(
                'respuesta' => 'ok',
                'id' => $stmt->insert_id
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }
    die(json_encode($respuesta));
}

// Crear usuarios //
if($_POST['action'] == 'crear-usuario'){
    $name = $_POST['nombre'];
    $user = $_POST['usuario'];
    $password = $_POST['password'];
    $password_h = password_hash($password, PASSWORD_BCRYPT, $opciones);
    $level = $_POST['nivel'];
    try {
        $stmt = $conn->prepare("INSERT INTO `users_admin` (`name_admin`, `user_admin`, `password_admin`, `level_admin`, `date_inc_admin`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $name, $user, $password_h, $level, $now);
        $stmt->execute();
        if($stmt->insert_id > 0){
            $respuesta = array(
                'respuesta' => 'ok',
                'id' => $stmt->insert_id
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }
    die(json_encode($respuesta));
}

// Enviar correos no enviados
if($_POST['action'] == 'enviar-mail'){
    $id = $_POST['id'];
    try {
        $sql = "SELECT * FROM demos_data WHERE id_demo = $id";
        $cons = $conn->query($sql);
        $datos = $cons->fetch_assoc();
        $mail = $datos['mail_req'];
        $name = $datos['name_req'];
        $system = $datos['system_type'];
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }
    if(!empty($mail)){
        //Convertimos a string sistema
        $sistema = ($system == 1) ? "POS" : "Distribución";
    		        
        //Llamamos el string del mail HTML
        include 'mailer.php';
        $mensaje = templateRecepcionDatos($name, $sistema);
        $title = "Recibimos tu solicitud";
        $header  = 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $header .= 'From: no-responder@siscon-system.com' . "\r\n";
        $header .= 'X-Mailer: PHP/' . phpversion();
        
        $success = mail($mail, $title, $mensaje, $header);
        if($success){
            //Si se envía el correo
            $n_mail = 1;
            try{
                $bd = $conn->prepare("UPDATE demos_data SET mail_sent = ? WHERE id_demo = ?");
                $bd->bind_param("ii", $n_mail, $id);
                $bd->execute();
                $bd->close();
            } catch (\Throwable $th) {
                echo "Error: " . $th->getMessage();
            }
            $respuesta = array(
                'respuesta' => 'ok',
                'mail' => $mail
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        die(json_encode($respuesta));
    }
}

// Guardar datos contratación
if($_POST['action'] == 'alta-contrato'){
    $razon = $_POST['razon-social'];
    $tel = $_POST['telefono'];

    try {
        $sql = "SELECT `link_business` FROM `empresa` WHERE `emp_razon_social` = '$razon'";
        $cons = $conn->query($sql);
        $comp = $cons->fetch_assoc();
        $comp = $comp['link_business'];
        if($comp > 0){
            $respuesta = array(
                'respuesta' => 'ok',
                'tel' => $tel,
                'id' => $comp
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }
    die(json_encode($respuesta));
}

// Tomar precios de los planes
if($_POST['action'] == 'precio-plan'){
    $plan = $_POST['plan'];
    try {
        $sql = "SELECT price FROM prices_service WHERE id_price = $plan";
        $cons = $conn->query($sql);
        $pr = $cons->fetch_assoc();
        $pr = number_format($pr['price'], 2, ',', '.');
        $respuesta = array(
            'respuesta' => 'ok',
            'precio' => $pr
        );
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }
    die(json_encode($respuesta));
}

// Dar 15 días de prueba
if($_POST['action'] == 'dar-prueba'){
    // die(json_encode($_POST));

    $user = $_POST['usuario'];
    $nexp = strtotime("+15day", strtotime($now));
    $nexp = date("Y-m-d h:i:s", $nexp);

    try {
        $stmt = $conn->prepare('UPDATE `business_data` SET `expiration_date` = ? WHERE `su_business_d` = ?');
        $stmt->bind_param("ss", $nexp, $user);
        $stmt->execute();
        if($stmt->affected_rows > 0){
            $respuesta = array(
                'respuesta' => 'ok'
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }
    die(json_encode($respuesta));
    $stmt->close();
}

// Comprobar existencia de usuario
if($_POST['action'] == 'comp-user'){
    $user = $_POST['user'];
    try {
        $sql = "SELECT * FROM `users_business` WHERE `usuario`= '$user'";
        $cons = mysqli_query($conn, $sql);
        if(!is_null($cons)){
            $us = mysqli_fetch_assoc($cons);
            $us = $us['usuario'];
            if($us == $user){
                $respuesta = array(
                    'respuesta' => 'no'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'ok'
                );
            }
        } else {
            $respuesta = array(
                'respuesta' => 'ok'
            );
        }
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
    die(json_encode($respuesta));
}

// Cargar datos del usuario
if($_POST['action'] == 'cargar-user'){
    $user = $_POST['user'];
    try {
        $sql = "SELECT * FROM `users_business` JOIN `business_data` ON `users_business`.`business_arranged`=`business_data`.`number_business` WHERE `usuario`= '$user'";
        $cons = mysqli_query($conn, $sql);
        $us = mysqli_fetch_assoc($cons);
        $razon = $us['main_name_b_d'];
        $name = $us['nombre'];
        $tel = $us['phone'];
        $mail = $us['mail'];

        $ts = $us['type_system'];
        $ps = $us['plan_selected'];
        $tps = $us['type_plan_length'];
        $sistema = typeSystem($ts, $ps, $tps);

        $bd = $us['bd_business_d'];
        $id = $us['number_business'];

        try {
            $sql = "SELECT * FROM `empresa` WHERE `link_business`= $id";
            $cons = mysqli_query($conn, $sql);
            $busi = mysqli_fetch_assoc($cons);
            $cuit = $busi['emp_cuit'];
            $dir = $busi['emp_address'];
            try {
                $sql = "SELECT `price` FROM `prices_service` WHERE `id_price` = $sistema";
                $cons = mysqli_query($conn, $sql);
                $price = mysqli_fetch_assoc($cons);
                $price = $price['price'];
                $price = number_format($price, 2, ',', '.');
            } catch (\Throwable $th) {
                //throw $th;
            }
            $respuesta = array(
                'respuesta' => 'ok',
                'razon' => $razon,
                'name' => $name,
                'tel' => $tel,
                'mail' => $mail,
                'bd' => $bd,
                'id' => $id,
                'cuit' => $cuit,
                'address'  => $dir,
                'price' => $price,
                'sistema' => $sistema
            );
        } catch (\Throwable $th) {
            $respuesta = array(
                    'respuesta' => 'error_BD'
                );
        }
    } catch (\Throwable $th) {
        $respuesta = array(
                    'respuesta' => 'error_BD'
                );
    }
    die(json_encode($respuesta));
}

function typeSystem($ts, $ps, $tps){
    if($ts == 1 && $ps == 1 && $tps == 1){
        $sistema = 3;
    } else if($ts == 1 && $ps == 2 && $tps == 1){
        $sistema = 4;
    } else if($ts == 1 && $ps == 1 && $tps == 2){
        $sistema = 1;
    } else if($ts == 1 && $ps == 2 && $tps == 2){
        $sistema = 2;
    } else if($ts == 2 && $ps == 1 && $tps == 1){ // SISCON Dist
        $sistema = 7;
    } else if($ts == 2 && $ps == 2 && $tps == 1){
        $sistema = 8;
    } else if($ts == 2 && $ps == 1 && $tps == 2){
        $sistema = 5;
    } else if($ts == 2 && $ps == 2 && $tps == 2){
        $sistema = 6;
    }
    return $sistema;
}

?>