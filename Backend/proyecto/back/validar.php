<?php

include '../db/conexion.php';

if (isset($_POST['inicio'])) {
    $correo = $_POST['correo'];
    $contra = $_POST['contra'];

    $consulta = mysqli_query($conexion,"SELECT correo, clave from usuarios 
    where correo = '$correo' AND clave ='$contra'");

    $cant = mysqli_num_rows($consulta);

    echo $cant;

    

}

?>