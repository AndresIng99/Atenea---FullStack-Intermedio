<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Operaciones matemáticas</title>
</head>
<body>
   <form action="" method="post">
      <label for="num1">Digite el primer número</label>
      <input type="number" name="num1" id="num1">
      <br>
      <label for="num2">Digite el segundo número</label>
      <input type="number" name="num2" id="num2">
      <br>
      <label for="operacion">Selecione la operación a realizar </label>
      <br>
      <select name="operacion" id="operacion">
         <option value="1">Sumar</option>
         <option value="2">Restar</option>
         <option value="3">Multiplicar</option>
         <option value="4">Dividir</option>
      </select>
      <input type="submit" value="Operar" name="datos">
   </form>



   <?php
   if (isset($_POST['datos'])) {
      $numero1 = $_POST['num1'];
      $numero2 = $_POST['num2'];
      $operador = $_POST['operacion'];
      $total = 0;

      switch ($operador) {
         case 1:
             $total = $numero1 + $numero2;
             echo "La suma entre ".$numero1." y ".$numero2." es igual a = ".$total;
             break;
         case 2:
            $total = $numero1 - $numero2;
            echo "La resta entre ".$numero1." y ".$numero2." es igual a = ".$total;
             break;
         case 3:
            $total = $numero1 * $numero2;
            echo "La multiplicación entre ".$numero1." y ".$numero2." es igual a = ".$total;
             break;
         case 4:
            $total = $numero1 / $numero2;
            echo "La división entre ".$numero1." y ".$numero2." es igual a = ".$total;
             break;
     }

   }
   ?>
</body>
</html>