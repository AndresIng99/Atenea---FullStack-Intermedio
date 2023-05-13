<?php

include '../db/conexion.php'; 

if (isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contra = $_POST['contra'];

    $contra_en = base64_encode($contra);

    $sql = mysqli_query($conexion,"INSERT INTO usuarios (nombre, correo, clave) VALUES
    ('$nombre', '$correo', '$contra_en')");

     header ('location:../index.html');
}



?>