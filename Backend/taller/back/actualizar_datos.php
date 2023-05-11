<?php

include '../db/conexion.php';

if (isset($_POST['act'])) {
    $name = $_POST['nombre_act'];
    $last_name = $_POST['apellido_act'];
    $cc = $_POST['cc'];
   


    mysqli_query($conexion,"UPDATE usuarios SET nombre = '$name', apellido = '$last_name'
    WHERE cedula = '$cc'");
    
}
header ('location: ../datos.php')

?>