<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Interworks</title>

    <!-- Google font -->
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" type="image/png" href="./img/logo-removebg-preview.png" />
    <?php require '../util/acess_control.php'; ?>
    <?php require "../util/db_connection.php" ?>
    <?php require "./shopping-cart/object_cesta.php" ?>
    <?php require "../util/product.php" ?>
</head>

<body>
    <!-- HEADER -->
    <?php acces_control_basic();  
    ?>
    <?php include '../public/header.php'; ?>
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Checkout</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="./index.php">Home</a></li>
                        <li class="active">Checkout</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productocesta = $_POST["productocesta"];

        // Obtener la cantidad del producto en la cesta
        $sqlCantidad = "SELECT cantidad FROM productoscestas WHERE IdCesta IN (SELECT IdCesta FROM cestas WHERE usuario='$usuario') AND idProducto='$productocesta'";
        $resultadoCantidad = $conexion->query($sqlCantidad);
        $cantidadEliminada = $resultadoCantidad->fetch_assoc()["cantidad"];

        // Eliminar el producto de la cesta
        $sqlDelete = "DELETE FROM productoscestas WHERE IdCesta IN (SELECT IdCesta FROM cestas WHERE usuario='$usuario') AND idProducto='$productocesta'";
        if ($conexion->query($sqlDelete)) { //alert de producto eliminado
            echo '<script> 
            Swal.fire({icon: "success",
            title: "Product removed from cart",
            showConfirmButton: false,
            timer: 1000});</script>';
            // Actualizar la cantidad del producto en la tabla de productos
            $sqlUpdate = "UPDATE productos SET cantidad = cantidad + $cantidadEliminada WHERE idProducto = '$productocesta'";
            $conexion->query($sqlUpdate);
        } else {
            echo "Error al eliminar el producto de la cesta: " . $conexion->error;
        }
    }
    ?>

    <?php
    //productoscestas
    $sql = "SELECT * FROM productoscestas where idCesta = (SELECT idCesta FROM cestas WHERE usuario='$usuario')";
    $resultado = $conexion->query($sql);

    $productoscesta = [];

    while ($fila = $resultado->fetch_assoc()) {
        $nuevo_productocesta = new Productocesta(
            $fila["idProducto"],
            $fila["idCesta"],
            $fila["cantidad"],
        );
        array_push($productoscesta, $nuevo_productocesta);
    }

    //productos
    $sql2 = "SELECT * FROM productos";
    $resultado = $conexion->query($sql2);

    $productos = [];

    // Creación de objetos Producto a partir de los resultados de la consulta
    while ($fila = $resultado->fetch_assoc()) {
        $nuevo_producto = new Producto(
            $fila["idProducto"],
            $fila["nombreProducto"],
            $fila["precio"],
            $fila["descripcion"],
            $fila["cantidad"],
            $fila["imagen"]
        );
        array_push($productos, $nuevo_producto);
    }
    ?>

    <div class="container" data-aos="zoom-in-up">
        <div class="row">
            <div class="col-md-offset-1 col-md-20">
                <div class="panel">
                    <div class="panel-body table-responsive">
                        <?php
                        // Verifica si hay productos para mostrar y agrega el encabezado de la tabla si es necesario
                        if (!empty($productoscesta)) {
                        ?>
                            <table class="table border border-warning">
                                <thead>
                                    <tr>
                                        <th>Product name</th>
                                        <th>Quantity</th>
                                        <th>Product</th>
                                        <th>Remove product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                            } else {
                                echo "<h3 class='at-item'><b>No items in your shopping cart</b><i class='fa fa-shopping-cart'></i></h3>";
                            }
                                ?>

                                <?php
                                foreach ($productoscesta as $productocesta) { ?>
                                    <tr>
                                        <td><?php
                                            foreach ($productos as $nuevo_producto) {
                                                if ($productocesta->idProducto == $nuevo_producto->idProducto) {
                                                    break;
                                                }
                                            }
                                            echo $nuevo_producto->nombreProducto ?>
                                        </td>
                                        <td><?php echo $productocesta->cantidad ?> </td>
                                        <td><?php
                                            foreach ($productos as $nuevo_producto) {
                                                if ($productocesta->idProducto == $nuevo_producto->idProducto) {
                                                    break;
                                                }
                                            }
                                            ?>
                                            <?php $ruta =  $nuevo_producto->imagen;
                                            $ruta = str_replace('../../', '../', $ruta); ?>
                                            <img src="<?php echo $ruta; ?>" alt="imagen-producto" width="35">
                                        </td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="productocesta" value="<?php echo $productocesta->idProducto ?>">
                                                <input class="btn btn-danger" type="submit" value="Eliminar">
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- NEWSLETTER -->
    <div id="newsletter" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Enter Your Email">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /NEWSLETTER -->

    <!-- FOOTER -->
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                <li><a href="#">Hot deals</a></li>
                                <li><a href="#">Laptops</a></li>
                                <li><a href="#">Smartphones</a></li>
                                <li><a href="#">Cameras</a></li>
                                <li><a href="#">Accessories</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>