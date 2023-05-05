<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="mostrar.php" method="get">
        <label for="">Digite su edad</label>
        <input type="number" name="edad">
        <input type="submit" value="enviar" name="mostrar">
    </form>

    <?php
    
    include 'db/conexion.php';

    $daticos = mysqli_query($conexion,"SELECT * FROM usuarios");

    echo '
    <table>
            <tr>
                <td>ID</td>                
                <td>Cédula</td>
                <td>Nombre</td>
            </tr>
            ';
    while ($datos2 = mysqli_fetch_array($daticos)){
        $id = $datos2['id'];
        $cedula_ind = $datos2['cedula'];
        $nombre = $datos2['nombre'];
        echo '
        
            <tr>
                <td>'.$id.'</td>                
                <td>'.$cedula_ind.'</td>
                <td>'.$nombre.'</td>
            </tr>
        ';
    }

    echo '</table>';
    ?>
</body>
</html>