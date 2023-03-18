<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador</title>
</head>
<body>
<h3>Ingrese el mensaje y el numero de veces que quiere que se repita</h3>
    <form action="" method="post">
        <input type="text" name="mensaje" placeholder="Ingrese el mensaje">
        <input type="number" name="cant_repeticiones" placeholder="Ingrese la cantidad de repeticiones del mensaje">
        <input type="submit" name="datos" value="Repetir">
    </form>
<?php

if (isset($_POST['datos'])) {
    $mensaje = $_POST['mensaje'];
    $cant_repeticiones = $_POST['cant_repeticiones'];

    $message = $mensaje;
    $a = $cant_repeticiones;
    while ($a >= 1) {
        echo "<script>alert('$message'+' '+'$a');</script>";
        $a--;
    }
   
}

?>

</body>
</html>