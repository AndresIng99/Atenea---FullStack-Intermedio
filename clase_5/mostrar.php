<?php 


session_start();
include 'db/conexion.php';

include 'index.html';

if (isset($_POST['datos'])) {

    $mis_datos = mysqli_query($conexion,"SELECT * FROM usuarios where cedula >= '200000000' ");

    echo '
    <table class="table table-light">
         <thead class="table-dark">
            <tr>
                <td>Cédula</td>
                <td>Nombre</td>
                <td>Edad</td>
                <td>Correo</td>
            </tr>
         </thead>
         <tbody>
    ';
    while ($datos2 = mysqli_fetch_array($mis_datos)){
        $cedula = $datos2['cedula'];
        $nombre = $datos2['nombre'];
        $edad = $datos2['edad'];
        $correo = $datos2['correo'];

        echo 
        '
        <tr>
            <td>'.$cedula.'</td>
            <td>'.$nombre.'</td>
            <td>'.$edad.'</td>
            <td>'.$correo.'</td>
        </tr>
        ';
        
    }
    echo '
        </tbody>
    </table>';
}




if (isset($_POST['consulta_edad'])) {
    $edad = $_POST['edad'];

    $mis_datos = mysqli_query($conexion,"SELECT * FROM usuarios where edad = '$edad' ");

    echo '
    <table class="table table-light">
         <thead class="table-dark">
            <tr>
                <td>Cédula</td>
                <td>Nombre</td>
                <td>Edad</td>
                <td>Correo</td>
            </tr>
         </thead>
         <tbody>
    ';
    while ($datos2 = mysqli_fetch_array($mis_datos)){
        $cedula = $datos2['cedula'];
        $nombre = $datos2['nombre'];
        $edad = $datos2['edad'];
        $correo = $datos2['correo'];

        echo 
        '
        <tr>
            <td>'.$cedula.'</td>
            <td>'.$nombre.'</td>
            <td>'.$edad.'</td>
            <td>'.$correo.'</td>
        </tr>
        ';
        
    }
    echo '
        </tbody>
    </table>';
}

?>