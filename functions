<?php

    $usuario = 'sisconsy_admin';
    $password = 'sis25/33?con';
    $host = 'localhost';

    $conn = mysqli_connect($host, $usuario, $password);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Variable BD
    $db = $_POST['db'];

    // Create database with array
    $step1 = "CREATE DATABASE IF NOT EXISTS ".$db;
    $step2 = "USE ".$db;
    $step3 = "CREATE TABLE ".$db.".ajustes_stock (
            id_ajstock int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            tipo_ajuste int(1) NOT NULL,
            str_ajuste longtext NOT NULL,
            usuario_ajstock varchar(15) NOT NULL,
            fecha_ajstock datetime NOT NULL
        )";
    $step4 = "ALTER TABLE ".$db.".ajustes_stock ENGINE InnoDB";
    $step5 = "CREATE TABLE ".$db.".cajas (
            id_mov_caja int(16) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            caja int(10) NOT NULL,
            estado_caja int(1) NOT NULL,
            id_tipo_mov int(2) NOT NULL,
            desc_mov text,
            venta_id int(11) NOT NULL,
            valor float NOT NULL,
            ajuste_mov varchar(11) NOT NULL,
            fec_includ datetime NOT NULL
        )";
    $step6 = "ALTER TABLE ".$db.".cajas ENGINE InnoDB";
    $step7 = "CREATE TABLE ".$db.".categoria (
            id_categoria int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            desc_categ varchar(15) NOT NULL
        )";
    $step8 = "ALTER TABLE ".$db.".categoria ENGINE InnoDB";
    $step9 = "INSERT INTO ".$db.".categoria(desc_categ) VALUES ('Promociones')";
    $step10 = "CREATE TABLE ".$db.".clientes (
            id_cliente int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            fec_modif varchar(20) NOT NULL,
            nombre varchar(50) NOT NULL,
            apellido varchar(50) NOT NULL,
            direccion varchar(120) NOT NULL,
            numero_dir varchar(15) NOT NULL,
            barrio varchar(50) NOT NULL,
            ciudad int(2) NOT NULL,
            zona_id int(7) NOT NULL,
            fecha_nac varchar(10) NOT NULL,
            telefono varchar(15) NOT NULL,
            celu varchar(2) NOT NULL,
            id_creditos int(12) NOT NULL,
            comentarios text,
            estado_cliente int(1) NOT NULL,
            fec_inclu datetime NOT NULL
        )";
    $step11 = "ALTER TABLE ".$db.".clientes ENGINE InnoDB";
    $step12 = "CREATE TABLE ".$db.".credeudas (
            id_credeuda int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            cliente_id int(10) NOT NULL,
            factura_afectada int(10) NOT NULL,
            credito float NOT NULL,
            deuda float NOT NULL,
            comentarios varchar(150),
            fecha datetime NOT NULL
        )";
    $step13 = "ALTER TABLE ".$db.".credeudas ENGINE InnoDB";
    $step14 = "CREATE TABLE ".$db.".empresa (
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
        )";
    $step15 = "ALTER TABLE ".$db.".empresa ENGINE InnoDB";
    $step16 = "CREATE TABLE ".$db.".ncreditos (
            id_ncred int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            venta_id int(11) NOT NULL,
            usuario_nc varchar(25),
            estado_nc int(11) NOT NULL,
            fec_includ datetime NOT NULL
        )";
    $step17 = "ALTER TABLE ".$db.".ncreditos ENGINE InnoDB";
    $step18 = "CREATE TABLE ".$db.".pagos (
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
        )";
    $step19 = "ALTER TABLE ".$db.".pagos ENGINE InnoDB";
    $step20 = "CREATE TABLE ".$db.".productos (
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
        )";
    $step21 = "ALTER TABLE ".$db.".productos ENGINE InnoDB";
    $step22="CREATE TABLE ".$db.".proveedores (
            id_proveedor int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nombre_proveedor varchar(150) NOT NULL,
            direccion_proveedor varchar(250) NOT NULL,
            coment_proveedor varchar(400) NOT NULL
        )";
    $step23 = "ALTER TABLE ".$db.".proveedores ENGINE InnoDB";
    $step24 = "CREATE TABLE ".$db.".reportes (
            id_reporte int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            num_reporte int(25) NOT NULL,
            impreso tinyint(1) NOT NULL,
            rango_f varchar(25) NOT NULL,
            tipo_rep int(2) NOT NULL,
            usuario_accion varchar(15) NOT NULL,
            fec_includ datetime NOT NULL
        )";
    $step25 = "ALTER TABLE ".$db.".reportes ENGINE InnoDB";
    $step26 = "CREATE TABLE ".$db.".service (
            id_pserv int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            mp_pserv int(2) NOT NULL,
            venc_mp_pserv datetime NOT NULL,
            tipo_pserv int(2) NOT NULL,
            prueba_pserv int(1) NOT NULL,
            id_prueba_pserv int(10) NOT NULL,
            datos_mp_pserv varchar(250) NOT NULL,
            fec_includ_pserv datetime NOT NULL
        )";
    $step27 = "ALTER TABLE ".$db.".service ENGINE InnoDB;";
    $step28 = "CREATE TABLE ".$db.".sub_categoria (
            id_sub_categ int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            categoria int(5) NOT NULL,
            desc_sub_cat varchar(20) NOT NULL
        )";
    $step29 = "ALTER TABLE ".$db.".sub_categoria ENGINE InnoDB";
    $step30 = "CREATE TABLE ".$db.".vendedores (
            id_vendedor int(7) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nombre_vendedor varchar(60) NOT NULL,
            usuario varchar(15) NOT NULL,
            fecha_comienzo varchar(12) NOT NULL,
            zonas_id varchar(20) NOT NULL,
            estado_vendedor int(1) NOT NULL
        )";
    $step31 = "ALTER TABLE ".$db.".vendedores ENGINE InnoDB";
    $step32 = "CREATE TABLE ".$db.".ventas (
            id_venta int(25) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            n_venta int(20) NOT NULL,
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
        )";
    $step33 = "ALTER TABLE ".$db.".ventas ENGINE InnoDB";
    $step34 = "CREATE TABLE ".$db.".zonas (
            id_zona int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            num_zona_id int(4) NOT NULL,
            lugares varchar(200) NOT NULL
        )";
    $step35 = "ALTER TABLE ".$db.".zonas ENGINE InnoDB";
    $step36 = "INSERT INTO ".$db.".zonas(num_zona_id, lugares) VALUES (0, '')";

    $alt1 = "ALTER TABLE ".$db.".`clientes` ADD INDEX(`zona_id`)";
    $alt2 = "ALTER TABLE ".$db.".`clientes` ADD FOREIGN KEY (`zona_id`) REFERENCES `zonas`(`num_zona_id`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt3 = "ALTER TABLE ".$db.".`credeudas` ADD INDEX(`cliente_id`)";
    $alt4 = "ALTER TABLE ".$db.".`credeudas` ADD FOREIGN KEY (`cliente_id`) REFERENCES `clientes`(`id_cliente`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt5 = "ALTER TABLE ".$db.".`ncreditos` ADD INDEX(`venta_id`)";
    $alt6 = "ALTER TABLE ".$db.".`ncreditos` ADD FOREIGN KEY (`venta_id`) REFERENCES `ventas`(`id_venta`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt7 = "ALTER TABLE ".$db.".`productos` ADD INDEX(`sub_categ_id`)";
    $alt8 = "ALTER TABLE ".$db.".`productos` ADD FOREIGN KEY (`sub_categ_id`) REFERENCES `sub_categoria`(`id_sub_categ`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt9 = "ALTER TABLE ".$db.".`productos` ADD INDEX(`categoria_id`)";
    $alt10 = "ALTER TABLE ".$db.".`productos` ADD FOREIGN KEY (`categoria_id`) REFERENCES `categoria`(`id_categoria`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt11 = "ALTER TABLE ".$db.".`productos` ADD INDEX(`proveedor_id`)";
    $alt12 = "ALTER TABLE ".$db.".`productos` ADD FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores`(`id_proveedor`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt13 = "ALTER TABLE ".$db.".`sub_categoria` ADD INDEX(`categoria`)";
    $alt14 = "ALTER TABLE ".$db.".`sub_categoria` ADD FOREIGN KEY (`categoria`) REFERENCES `categoria`(`id_categoria`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt15 = "ALTER TABLE ".$db.".`ventas` ADD INDEX(`cliente_id`)";
    $alt16 = "ALTER TABLE ".$db.".`ventas` ADD FOREIGN KEY (`cliente_id`) REFERENCES `clientes`(`id_cliente`) ON DELETE RESTRICT ON UPDATE RESTRICT";
    $alt17 = "ALTER TABLE ".$db.".`ventas` ADD INDEX(`id_vend_venta`)";
    $alt18 = "ALTER TABLE ".$db.".`ventas` ADD FOREIGN KEY (`id_vend_venta`) REFERENCES `vendedores`(`id_vendedor`) ON DELETE RESTRICT ON UPDATE RESTRICT";

    $array_db = array($step1, $step2, $step3, $step4, $step5, $step6, $step7, $step8, $step9, $step10, $step11, $step12, $step13, $step14, $step15, $step16, $step17, $step18, $step19, $step20, $step21, $step22, $step23, $step24, $step25, $step26, $step27, $step28, $step29, $step30, $step31, $step32, $step33, $step34, $step35, $step36, $alt1, $alt2, $alt3, $alt4, $alt5, $alt6, $alt7, $alt8, $alt9, $alt10, $alt11, $alt12, $alt13, $alt14, $alt15, $alt16, $alt17, $alt18);

    // STEP BY STEP //
    if(isset($_POST['nstep'])){
        $step = $_POST['nstep'];
        try {
            mysqli_query($conn, $array_db[$step]);
            if($step == 53){
                $respuesta = array(
                    'respuesta' => 'finish'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'ok'
                );
            }
        } catch (\Throwable $th) {
            $respuesta = array(
                'respuesta' => 'error',
                'step' => $step
            );
        }
        die(json_encode($respuesta));
    }

?>