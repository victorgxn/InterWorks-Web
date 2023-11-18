<!DOCTYPE html>
<html lang="en">

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
    <link rel="shortcut icon" type="image/png" href="../src-modernize/assets/images/interworks/logo-removebg-preview.png" />
    <link rel="stylesheet" href="../src-modernize/assets/css/styles.min.css" />
    <?php require '../util/db_connection.php' ?>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contrasena"];

        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $hash_contrasena = $fila["contrasena"];
                $rol = $fila["rol"];
            }
            $acceso_valido =
                password_verify($contrasena, $hash_contrasena);

            if ($acceso_valido == TRUE) {
                session_start();
                $_SESSION["usuario"] = $usuario;
                $_SESSION["rol"] = $rol;

                header('location: ../views/index.php');
            } else {
                $err_user = "The user or password is incorrect";
            }
        } else {
            $err_user = "The user or password is incorrect";
        }
    }
    //Probar radial-gradient si no me gusta como se ve el fondo
    ?>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <img src="../src-modernize/assets/images/interworks/logo-removebg-preview.png" width="180" alt="" class="mx-auto d-block img-fluid">
                                </a>
                                <p class="text-center text-dark">Building the future with technology</p>
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Username</label>
                                        <input name="usuario" type="text" class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input name="contrasena" type="password" class="form-control" id="exampleInputPassword1">
                                        <?php if (isset($err_user)) echo "<label style='color: red;'>" . $err_user . '</label>' ?>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Remeber this Device
                                            </label>
                                        </div>
                                        <a class="text-primary fw-bold" href="./error/error.php">Forgot Password ?</a>
                                    </div>
                                    <input type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2 btn-warning" value="Sign In">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">New to InterWork?</p>
                                        <a class="text-primary fw-bold ms-2" href="../public/register.php">Create an account</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>