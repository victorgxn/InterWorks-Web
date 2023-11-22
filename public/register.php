<!DOCTYPE html>
<html lang="es">

<head>
    <style>
        body {
            background-image: url('../src-modernize/assets/images/interworks/wallpaper2.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InterWorks</title>
    <link rel="shortcut icon" type="image/png" href="../src-modernize/assets/images/interworks/logo-removebg-preview.png" />
    <link rel="stylesheet" href="../src-modernize/assets/css/styles.min.css" />
    <?php require '../util/functions.php' ?>
    <?php require '../util/db_connection.php' ?>
</head>

<body>
    <?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $temp_usuario = depurar($_POST["usuario"]);
        $temp_contrasena = depurar($_POST["contrasena"]);
        $temp_fechaNacimiento = depurar($_POST["fechaNacimiento"]);

        $sql = "SELECT * FROM usuarios WHERE usuario = '$temp_usuario'";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $err_usuario = "The user already exists";
        }

        # Validar usuario
        if (strlen($temp_usuario) == 0) {
            $err_usuario = "The name is required";
        } else {
            if (strlen($temp_usuario) > 12 || strlen($temp_usuario) < 4) {
                $err_usuario = "The name must be between 4 and 12 characters";
            } else {
                $patron = "/^[A-Za-z_]{4,12}$/";
                if (!preg_match($patron, $temp_usuario)) {
                    $err_usuario = "The name can only contain letters and underscores";
                } else {
                    $usuario = $temp_usuario;
                }
            }
        }

        # Validar contrasena
        if (strlen($temp_contrasena) == 0) {
            $err_contrasena = "The password is required";
        } else {
            if (strlen($temp_contrasena) > 255 || strlen($temp_contrasena) < 4) {
                $err_contrasena = "The password must be between 4 and 255 characters ";
            } else {
                $patron = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/";
                if (!preg_match($patron, $temp_contrasena)) {
                    $err_contrasena = "The password must contain at least one lowercase letter, one uppercase letter, one number and one special character";
                } else {
                    $contrasena = $temp_contrasena;
                    $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
                }
            }
        }

        # Validar fecha de nacimiento
        if (strlen($temp_fechaNacimiento) == 0) {
            $err_fechaNacimiento = "The birth date is required";
        } else {
            $fecha_actual = date("Y-m-d");
            list($anyo_actual, $mes_actual, $dia_actual) = explode('-', $fecha_actual);
            list($anyo, $mes, $dia) = explode('-', $temp_fechaNacimiento);
            if ($anyo_actual - $anyo > 12 && $anyo_actual - $anyo < 120) {
                $fechaNacimiento = $temp_fechaNacimiento;
            } else if ($anyo_actual - $anyo < 12) {
                $err_fechaNacimiento = "You can't be under 12 years old";
            } else if ($anyo_actual - $anyo > 120) {
                $err_fechaNacimiento = "You can't be over 120 years old";
            } else {
                if ($mes_actual - $mes < 0) {
                    $fechaNacimiento = $temp_fechaNacimiento;
                } else if ($mes_actual - $mes < 0) {
                    $err_fechaNacimiento = "Month is not valid";
                } else {
                    if ($dia_actual - $dia >= 0) {
                        $fechaNacimiento = $temp_fechaNacimiento;
                    } else {
                        $err_fechaNacimiento = "Day is not valid";
                    }
                }
            }
        }
    }
    ?>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-nav-barbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <img src="../src-modernize/assets/images/interworks/logo-removebg-preview.png" width="180" alt="" class="mx-auto d-block">
                                </a>
                                <p class="text-center">Building the future with technology</p>
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="exampleInputtext1" class="form-label">Name</label>
                                        <input type="text" name="usuario" class="form-control">
                                        <?php if (isset($err_usuario)) echo "<label style='color: red;'>" . $err_usuario . '</label>' ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="contrasena" class="form-control">
                                        <?php if (isset($err_contrasena)) echo "<label style='color: red;'>" . $err_contrasena . '</label>' ?>
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputEmail1" class="form-label">Birth date</label>
                                        <input type="date" name="fechaNacimiento" class="form-control">
                                        <?php if (isset($err_fechaNacimiento)) echo "<label style='color: red;'>" . $err_fechaNacimiento . '</label>' ?>
                                    </div>
                                    <input type="submit" value="Sign Up" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2 btn-warning"> <!-- Registrarse input -->
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                        <a class="text-primary fw-bold ms-2" href="../public/log_in.php">Sign In</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($usuario) && isset($contrasena_cifrada) && isset($fechaNacimiento)) {

        $sql = "SELECT * FROM usuarios WHERE usuario = '$temp_usuario'";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $err_usuario = "El usuario ya existe";
        } else {
            $sql = "INSERT INTO usuarios (usuario, contrasena, fechaNacimiento) VALUES ('$usuario', '$contrasena_cifrada', '$fechaNacimiento')";
            $sql2 = "INSERT INTO cestas (usuario, precioTotal) VALUES ('$usuario', 0)";
            if ($conexion->query($sql) && $conexion->query($sql2)) {
                header('location: log_in.php');
                exit();
            } else {
                $err_usuario = "El usuario ya existe";
            }
        }
    }

    ?>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>