<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
   if (isset($_GET['datos'])) {
      $cedula = $_GET['cedula'];
      $apellido = $_GET['apellido'];
      $nombre = $_GET['nombre'];

      echo "Nombre: ".$nombre."<br>";
      echo "Apellido: ".$apellido."<br>";
      echo "Cédula: ".$cedula."<br>";
   }
   ?>
</body>
</html>