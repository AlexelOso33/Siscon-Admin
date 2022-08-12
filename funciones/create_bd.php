<?php

    // die(json_encode($_POST));
    include_once 'bd_conexion.php';

    //Variable global fecha_actual
    $date= date('Y-m-d H:i:s');
    $hoy = strtotime('-3 hour', strtotime($date));
    $now = date('Y-m-d H:i:s', $hoy);

// STEP BY STEP //
if($_POST['action'] == 'create-crud'){
    
    $bd = $_POST['bd'];
    // die(json_encode($_POST));
    $database = "sisconsy_".$bd;

    $user = 'admin_siscon';
    $password = 'alex3344/';
    $host = 'localhost';
    
    $conne = mysqli_connect($host, $user, $password);
    $conne->set_charset('utf8');

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
    }
    
    try {
        $sql = "CREATE DATABASE IF NOT EXISTS $database DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_general_ci";
        $cons = mysqli_query($conne, $sql);
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }

    $conne->close();
    
    // $step = $_POST['nstep'];
    
    // Variable BD
    
    $user = 'admin_siscon';
    $password = 'alex3344/';
    $host = 'localhost';
    
    $connt = mysqli_connect($host, $user, $password, $database);
    if (!$connt) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Create database with array
    $step2 = "USE $database";
    $step3 = "CREATE TABLE ajustes_stock (
            id_ajstock int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            tipo_ajuste int(1) NOT NULL,
            str_ajuste longtext NOT NULL,
            usuario_ajstock varchar(15) NOT NULL,
            fecha_ajstock datetime NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step4 = "ALTER TABLE ajustes_stock ENGINE InnoDB";
    $step5 = "CREATE TABLE cajas (
            id_mov_caja int(16) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            caja int(10) NOT NULL,
            estado_caja int(1) NOT NULL,
            id_tipo_mov int(2) NOT NULL,
            desc_mov text,
            venta_id int(11) NOT NULL,
            valor float NOT NULL,
            ajuste_mov varchar(11) NOT NULL,
            fec_includ datetime NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step6 = "ALTER TABLE cajas ENGINE InnoDB";
    $step7 = "CREATE TABLE categoria (
            id_categoria int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            desc_categ varchar(15) NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step8 = "ALTER TABLE categoria ENGINE InnoDB";
    $step9 = "INSERT INTO categoria(desc_categ) VALUES ('Promociones')";
    $step10 = "CREATE TABLE clientes (
            id_cliente int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            fec_modif varchar(20) NOT NULL,
            nombre varchar(50) NOT NULL,
            apellido varchar(50) NOT NULL,
            direccion varchar(120) NOT NULL,
            numero_dir varchar(15) NOT NULL,
            barrio varchar(50) NOT NULL,
            ciudad_id int(2) NOT NULL,
            zona_id int(7) NOT NULL,
            fecha_nac varchar(10) NOT NULL,
            telefono varchar(15) NOT NULL,
            celu varchar(2) NOT NULL,
            id_creditos int(12) NOT NULL,
            comentarios text,
            estado_cliente int(1) NOT NULL,
            fec_inclu datetime NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step11 = "ALTER TABLE clientes ENGINE InnoDB";
    $step12 = "CREATE TABLE credeudas (
            id_credeuda int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            cliente_id int(10) NOT NULL,
            factura_afectada int(10) NOT NULL,
            credito float NOT NULL,
            deuda float NOT NULL,
            comentarios varchar(150),
            fecha datetime NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step13 = "ALTER TABLE credeudas ENGINE InnoDB";
    /*$step14 = "CREATE TABLE empresa (
            emp_nombre varchar(50) NOT NULL,
            emp_razon_social varchar(50) NOT NULL,
            emp_logo varchar(50),
            emp_descripcion text,
            emp_cuit varchar(13),
            emp_ing_bruto varchar(10),
            emp_inicio_act varchar(10),
            emp_www text,
            emp_facebook varchar(150),
            emp_instagram varchar(150),
            emp_linkedin varchar(150),
            emp_address varchar(250),
            emp_city varchar(50),
            emp_mail varchar(150) NOT NULL,
            emp_phone varchar(20) NOT NULL,
            emp_ult_modif datetime,
            emp_fec_includ datetime
        ) ENGINE=InnoDB COLLATE utf8_general_ci";*/
    // $step15 = "ALTER TABLE empresa ENGINE InnoDB";
    $step13 = "CREATE TABLE ciudades (
        `id_ciudad` INT NOT NULL AUTO_INCREMENT , 
        `ciudad` VARCHAR(100) NOT NULL ,
        PRIMARY KEY  (`id_ciudad`)
        ) ENGINE = InnoDB COLLATE utf8_general_ci";
    $step16 = "CREATE TABLE ncreditos (
            id_ncred int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            venta_id int(11) NOT NULL,
            usuario_nc varchar(25),
            estado_nc int(11) NOT NULL,
            fec_includ datetime NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step17 = "ALTER TABLE ncreditos ENGINE InnoDB";
    $step18 = "CREATE TABLE pagos (
            id_pago int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            num_pago varchar(30) NOT NULL,
            desc_pago varchar(120) NOT NULL,
            fec_pago varchar(10) NOT NULL,
            valor_pago varchar(15) NOT NULL,
            motivo_pago int(2) NOT NULL,
            estab_pago varchar(120) NOT NULL,
            imp_caja varchar(2) NOT NULL,
            url_file varchar(600),
            fec_includ_pago datetime
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step19 = "ALTER TABLE pagos ENGINE InnoDB";
    $step20 = "CREATE TABLE productos (
            id_producto int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            cod_auto int(6) NOT NULL,
            codigo_barra varchar(30) NOT NULL,
            codigo_prod varchar(10) NOT NULL,
            descripcion varchar(100) NOT NULL,
            categoria_id int(7) NOT NULL,
            sub_categ_id int(7) NOT NULL,
            prods_promo varchar(200) NOT NULL,
            desc_promo varchar(6) NOT NULL,
            pv_promo varchar(15) NOT NULL,
            precio_costo float NOT NULL,
            precio_venta float NOT NULL,
            ganancia float NOT NULL,
            stock float NOT NULL,
            sin_stock varchar(2) NOT NULL,
            proveedor_id int(11) NOT NULL,
            comentarios text,
            modificado int(1) NOT NULL,
            estado int(1) NOT NULL,
            fec_includ datetime NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step21 = "ALTER TABLE productos ENGINE InnoDB";
    $step22="CREATE TABLE proveedores (
            id_proveedor int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nombre_proveedor varchar(150) NOT NULL,
            direccion_proveedor varchar(250) NOT NULL,
            coment_proveedor varchar(400) NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step23 = "ALTER TABLE proveedores ENGINE InnoDB";
    $step24 = "CREATE TABLE reportes (
            id_reporte int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            num_reporte int(25) NOT NULL,
            impreso tinyint(1) NOT NULL,
            rango_f varchar(25) NOT NULL,
            tipo_rep int(2) NOT NULL,
            usuario_accion varchar(15) NOT NULL,
            fec_includ datetime NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step25 = "ALTER TABLE reportes ENGINE InnoDB";
    $step26 = "CREATE TABLE service (
            id_pserv int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            mp_pserv int(2) NOT NULL,
            venc_mp_pserv datetime NOT NULL,
            tipo_pserv int(2) NOT NULL,
            prueba_pserv int(1) NOT NULL,
            id_prueba_pserv int(10) NOT NULL,
            datos_mp_pserv varchar(250) NOT NULL,
            fec_includ_pserv datetime NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step27 = "ALTER TABLE service ENGINE InnoDB;";
    $step28 = "CREATE TABLE sub_categoria (
            id_sub_categ int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            categoria int(5) NOT NULL,
            desc_sub_cat varchar(20) NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step29 = "ALTER TABLE sub_categoria ENGINE InnoDB";
    $step30 = "CREATE TABLE vendedores (
            id_vendedor int(7) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nombre_vendedor varchar(60) NOT NULL,
            usuario varchar(15) NOT NULL,
            fecha_comienzo varchar(12) NOT NULL,
            zonas_id varchar(20) NOT NULL,
            estado_vendedor int(1) NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step31 = "ALTER TABLE vendedores ENGINE InnoDB";
    $step32 = "CREATE TABLE ventas (
            id_venta int(25) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            n_venta int(20) NOT NULL,
            comprobante VARCHAR(2) NOT NULL,
            n_presupuesto int(10) NOT NULL,
            cliente_id int(11) NOT NULL,
            id_vend_venta int(11) NOT NULL,
            productos varchar(500) NOT NULL,
            total float NOT NULL,
            ganancias_venta float NOT NULL,
            id_bonif int(2) NOT NULL,
            bonificacion float NOT NULL,
            detalle_bonif text,
            id_credito int(11) NOT NULL,
            usa_credito int(1) NOT NULL,
            medio_pago varchar(6) NOT NULL,
            estado int(2) NOT NULL,
            facturacion varchar(30) NOT NULL,
            coment_estado varchar(500),
            fecha_entrega varchar(15),
            estado_entrega int(2) NOT NULL,
            coment_venta text,
            refacturacion int(1) NOT NULL,
            medio_creacion int(1) NOT NULL,
            fec_modif_venta varchar(25) NOT NULL,
            fec_includ datetime NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step33 = "ALTER TABLE ventas ENGINE InnoDB";
    $step34 = "CREATE TABLE zonas (
            id_zona int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            num_zona_id int(4) NOT NULL,
            lugares varchar(200) NOT NULL
        ) ENGINE=InnoDB COLLATE utf8_general_ci";
    // $step35 = "ALTER TABLE zonas ENGINE InnoDB";
    $step36 = "INSERT INTO zonas(num_zona_id, lugares) VALUES (0, '')";

    $alt0 = "ALTER TABLE `zonas` ADD INDEX(`num_zona_id`)";
    $alt1 = "ALTER TABLE `clientes` ADD INDEX(`zona_id`)";
    $alt2 = "ALTER TABLE `clientes` ADD FOREIGN KEY (`zona_id`) REFERENCES `zonas`(`num_zona_id`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt3 = "ALTER TABLE `credeudas` ADD INDEX(`cliente_id`)";
    $alt4 = "ALTER TABLE `credeudas` ADD FOREIGN KEY (`cliente_id`) REFERENCES `clientes`(`id_cliente`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt5 = "ALTER TABLE `ncreditos` ADD INDEX(`venta_id`)";
    $alt6 = "ALTER TABLE `ncreditos` ADD FOREIGN KEY (`venta_id`) REFERENCES `ventas`(`id_venta`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt7 = "ALTER TABLE `productos` ADD INDEX(`sub_categ_id`)";
    $alt8 = "ALTER TABLE `productos` ADD FOREIGN KEY (`sub_categ_id`) REFERENCES `sub_categoria`(`id_sub_categ`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt9 = "ALTER TABLE `productos` ADD INDEX(`categoria_id`)";
    $alt10 = "ALTER TABLE `productos` ADD FOREIGN KEY (`categoria_id`) REFERENCES `categoria`(`id_categoria`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt11 = "ALTER TABLE `productos` ADD INDEX(`proveedor_id`)";
    $alt12 = "ALTER TABLE `productos` ADD FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores`(`id_proveedor`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt13 = "ALTER TABLE `sub_categoria` ADD INDEX(`categoria`)";
    $alt14 = "ALTER TABLE `sub_categoria` ADD FOREIGN KEY (`categoria`) REFERENCES `categoria`(`id_categoria`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt15 = "ALTER TABLE `ventas` ADD INDEX(`cliente_id`)";
    $alt16 = "ALTER TABLE `ventas` ADD FOREIGN KEY (`cliente_id`) REFERENCES `clientes`(`id_cliente`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt17 = "ALTER TABLE `ventas` ADD INDEX(`id_vend_venta`)";
    $alt18 = "ALTER TABLE `ventas` ADD FOREIGN KEY (`id_vend_venta`) REFERENCES `vendedores`(`id_vendedor`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt19 = "ALTER TABLE `clientes` ADD FOREIGN KEY (`ciudad`) REFERENCES `ciudades`(`id_ciudad`) ON DELETE RESTRICT ON UPDATE RESTRICT";

    $array_db = array($step2, $step3, $step5, $step7, $step9, $step10, $step12, $step13, $step16, $step18, $step20, $step22, $step24, $step26, $step28, $step30, $step32, $step34, $step36, $alt0, $alt1, $alt2, $alt3, $alt4, $alt5, $alt6, $alt7, $alt8, $alt9, $alt10, $alt11, $alt12, $alt13, $alt14, $alt15, $alt16, $alt17, $alt18, $alt19);

    foreach ($array_db as $k => $v) {
        try {
            $consulta = mysqli_query($connt, $v);
            if($consulta === false){
                $i -= 1 ;
            }
        } catch (\Throwable $th) {
            $respuesta = array(
                'respuesta' => 'error',
                'step' => $array_db[$i]
            );
            die(json_encode($respuesta));
            break;
        }
    }

    $respuesta = array(
        'respuesta' => 'finish'
    );
    die(json_encode($respuesta));

    // Código viejo
    /* try {
        $consulta = mysqli_query($conn1, $array_db[$step]);
        if($consulta === true){
            /*$respuesta = array(
                'respuesta' => 'error',
                'step' => $step
            );
        } else
            if($step == 36){
                $respuesta = array(
                    'respuesta' => 'finish'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'ok'
                );
            }
        }
    } catch (\Throwable $th) {
       echo "Error: ".$th->getMessage();
    } */

    $conn->close();
    $conn1->close();
    $connt->close();
    $stmt1->close();
}

// Creación de Usuario Business y User Data
if($_POST['action'] == 'create-bu'){
    
    $id = intval($_POST['id']);
    $bd = $_POST['name-bd'];
    
    try {
        $sqlb = "SELECT * FROM `data_sent_site` WHERE `id_data_sent` = $id";
        $consb = $conn->query($sqlb);
        $data_b = $consb->fetch_assoc();
        
        // Variables desde BD //

        $name = $data_b['name_ds'];
        $business = $data_b['business_ds'];
        $mail = $data_b['mail_ds'];
        $password_h = $data_b['password_ds'];
        $phone = $data_b['phone_ds'];
        $sistema = intval($data_b['tsystem_ds']);
        $plan_s = intval($data_b['typeonesys_ds']);
        $t_plan_s = intval($data_b['typetwosys_ds']);
        $dia = $data_b['fec_includ'];

        // ****************** //

    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }

    // Tomamos y convertimos el monto
    $sql = tomarMontos($sistema, $plan_s, $t_plan_s); //Consulta SQL
    $expiration = expirationDate($dia, $t_plan_s);

    // Consulta a la BD prices service
    try {
        $cons = $conn->query($sql);
        $monto = $cons->fetch_assoc();
        $monto = $monto['price'];
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }

    // Generamos usuario a partir del nombre
    $user1 = explode(" ", $name);
    $nombre = strtolower($user1[0]);
    $apellido = strtolower($user1[1]);
    $nombre = substr($nombre, 0, 1);
    $user = $nombre.$apellido;

    // Generar nombre BD
    $empresa = $business;
    $empresa = strtolower($empresa);
    if(strpos($empresa, " ") >= 0){
        $empresa = str_replace(" ", "_", $empresa);
    }
    if(strlen($empresa) > 20 ){
        $empresa = substr($empresa, 0, 20);
    }

    $status = 2; // Prueba de 15 días
    $level = 1; // Administrador MAIN
    $est_us = 1; // Usuario activo

    try {
        $sql = "SELECT number_business AS empresa FROM business_data ORDER BY empresa DESC LIMIT 1";
        $consulta = $conn->query($sql);
        $e = $consulta->fetch_assoc();
        $n_empresa = intval($e['empresa'])+1; // Variable nueva empresa
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }

    $avatar = "../img/siscon160.png"; // Avatar por defecto SISCON
    $address = "";
    $fs = 0;

    // #1 Creamos la empresa
    try {
        $stmt = $conn->prepare('INSERT INTO business_data (number_business, mail_business, type_system, plan_selected, type_plan_length, ammount, bd_business_d, su_business_d, sp_business_d, status, expiration_date, date_inc, main_name_b_d) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('isiiissssisss', $n_empresa, $mail, $sistema, $plan_s, $t_plan_s, $monto, $bd, $user, $password_h, $status, $expiration, $now, $business);
        $stmt->execute();
        if($stmt->insert_id > 0){
            
            // #2 Creamos superuser
            try {
                $stmt2 = $conn->prepare("INSERT INTO `users_business` (`nombre`, `business_arranged`, `avatar`, `mail`, `address`, `phone`, `usuario`, `password`, `first-steps`, `om_fs`, `fec_includ`, `ultima_modif`, `nivel`, `estado_usuario`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt2->bind_param("sissssssssii", $name, $n_empresa, $avatar, $mail, $address, $phone, $user, $password_h, $fs, $fs, $now, $now, $level, $est_us);
                $stmt2->execute();
                if($stmt2->insert_id > 0){
                    
                    //Variables para insert empresa
                    $emp_desc = '';
                    $emp_cuit = '';
                    $emp_ing = '';
                    $emp_ini = '';
                    $emp_www = '';
                    $emp_fb = '';
                    $emp_ig = '';
                    $emp_ln = '';
                    $emp_address = '';
                    $emp_city = '';
                    
                    // Insertamos 
                    try {
                        $stmt3 = $conn->prepare("INSERT INTO `empresa` (`link_business`, `emp_razon_social`, `emp_logo`, `emp_descripcion`, `emp_cuit`, `emp_ing_bruto`, `emp_inicio_act`, `emp_www`, `emp_facebook`, `emp_instagram`, `emp_linkedin`, `emp_address`, `emp_city`, `emp_mail`, `emp_phone`, `emp_ult_modif`, `emp_fec_includ`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt3->bind_param("issssssssssssssss", $n_empresa, $business, $avatar, $emp_desc, $emp_cuit, $emp_ing, $emp_ini, $emp_www, $emp_fb, $emp_ig, $emp_ln, $emp_address, $emp_city, $mail, $phone, $now, $now);
                        $stmt3->execute();
                        if($stmt3->insert_id > 0){
                            $respuesta = array(
                                'respuesta' => 'ok',
                                'user' => $user,
                                'name' => $name,
                                'system' => $sistema,
                                'mail' => $mail
                            );
                            
                            $n_op = 3; // Alta de sistema
                            
                            try {
                                $stmt3 = $conn->prepare("UPDATE `data_sent_site` SET `operation_ds` = ? WHERE `id_data_sent` = ?");
                                $stmt3->bind_param("ii", $n_op, $id);
                                $stmt3->execute();
                                $stmt3->close();
                            } catch (\Throwable $th) {
                                echo "Error: Modificación de estado de cuenta en la tabla data_sent_site";
                            }
                        } else {
                            $respuesta = array(
                                'respuesta' => 'ingreso datos table EMPRESA'
                            );
                        }
                    } catch (\Throwable $th) {
                        echo "Error: ".$th->getMessage();
                    }
                } else {
                    $respuesta = array(
                        'respuesta' => 'error datos usuario'
                    );
                }
                $stmt2->close();
            } catch (\Throwable $th) {
                echo "Error: ".$th->getMessage();
            }
            // *******************

        } else {
            $respuesta = array(
                'respuesta' => 'error datos empresa'
            );
        }
        $stmt->close();
    } catch (\Throwable $th) {
        $rta = "Error: ".$th->getMessage();
        $respuesta = array(
            'respuesta' => $rta
        );
    }
    $conn->close();
    die(json_encode($respuesta));
}

// Nuevo contrato
if($_POST['action'] == 'alta-contrato'){

    // VARIBLES
    $mail = $_POST['email'];

    $sist = $_POST['plan'];
    $sistema = convertSystem($sist);
    $ts = $sistema['ts'];
    $ps = $sistema['ps'];
    $tps = $sistema['tps'];
    
    try {
        $sql = "SELECT price FROM prices_service WHERE id_price = $sist";
        $cons = $conn->query($sql);
        $monto = $cons->fetch_assoc();
        $monto = $monto['price'];
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }
    $bd = $_POST['name-bd'];
    $user = $_POST['usuario'];
    $pass = "none";
    $now = date('Y-m-d h:i:s');
    $expiration = expirationDate($now, 1); // Envío solamente para 15 dias prueba
    $business = $_POST['razon-social'];
    $name = $_POST['nombre'];
    $avatar = "../img/siscon160.png"; // Avatar por defecto SISCON
    $address = $_POST['direccion'];
    $phone = $_POST['telefono'];
    $cuit = $_POST['cuit'];

    $fs = 0;
    $status = 4; // Nuevo CONTRATO
    $level = 1; // Administrador MAIN
    $est_us = 2; // Falta agregar contraseña

    // +1 numer business
    try {
        $sql = "SELECT `number_business` FROM `business_data` ORDER BY `number_business` DESC LIMIT 1";
        $cons = $conn->query($sql);
        $n_empresa = $cons->fetch_assoc();
        $n_empresa = intval($n_empresa['number_business'])+1;
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }

    // #1 Creamos la empresa
    try {
        $stmt = $conn->prepare('INSERT INTO business_data (number_business, mail_business, type_system, plan_selected, type_plan_length, ammount, bd_business_d, su_business_d, sp_business_d, status, expiration_date, date_inc, main_name_b_d) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('isiiissssisss', $n_empresa, $mail, $ts, $ps, $tps, $monto, $bd, $user, $pass, $status, $expiration, $now, $business);
        $stmt->execute();
        if($stmt->insert_id > 0){
            
            // #2 Creamos superuser
            try {
                $stmt2 = $conn->prepare("INSERT INTO `users_business` (`nombre`, `business_arranged`, `avatar`, `mail`, `address`, `phone`, `usuario`, `password`, `first_steps`, `om_fs`, `fec_includ`, `ultima_modif`, `nivel`, `estado_usuario`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt2->bind_param("sissssssiissii", $name, $n_empresa, $avatar, $mail, $address, $phone, $user, $pass, $fs, $fs, $now, $now, $level, $est_us);
                $stmt2->execute();
                if($stmt2->insert_id > 0){
                    
                    //Variables para insert empresa
                    $emp_desc = '';
                    $emp_cuit = $cuit !== '' ? $cuit : '';
                    $emp_ing = '';
                    $emp_ini = '';
                    $emp_www = '';
                    $emp_fb = '';
                    $emp_ig = '';
                    $emp_ln = '';
                    $emp_address = $address;
                    $emp_city = '';
                    $id = $stmt2->insert_id;

                    $opciones = array('cost' => 12);
                    $hid = password_hash($n_empresa, PASSWORD_BCRYPT, $opciones);
                    
                    // Insertamos 
                    try {
                        $stmt3 = $conn->prepare("INSERT INTO `empresa` (`link_business`, `emp_razon_social`, `emp_logo`, `emp_descripcion`, `emp_cuit`, `emp_ing_bruto`, `emp_inicio_act`, `emp_www`, `emp_facebook`, `emp_instagram`, `emp_linkedin`, `emp_address`, `emp_city`, `emp_mail`, `emp_phone`, `emp_ult_modif`, `emp_fec_includ`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt3->bind_param("issssssssssssssss", $n_empresa, $business, $avatar, $emp_desc, $emp_cuit, $emp_ing, $emp_ini, $emp_www, $emp_fb, $emp_ig, $emp_ln, $emp_address, $emp_city, $mail, $phone, $now, $now);
                        $stmt3->execute();
                        if($stmt3->insert_id > 0){
                            $respuesta = array(
                                'respuesta' => 'ok',
                                'sist' => $sist,
                                'user' => $user,
                                'mail' => $mail,
                                'name' => $name,
                                'id' => $id,
                                'bid' => $n_empresa,
                                'hid' => $hid,
                                'level' => $level,
                                'bd' => $bd
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => 'ingreso datos table EMPRESA'
                            );
                        }
                    } catch (\Throwable $th) {
                        echo "Error: ".$th->getMessage();
                    }
                } else {
                    $respuesta = array(
                        'respuesta' => 'error datos usuario'
                    );
                }
            } catch (\Throwable $th) {
                echo "Error al crear user_business";
            }
            // *******************

        } else {
            $respuesta = array(
                'respuesta' => 'error datos empresa'
            );
        }
    } catch (\Throwable $th) {
        $rta = "Error: ".$th->getMessage();
        $respuesta = array(
            'respuesta' => $rta
        );
    }
    die(json_encode($respuesta));
    $stmt->close();
    $stmt2->close();
    $stmt3->close();
}

/* FUNCIONES */

/* function tomarMontos($ts, $ps, $tps){
    // SISCON POS
    if($ts == 1 && $ps == 1 && $tps == 1){
        $monto = "SELECT * FROM `prices_service` WHERE `id_price` = 3";
    } else if($ts == 1 && $ps == 2 && $tps == 1){
        $monto = "SELECT * FROM `prices_service` WHERE `id_price` = 4";
    } else if($ts == 1 && $ps == 1 && $tps == 2){
        $monto = "SELECT * FROM `prices_service` WHERE `id_price` = 1";
    } else if($ts == 1 && $ps == 2 && $tps == 2){
        $monto = "SELECT * FROM `prices_service` WHERE `id_price` = 2";
    } else if($ts == 2 && $ps == 1 && $tps == 1){ // SISCON Dist
        $monto = "SELECT * FROM `prices_service` WHERE `id_price` = 7";
    } else if($ts == 2 && $ps == 2 && $tps == 1){
        $monto = "SELECT * FROM `prices_service` WHERE `id_price` = 8";
    } else if($ts == 2 && $ps == 1 && $tps == 2){
        $monto = "SELECT * FROM `prices_service` WHERE `id_price` = 5";
    } else if($ts == 2 && $ps == 2 && $tps == 2){
        $monto = "SELECT * FROM `prices_service` WHERE `id_price` = 6";
    }
    return $monto;
} */

function expirationDate($dia, $anual){
    if($anual == 1){
        $exp = strtotime('+30 days', strtotime($dia));
        $exp = date('Y-m-d h:i:s', $exp);
    } else if($anual == 2){
        $exp = strtotime('+15 days', strtotime($dia));
        $exp = date('Y-m-d h:i:s', $exp);
    } else {
        $exp = strtotime('+1 year', strtotime($dia));
        $exp = date('Y-m-d h:i:s', $exp);
    }
    return $exp;    
}

function convertSystem($sistema){
    $sistema = intval($sistema);
    switch ($sistema) {
        case 1:
            $ts = 1;
            $ps = 1;
            $tps = 2;
            break;
            case 2:
                $ts = 2;
                $ps = 1;
                $tps = 2;
                break;
                case 3:
                    $ts = 1;
                    $ps = 1;
                    $tps = 1;
                    break;
                    case 4:
                        $ts = 2;
                        $ps = 1;
                        $tps = 1;
                        break;
                        case 5:
                            $ts = 1;
                            $ps = 2;
                            $tps = 2;
                            break;
                            case 6:
                                $ts = 2;
                                $ps = 2;
                                $tps = 2;
                                break;
                                case 7:
                                    $ts = 1;
                                    $ps = 2;
                                    $tps = 1;
                                    break;
                                    case 8:
                                        $ts = 2;
                                        $ps = 2;
                                        $tps = 1;
                                        break;
                                        case 9:
                                            $ts = 1;
                                            $ps = 3;
                                            $tps = 2;
                                            break;
                                            case 10:
                                                $ts = 1;
                                                $ps = 3;
                                                $tps = 1;
                                                break;
    }
    $sist = array(
        'ts' => $ts,
        'ps' => $ps,
        'tps' => $tps
    );
    return $sist;
}

?>