<?php

include '../db/conexion.php';

if (isset($_POST['inicio'])) {
    $correo = $_POST['correo'];
    $contra = $_POST['contra'];
    $contra_enc = base64_encode($contra);

    $consulta = mysqli_query($conexion,"SELECT * from usuarios 
    where correo = '$correo' AND clave = '$contra_enc'");

    $cant = mysqli_num_rows($consulta);

    if ($cant == 1) {
        while ($captura = mysqli_fetch_array($consulta)) {
            session_start();
            $_SESSION['usuario'] = $captura['nombre'];
            $_SESSION['rol'] = $captura['rol'];
            $_SESSION['correo'] = $captura['correo'];
            $_SESSION['time'] = time();
        }
        
        header('location:../graficas/index.php');
    }else{
        header('location:../index.html');
    }

}
?>