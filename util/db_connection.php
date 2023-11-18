<?php
$servidor = 'localhost';
$usuario = 'root';
$contrasena = 'victor2002';
$base_de_datos = 'db_tienda';

$conexion = new MySQLi(
  $servidor,
  $usuario,
  $contrasena,
  $base_de_datos
)
  or die("Error en la conexión");
