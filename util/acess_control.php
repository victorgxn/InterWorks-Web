<?php
function acces_control_basic()
{
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: ../index.php');
    }
}

function acces_control_admin()
{
    session_start();
    if (isset($_SESSION["rol"])) {
        if ($_SESSION["rol"] != "admin") {
            header('Location: ../index.php');
        }
    }
}
