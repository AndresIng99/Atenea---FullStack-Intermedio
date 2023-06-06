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
            <td>'.$datos1['cifc'].'</td>
            <td>'.$datos1['cifcl'].'</td>
            <td>'.$datos1['codcoche'].'</td>
            <td>'.$datos1['color'].'</td>
        </tr>';
        $a++;
    }
    
    echo '</table>';
?>