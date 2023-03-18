<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Algoritmo que le pida al usuario un mensaje</h3>
    <form action="" method="post">
        <input type="text" name="nombre" placeholder="Ingresar nombre">
        <input type="submit" name="datos" value="calcular">
    </form>
    <?php
    $i = 1;
    if (isset($_POST['datos'])) {
        $nombre = $_POST['nombre'];        
    
    ?>
    <ul>
    <?php while ($i < 11) { ?>
        <li><?php echo $nombre." Full stack ".$i ?></li>
        <?php $i += 1 ?>
    <?php }  
    }?>
    </ul>
</body>
</html>