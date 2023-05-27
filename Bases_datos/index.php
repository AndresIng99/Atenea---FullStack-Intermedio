<?php

    include ('db/conexion.php');

    $query_db1 = mysqli_query($conexion,"SELECT * FROM cliente, venta"); 

    echo '<table>
        <tr>
            <td># reg</td>
            <td>id</td>
            <td>marca</td>
            <td>ventas</td>
        </tr>';

        $a = 1;

    while ($datos1 = mysqli_fetch_array($query_db1)) {
        echo '
        <tr>
            <td>'.$a.'</td>
            <td>'.$datos1['id'].'</td>
            <td>'.$datos1['marca'].'</td>
            <td>'.$datos1['ventas'].'</td>
        </tr>';
        $a++;
    }
    
    echo '</table>';
?>