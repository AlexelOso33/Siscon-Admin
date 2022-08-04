<?php
    
    $user = 'sisconsy_admin';
    $password = 'sis25/33?con';
    $db = 'sisconsy_admin_data';
    $host = 'localhost';
    
    $conn = mysqli_connect($host, $user, $password, $db);
    $conn->set_charset('utf8');

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
    }

?>