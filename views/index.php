<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Interworks</title>
	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="./css/style.css" />
	<!-- Sweet alert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- Icon page -->
	<link rel="shortcut icon" type="image/png" href="./img/logo-removebg-preview.png" />
	<?php require "../util/db_connection.php" ?>
	<?php require '../util/product.php'; ?>
	<?php require '../util/acess_control.php'; ?>
</head>

<body>
	<?php session_start() ?>
	<?php require '../public/header.php'; ?>
	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="./img/shop01.png" alt="">
						</div>
						<div class="shop-body">
							<h3>Laptop<br>Collection</h3>
							<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->

				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="./img/shop03.png" alt="">
						</div>
						<div class="shop-body">
							<h3>Accessories<br>Collection</h3>
							<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->

				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<div class="shop">
						<div class="shop-img">
							<img src="./img/shop02.png" alt="">
						</div>
						<div class="shop-body">
							<h3>Cameras<br>Collection</h3>
							<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- /shop -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<?php
	$sql = "SELECT * FROM productos";
	$resultado = $conexion->query($sql);

	$productos = [];

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
	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST["addProduct"])) {
			$idProducto = $_POST["idProducto"];
			$cantidad = (int)$_POST["cantidad"];

			$sql3 = "INSERT INTO productoscestas (idProducto, idCesta, cantidad) VALUES ('$idProducto', (SELECT idCesta FROM cestas WHERE usuario = '$usuario'), '$cantidad')";

			if ($conexion->query($sql3)) { //alert de producto añadido
				echo '<script>
            Swal.fire({icon: "success",
            title: "Product added to the cart",
            showConfirmButton: false,
            timer: 1000});</script>';
				//actualiza la cantidad de productos
				$sql4 = "UPDATE productos SET cantidad = cantidad - '$cantidad' WHERE idProducto = '$idProducto'";
				$conexion->query($sql4);
			} else {
				echo "Error: " . $sql3 . "<br>" . $conexion->error;
			}
		}
	}
	?>
	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">New Products</h3>
						<div class="section-nav">
							<ul class="section-tab-nav tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
								<li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
								<li><a data-toggle="tab" href="#tab1">Cameras</a></li>
								<li><a data-toggle="tab" href="#tab1">Accessories</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /section title -->

				<!-- Products tab & slick -->
				<div class="col-md-12">
					<div class="row">
						<div class="products-tabs">
							<!-- tab -->
							<div id="tab1" class="tab-pane active">
								<div class="products-slick" data-nav="#slick-nav-1">
									<!-- product -->
									<?php foreach ($productos as $producto) : ?>
										<div class="product">
											<div class="product-img">
												<?php $ruta =  $producto->imagen;
												$ruta = str_replace('../../', '../', $ruta); ?>
												<img src="<?php echo $ruta; ?>" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<h3 class="product-name"><a href="#"><?php echo $producto->nombreProducto; ?></a></h3>
												<h5 class="product-category"><?php echo $producto->descripcion; ?></h5>
												<h4 class="product-price"><?php echo $producto->precio . " €"; ?><del class="product-old-price"><?php echo (($producto->precio) + 120) . " €"; ?></del></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													<?php
													if ($usuario != "invitado" && $producto->cantidad > 0) {
													?>
														<form action="" method="POST">
															<select name="cantidad" class="form-control">
																<option value="" selected disabled hidden>Selecciona una cantidad</option>
																<?php
																for ($i = 1; $i <= $producto->cantidad; $i++) {
																	echo "<option value='$i'>$i</option>";
																}
																?>
															</select>
															<div class="mb-2">
																<input type="hidden" name="idProducto" value="<?php echo $producto->idProducto ?>">
																<input type="hidden" name="addProduct" value="true">
															</div>
												</div>
											</div>
											<div class="add-to-cart">
												<button class="add-to-cart-btn"><i class="fa fa-shopping-cart" name="btnAccion" value="Agregar" type="submit"></i> add to cart</button>
											</div>
											</form>
										<?php
													} else if ($producto->cantidad == 0) {
										?>

											<h3 class="product-name">Out of stock</h3>
										</div>
								</div>
							<?php
													} else { ?>
							</div>
						</div>
						<div class="add-to-cart">
							<a href="../public/log_in.php">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Sign in</button>
							</a>
						</div>
					<?php } ?>
					</div>
				<?php endforeach; ?>
				<!-- /product -->
				</div>

				<div id="slick-nav-1" class="products-slick-nav"></div>
			</div>
			<!-- /tab -->
		</div>
	</div>
	</div>
	<!-- Products tab & slick -->
	</div>
	<!-- /row -->
	</div>
	<!-- /container -->
	</div>
	<!-- /SECTION -->

	<?php require "./footer.php" ?>