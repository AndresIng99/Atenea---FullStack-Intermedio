<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <form action="" method="get">
        <input type="number" name="correctas" placeholder="digite correctas">
        <input type="number" name="incorrectas" placeholder="digite incorrectas">
        <input type="number" name="en_blanco" placeholder="digite en blanco">
        <input type="submit" name="datos" value="validar">
    </form>
    <?php
    
    if (isset($_GET['datos'])) {
        $correctas = $_GET['correctas'];
        $incorrectas = $_GET['incorrectas'];
        $blanco = $_GET['en_blanco'];

        $total= ($correctas*4)+(-$incorrectas);

        echo 'la cantidad de puntos es de: '. $total;

    }

    ?>
</body>
</html>