<?php
session_start();
session_destroy();
header("location: error/logout.php");
exit();
