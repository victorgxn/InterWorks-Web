<?php
    session_start();
    session_unset();
    session_destroy();
    session_start();
    $_SESSION["usuario"] = "invitado";  
    header("location: error/logout.php");
    exit();
