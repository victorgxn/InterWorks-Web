<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin dashboard - InterWorks</title>
    <link rel="stylesheet" href="../../src-modernize/assets/css/styles.min.css" />
    <link rel="shortcut icon" type="image/png" href="../../src-modernize/assets/images/interworks/logo-removebg-preview.png" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php require '../../util/acess_control.php'; ?>
    <?php require '../../util/db_connection.php'; ?>
    <?php require '../../util/user.php'; ?>
</head>

<body>
    <?php acces_control_admin(); ?>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <img src="../../src-modernize/assets/images/interworks/logo-removebg-preview.png" width="180" alt="" class="img-fluid mx-auto d-block" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./admin.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Main page</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="../../views/index.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-shopping-cart"></i>
                                </span>
                                <span class="hide-menu">Web</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Products</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./new_product.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">New Product</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./inventory.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-basket"></i>
                                </span>
                                <span class="hide-menu">Inventory</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Users</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./user_list.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-circle"></i>
                                </span>
                                <span class="hide-menu">Users list</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <div class="container-fluid">
                <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4 border border-warning">
                    <div class="card-body px-4 py-3">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h4 class="fw-semibold mb-8">User list</h4>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a class="text-muted text-decoration-none" href="../../views/index.php">Main page</a>
                                        </li>
                                        <li class="breadcrumb-item" aria-current="page">
                                            <a class="text-muted text-decoration-none" href="../../views/index.php">Shop</a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <img src="../../views/img/logo-removebg-preview.png" alt="" class="img-fluid mb-n4" width="110">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body border border-warning">
                        <div class="container ">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <a class="btn btn-primary d-lg-none d-flex" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                    <i class="ti ti-menu-2 fs-6"></i>
                                </a>
                                <h5 class="fs-5 fw-semibold mb-0 d-none d-lg-block">Users table</h5>
                                <form class="position-relative ">
                                    <input type="text" class="form-control search-chat py-2 ps-5 border border-warning" id="text-srh" placeholder="Search user">
                                    <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-md-offset-1 col-md-20">
                                    <div class="panel">
                                        <div class="panel-body table-responsive">
                                            <table class="table border border-warning">
                                                <thead>
                                                    <tr>
                                                        <th>Usuario</th>
                                                        <th>Gmail</th>
                                                        <th>Fecha de nacimiento</th>
                                                        <th>Rol</th>
                                                        <th>Admin powers</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $sql = "SELECT * FROM usuarios";
                                                    $resultado = $conexion->query($sql);

                                                    $usuarios = [];

                                                    while ($fila = $resultado->fetch_assoc()) {
                                                        $nuevo_usuario = new Usuario(
                                                            $fila["usuario"],
                                                            $fila["contrasena"],
                                                            $fila["fechaNacimiento"],
                                                            $fila["rol"]
                                                        );
                                                        array_push($usuarios, $nuevo_usuario);
                                                    }
                                                    ?> <?php
                                                        // Dar poderes de admin
                                                        if (isset($_POST["poderAdmin"])) {
                                                            $nombreUsuario = $_POST["nombreUsuario"];
                                                            $sql = "UPDATE usuarios SET rol = 'admin' where usuario = '$nombreUsuario' ";
                                                            $resultado = $conexion->query($sql);
                                                            if ($resultado) {
                                                                echo '<script>
                                                            Swal.fire({icon: "success",
                                                            title: "Admin powers granted!",
                                                            showConfirmButton: false,
                                                            timer: 1000
                                                        });</script>';
                                                            } else {
                                                                echo '<script>alert("Error: ' . $sql3 . '\n' . $conexion->error . '");</script>';
                                                            }
                                                        }
                                                        ?>
                                                    <?php
                                                    // Quitar poderes de admin
                                                    if (isset($_POST["quitarPoderAdmin"])) {
                                                        $nombreUsuario = $_POST["nombreUsuario"];
                                                        $sql = "UPDATE usuarios SET rol = 'cliente' where usuario = '$nombreUsuario' ";
                                                        $resultado = $conexion->query($sql);
                                                        if ($resultado) {
                                                            echo '<script>
                                                            Swal.fire({
                                                                icon: "success",
                                                                title: "Deleted admin powers!",
                                                                showConfirmButton: false,
                                                                timer: 1000,
                                                            });
                                                        </script>';
                                                        } else {
                                                            echo '<script>alert("Error: ' . $sql3 . '\n' . $conexion->error . '");</script>';
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    foreach ($usuarios as $usuario) { ?>
                                                        <tr>
                                                            <td><?php echo $usuario->usuario ?> </td>
                                                            <td>
                                                                <?php
                                                                $nombre_usuario = $usuario->usuario;
                                                                $correo_electronico = $nombre_usuario . "@gmail.com";
                                                                echo $correo_electronico;
                                                                ?>
                                                            </td>
                                                            <td><?php echo $usuario->fechaNacimiento ?> </td>
                                                            <td><?php echo $usuario->rol ?> </td>
                                                            <td>
                                                                <?php if ($usuario->rol != 'admin') { ?>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" name="nombreUsuario" value="<?php echo $usuario->usuario ?>">
                                                                        <input type="hidden" name="poderAdmin" value="true">
                                                                        <input class="btn btn-warning" type="submit" value="Give powers">
                                                                    </form>
                                                                <?php } else {
                                                                ?>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" name="nombreUsuario" value="<?php echo $usuario->usuario ?>">
                                                                        <input type="hidden" name="quitarPoderAdmin" value="true">
                                                                        <input class="btn btn-danger" type="submit" value="Delete powers">
                                                                    </form>
                                                                    <?php
                                                                    ?>
                                                            </td>
                                                        <?php } ?>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../src-modernize/assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="../../src-modernize/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../../src-modernize/assets/js/sidebarmenu.js"></script>
        <script src="../../src-modernize/assets/js/app.min.js"></script>
        <script src="../../src-modernize/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
        <script src="../../src-modernize/assets/libs/simplebar/dist/simplebar.js"></script>
        <script src="../../src-modernize/assets/js/dashboard.js"></script>
</body>

</html>