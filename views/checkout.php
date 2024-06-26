<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>InterWorks</title>

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
    <?php acces_control_basic(); ?>
    <?php require './header.php'; ?>
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">view cart</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="./index.php">Home</a></li>
                        <li class="active">view cart</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "eliminarProducto") {
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
            //Actualizar el total en la base de datos
            $precioTotal = 0;
            $sql = "SELECT * FROM productoscestas where idCesta = (SELECT idCesta FROM cestas WHERE usuario='$usuario')";
            $resultado = $conexion->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                $precio = "SELECT precio FROM productos WHERE idProducto = '$fila[idProducto]'";
                $resultado = $conexion->query($precio);
                $precio = $resultado->fetch_assoc()["precio"];
                $precioTotal += $precio * $fila["cantidad"];
            }
            $sql = "UPDATE cestas SET precioTotal = '$precioTotal' WHERE usuario = '$usuario'";
            $conexion->query($sql);
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
            $fila["cantidad"]
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
                                        <th>Prize</th>
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
                                $precioTotal = 0;
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
                                        <?php $precio = "SELECT precio FROM productos WHERE idProducto = '$productocesta->idProducto'";
                                        $resultado = $conexion->query($precio);
                                        $precio = $resultado->fetch_assoc()["precio"];
                                        //Calculamos tambien el total de la compra
                                        $precioTotal += $precio * $productocesta->cantidad;
                                        $sql = "UPDATE cestas SET precioTotal = '$precioTotal' WHERE usuario = '$usuario'";
                                        $conexion->query($sql);
                                        ?>
                                        <td><?php echo (int)$precio ?> </td>
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
                                                <input class="btn btn-danger" type="submit" value="Delete">
                                                <input name="action" type="hidden" value="eliminarProducto">
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div> <!-- Formulario realizar el pedido / Comprobar que hay cosas en el carrito -->
        <div class="text-right mt-4">
            <h4>Total: <span id="precioTotal" class="badge badge-success"><?php echo $precioTotal . "€" ?></span></h4>
        </div>
        <?php
        $sql = "SELECT * FROM productoscestas where idCesta = (SELECT idCesta FROM cestas WHERE usuario='$usuario')";
        $resultado = $conexion->query($sql);
        if ($resultado->num_rows > 0) { ?>

            <form action="./shopping-cart/realizar_pedido.php" method="post">
                <div class="text-right mt-4">
                    <input class="btn btn-success" type="submit" value="Purchase">
                    <input type="hidden" name="action" value="realizarPedido">
                </div>
            </form>
        <?php
        }
        ?>
    </div>
    </div>
    <?php require './footer.php'; ?>