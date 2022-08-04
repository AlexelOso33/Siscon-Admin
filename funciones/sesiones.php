<?php

function usuario_autenticado() {
    if(!revisar_usuario()) {
        /* $inactividad = 600;
        if(isset($_SESSION["timeout"])){
            $sessionTTL = time() - $_SESSION["timeout"];
            if($sessionTTL > $inactividad){
                session_destroy();
                header("Location: login.php?type=tosession");
            }
        }
        $_SESSION["timeout"] = time();
    } else { */
        header('Location: ../pages/login.php');
        exit();
    }
}

function revisar_usuario() {
    return isset($_SESSION['usuario']);
}

session_start();
usuario_autenticado();
session_regenerate_id();

$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");

?>