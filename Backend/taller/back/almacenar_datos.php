<?php

include '../db/conexion.php';

        if (isset($_POST['almacenar'])) {
            $name = $_POST['nombre'];
            $last_name = $_POST['apellido'];
            $cc = $_POST['cedula'];

            mysqli_query($conexion,"INSERT INTO usuarios
            (nombre, apellido, cedula) VALUES
            (UPPER('$name'), UPPER('$last_name'), '$cc')");
        }
        header ('location: ../datos.php')
?>