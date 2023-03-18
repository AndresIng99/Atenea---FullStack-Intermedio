<!DOCTYPE html>
<html>
<head>
  <title>Bucle Hola Mundo</title>
</head>
<body>
  <h1>Bucle Hola Mundo</h1>
  <form method="post">
    <label for="cant_veces">Ingrese la cantidad de veces que desea repetir "a la de":</label>
    <input type="number" id="cant_veces" name="cant_veces" required>
    <br>
    <button type="submit">Repetir</button>
  </form>

  <?php
  if (isset($_POST['cant_veces'])) {
    $cant_veces = $_POST['cant_veces'];
    for ($i = 1; $i <= $cant_veces; $i++) {
      echo "a la de $i <br>";
    }
  }
  ?>
</body>
</html> 