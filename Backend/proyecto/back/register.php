<?php

include '../db/conexion.php'; 

if (isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contra = $_POST['contra'];

    $sql = mysqli_query($conexion,"INSERT INTO usuarios (nombre, correo, clave) VALUES
    ('$nombre', '$correo', '$contra')");

     header ('location:../index.html');
}



?>