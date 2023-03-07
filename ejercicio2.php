<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edad</title>
</head>
<body>
   <form action="" method="post">
      <label for="edad">Ingrese su edad =</label>
      <input type="number" name="edad" id="edad">
      <br>
      <input type="submit" value="Validar" name="datos">
   </form>



   <?php
   if (isset($_POST['datos'])) {
      $edad = $_POST['edad'];

      if ($edad < 18) {
        echo "Es menor de edad";
      }else{
        echo "Es mayor de edad";
      }

   }
   ?>
</body>
</html>