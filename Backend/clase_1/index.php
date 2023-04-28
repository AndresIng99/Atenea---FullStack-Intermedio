<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .reprobo{
            color: red;
        }
        .aprobo{
            color: green;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h1>
        Ingrese calificaciones del estudiante
        </h1>
        <input type="number" name="num1" placeholder="calificación 1">
        <input type="number" name="num2" placeholder="calificación 2">
        <input type="number" name="num3" placeholder="calificación 3">
        <input type="submit" value="promediar" name="promediar">
    </form>

    <?php
    $num1 = 0;
    $num2 = 0;
    $num3 = 0;
    if (isset($_POST['promediar'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $num3 = $_POST['num3'];

        $resultado = 0;

        /*La nota 1 = 30% 
        La nota 2 = 40%
        La nota 3 = 30%*/

        $resultado = ($num1*0.3)+($num2*0.4)+($num3*0.3);

        if ($resultado < 3) {
            echo '<h2 class="reprobo">la nota es de '.$resultado.' por lo tanto el estudiante reprueba</h2>';
        }else{
            echo '<h2 class="aprobo">la nota es de '.$resultado.' por lo tanto el estudiante Aprueba</h2>';
        }
    }
    ?>
</body>
</html>