<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insertar producto</title>
  <?php require '../../util/functions.php' ?>
  <?php require '../../util/db_connection.php' ?>
</head>

<body>
  <?php
  #Validaciones
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $temp_nombre_producto = depurar($_POST["nombre_producto"]);
    $temp_precio = depurar($_POST["precio"]);
    $temp_descripcion = depurar($_POST["descripcion"]);
    $temp_cantidad = depurar($_POST["cantidad"]);

    #Imagen
    $nombre_imagen = $_FILES["imagen"]["name"];
    $tipo_imagen = $_FILES["imagen"]["type"];
    $tamano_imagen = $_FILES["imagen"]["size"];
    $ruta_temporal = $_FILES["imagen"]["tmp_name"];

    #Validaciones nombre_producto
    if (strlen($temp_nombre_producto) == 0) {
      $err_nombre_producto = "Este campo es obligatorio";
    } else if (strlen($temp_nombre_producto) > 40) {
      $err_nombre_producto = "El campo no puede exceder los 40 caracteres";
    } else if (!preg_match('/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ]+$/', $temp_nombre_producto)) {
      $err_nombre_producto = "Solo puede contener letras, numeros o espacios en blanco";
    } else {
      $nombre_producto = $temp_nombre_producto;
    }

    #Validaciones precio
    if (strlen($temp_precio) == 0) {
      $err_precio = "Este campo es obligatorio";
    } else if (!is_numeric($temp_precio)) {
      $err_precio = "Solo valen valores numericos";
    } else if ((float)$temp_precio < 0) {
      $err_precio = "No puedes introducir valores negativos";
    } else if ((float)$temp_precio > 99999.99) {
      $err_precio = "No puedes introducir valores mayores a 99999.99";
    } else {
      $precio = (float)$temp_precio;
    }

    #Validaciones descripcion
    if (strlen($temp_descripcion) == 0) {
      $err_descripcion = "Este campo es obligatorio";
    } else if (strlen($temp_descripcion) > 255) {
      $err_descripcion = "No puede tener mas de 255 caracteres";
    } else {
      $descripcion = $temp_descripcion;
    }

    #Cantidad
    if (strlen($temp_cantidad) == 0) {
      $err_cantidad = "Este campo es obligatorio";
    } else if (!is_numeric($temp_cantidad)) {
      $err_cantidad = "Solo valen valores numericos";
    } else if ((float)$temp_cantidad < 0) {
      $err_cantidad = "No puedes introducir valores negativos";
    } else if ((float)$temp_cantidad > 99999) {
      $err_cantidad = "No puedes introducir valores mayores a 99999";
    } else {
      $cantidad = $temp_cantidad;
    }

    #Validaciones imagen
    if ($_FILES["imagen"]["error"] == 4 || $tamano_imagen == 0 && $_FILES["imagen"]["error"] == 0) {
      $err_imagen = "Inserte un archivo";
    } else if (!exif_imagetype($ruta_temporal)) {
      $err_imagen = "Debe ser formato imagen";
    } else {
      $ruta_final = "../../resources/images/" . $nombre_imagen;
    }
  }
  ?>
  <div>
    <h4 class="fw-semibold mb-8">Inser product</h4>
    <div>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-floating mb-3">
          <input type="text" name="nombre_producto" class="form-control border border-warning">
          <label></i><span class="border-start border-warning ps-3">Product name</span></label>
        </div>
        <?php if (isset($err_nombre_producto)) echo "<label style='color: red;'>" . $err_nombre_producto . "</label>" ?>
        <div class="form-floating mb-3">
          <input type="text" name="precio" class="form-control border border-warning">
          <label></i><span class="border-start border-warning ps-3">Prize</span></label>
        </div>
        <?php if (isset($err_precio)) echo "<label style='color: red;'>" . $err_precio . "</label>" ?>
        <div class="form-floating mb-3">
          <input type="text" name="descripcion" class="form-control border border-warning">
          <label></i><span class="border-start border-warning ps-3">Description</span></label>
        </div>
        <?php if (isset($err_descripcion)) echo "<label style='color: red;'>" . $err_descripcion . "</label>" ?>
        <div class="form-floating mb-3">
          <input type="text" name="cantidad" class="form-control border border-warning">
          <label></i><span class="border-start border-warning ps-3">Quantity</span></label>
        </div>
        <?php if (isset($err_cantidad)) echo "<label style='color: red;'>" . $err_cantidad . "</label>" ?>
        <div class="mb-3">
          <input type="file" name="imagen" class="form-control border-warning">
          <?php if (isset($err_imagen)) echo "<label style='color: red;'>" . $err_imagen . "</label>" ?>
        </div>
        <button type="submit" class="btn btn-warning font-medium rounded-pill px-4">
          <div class="d-flex align-items-center">
            <i class="ti ti-send me-2 fs-4"></i>
            Submit
          </div>
        </button>
      </form>
    </div>
  </div>
  <?php
  if (isset($nombre_producto) && isset($precio) && isset($descripcion) && isset($cantidad) && isset($ruta_final)) {
    $sql = "INSERT INTO productos (nombreProducto, precio, descripcion, cantidad, imagen) VALUES ('$nombre_producto', $precio, '$descripcion', $cantidad, '$ruta_final')";
    echo "<br>";
    echo "<label style='color: orange'>" . "Producto insertado correctamente" . "</label>";
    if ($conexion->query($sql)) {
      move_uploaded_file($ruta_temporal, $ruta_final);
      echo "<script>console.log('Producto insertado correctamente');</script>";
    } else {
      echo "<script>console.log('Error: " . $sql . "<br>" . $conexion->error . "');</script>";
    }
  }

  ?>
</body>

</html>