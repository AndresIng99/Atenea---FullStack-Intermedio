<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<style>
    table td{
        width: 50px;
        height: 20px;
    }
</style>

<body>

<body>
<form action="" method="post">
<input type="number" name="filas" placeholder="cantidad de filas">
<input type="number" name="columnas" placeholder="cantidad de columnas">
<input type="submit" value = "construir" name="datos">
</form>

<?php
if (isset($_POST['datos'])) {
$filas = $_POST['filas'];
$columnas = $_POST['columnas'];


echo '<form action="" method="POST">
    <table border="1">';

    //filas = 3 - columnas = 2 
    for($i=1; $i<=$filas; $i++){

        echo "<tr>";

        for($x=1; $x<=$columnas; $x++){
            echo '<td><input type="number"></td>';
        }
        echo '</tr>';

    }
    echo '</table>
</form>
';
}
?>

</body>
</html>