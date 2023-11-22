<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>InterWorks</title>

    <!-- Google font -->
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="./css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="./css/slick.css" />
    <link type="text/css" rel="stylesheet" href="./css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="./css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="./css/font-awesome.min.css">

    <!-- Bootstrap -->

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="./css/style.css" />
    <link rel="shortcut icon" type="image/png" href="./img/logo-removeblanco-preview.png" />
    <?php require '../util/acess_control.php'; ?>
</head>

<body>
    <!-- HEADER -->
    <?php acces_control_basic(); ?>
    <?php require './header.php'; ?>

    <div class="section">
    <div class="container">
        <div class="row d-flex align-items-center">

            <?php echo "<h3 class='at-item'><b>Compra realizada, gracias por comprar en InterWorks </b><i class='fa fa-shopping-cart'></i></h3>" ?>

            <!-- Primer botón con estilo en línea -->
            <a href="./index.php" class="btn btn-warning" style="margin-right: 10px;">Go back to the shop</a>

            <!-- Segundo botón con estilo en línea -->
            <form action="./pdf/invoice.php" class="d-inline-block">
                <input type="submit" class="btn btn-info" value="Download the bill" />
            </form>

        </div>
    </div>
</div>





    <?php require './footer.php'; ?>