<?php


echo '
    <form action="index.php" method="GET">
        <input type="text" name="texto" placeholder="escriba su nombre">
        <input type="number" name="num" placeholder="escriba su numero de celular">
        <input type="submit" value="enviar datos" name="datos">
    </form>
';


if (isset($_GET['datos'])) {
    $texto = $_GET['texto'];
    $num = $_GET['num'];

    echo 'su nombre es = '.$texto.'<br>';
    echo 'su número es = '.$num.'<br>';
}

?>