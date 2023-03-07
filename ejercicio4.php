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
      <label>Seleccione su fecha de nacimiento: </label>
      <input type="date" name="edad">
      <br>
      <input type="submit" value="Validar" name="datos">
   </form>



   <?php
   if (isset($_POST['datos'])) {
      $edad = new DateTime($_POST['edad']);
      $fecha_act =  date('Y-m-d');

    $date2 = new DateTime($fecha_act);

      $diff = $edad->diff($date2);


      $años = $diff->y;
      $meses = $diff->m;
      $dias = $diff->d;

      if ($años < 18) {
        echo "Tiene ".$años." años, ".$meses." meses ".$dias." dias por tanto es menor de edad";
      }else{
         echo "Tiene ".$años." años, ".$meses." meses ".$dias." dias por tanto es meyor de edad";
      }


   }
   ?>
</body>
</html>