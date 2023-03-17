<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--Formulario para optener datos de calificación, cantidad de clases y asistencias del estudiante-->
    <h3>La nota de aprobación es mayor o igual a 6 (entre un rango de 1 a 10)</h3>
    <form action="" method="post">
        <input type="number" name="nota" placeholder="Ingresar calificación">
        <input type="number" name="cant_clases" placeholder="Ingrese la totalidad de clases">
        <input type="number" name="cant_asistencias" placeholder="Ingrese asistencias">
        <input type="submit" name="datos" value="calcular">
    </form>

    <?php

    if (isset($_POST['datos'])) {
        $nota = $_POST['nota'];
        $cant_clases = $_POST['cant_clases'];
        $cant_asistencias = $_POST['cant_asistencias'];

        $condicion = $cant_clases*0.8;

        if ($cant_asistencias >= $condicion && $nota >= 6) {
            //congratulations BRAYAN y JONATHAN
            $message = "Estudiante aprobo!!!!!!!";
        }else{
            $message = "Estudiante No aprobo :C";
        }
        echo "<script>alert('$message');</script>";
    }
    
    ?>

</body>
</html>