<?php

include '../db/conexion.php';

if (isset($_POST['insert_car'])) {
    $nombre = $_POST['name_car'];
    $ventas = $_POST['sold_car'];

    mysqli_query($conexion, "INSERT INTO carros (marca, ventas) VALUES
    ('$nombre', '$ventas')");

    header ('location:../graficas/index.php');
}


?>