<?php

    $database = 'sisconsy_huellitas1_sa';
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
        echo $cons;
    } catch (\Throwable $th) {
        echo "Error: ".$th->getMessage();
    }

?>