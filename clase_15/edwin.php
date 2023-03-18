<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method ="POST">
        <input type='text' name="texto" placeholder ="ingrese el texto que desee">
        <input type="number" name="repeticiones" placeholder="ingrese el numero de repeticiones">
        <input type="submit" name="datos" value="mostrar">
    </form>
</body>
</html>

<?php
    if(isset($_POST['datos'])){
        $texto = $_POST['texto'];
        $repeticiones = $_POST['repeticiones'];

        for ($i = 1; $i <= $repeticiones; $i++){
            echo $texto.' '.$i.'<br>' ;
        }

    }
?>
