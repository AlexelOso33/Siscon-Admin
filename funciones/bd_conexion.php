<?php
    
    $user = 'admin_siscon';
    $password = 'alex3344/';
    $db = 'sisconsy_admin_data';
    $host = 'localhost';
    
    $conn = mysqli_connect($host, $user, $password, $db);
    $conn->set_charset('utf8');

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
    }

?>