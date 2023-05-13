<?php

include '../db/conexion.php';

if (isset($_POST['inicio'])) {
    $correo = $_POST['correo'];
    $contra = $_POST['contra'];
    $contra_enc = base64_encode($contra);

    $consulta = mysqli_query($conexion,"SELECT correo, clave from usuarios 
    where correo = '$correo' AND clave = '$contra_enc'");

    $cant = mysqli_num_rows($consulta);

    if ($cant == 1) {
        header('location:../aplicativo/home.php');
    }else{
        header('location:../index.html');
    }

}
#0' or 1 = '1

?>