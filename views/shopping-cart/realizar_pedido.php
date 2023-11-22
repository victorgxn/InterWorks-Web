<?php
require "../../util/db_connection.php";
session_start();
$usuario = $_SESSION["usuario"];
if ($_SERVER["REQUEST_METHOD"] && $_POST["action"] == "realizarPedido") {
    // get the id of the cesta
    $sqlCesta = "SELECT idCesta FROM cestas WHERE usuario = '$usuario'";
    $resultadoCesta = $conexion->query($sqlCesta);
    $filaCesta = $resultadoCesta->fetch_assoc();
    $idCesta = $filaCesta['idCesta'];

    // get the total price of the cesta
    $sql = "SELECT precioTotal from cestas WHERE idCesta = '$idCesta'";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
    $precioTotal = $fila['precioTotal'];

    // insert the order in the table Pedidos
    $sql = "INSERT INTO pedidos (usuario, precioTotal) VALUES ('$usuario', '$precioTotal')";
    $conexion->query($sql);

    // get the id of the order
    $sql = "SELECT idPedido FROM pedidos WHERE usuario = '$usuario' ORDER BY idPedido DESC LIMIT 1";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
    $idPedido = $fila['idPedido'];

    // insert the products of the cesta in the table LineasPedidos
    $sql = "SELECT * FROM productoscestas WHERE idCesta = '$idCesta'";
    $resultado = $conexion->query($sql);
    $lineaPedido = 1;
    while ($fila = $resultado->fetch_assoc()) {
        $idProducto = $fila['idProducto'];
        $sql = "SELECT precio FROM productos WHERE idProducto = '$idProducto'";
        $resultado2 = $conexion->query($sql);
        $fila = $resultado2->fetch_assoc();
        $precioUnitario = $fila['precio'];
        $sql = "SELECT cantidad FROM productoscestas WHERE idProducto = '$idProducto' AND idCesta = '$idCesta'";
        $resultado3 = $conexion->query($sql);
        $fila = $resultado3->fetch_assoc();
        $cantidad = $fila['cantidad'];

        // insert the product in the table LineasPedidos
        $sql = "INSERT INTO lineaspedidos (lineaPedido,idProducto, idPedido, precioUnitario,cantidad) VALUES ('$lineaPedido','$idProducto', '$idPedido', '$precioUnitario', '$cantidad')";
        $conexion->query($sql);
        $lineaPedido++;
    }

    // delete the products of the cesta
    $sql = "DELETE FROM productoscestas WHERE idCesta = '$idCesta'";
    $conexion->query($sql);

    // update the price of the cesta to 0
    $sql = "UPDATE cestas SET precioTotal = 0 WHERE usuario = '$usuario'";
    $conexion->query($sql);

    header("Location: ../purchase.php");
}
