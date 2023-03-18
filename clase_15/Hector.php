<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Ingrese los datos</h3>
    <form action="" method="post">
        <input type="text" name="nombre" placeholder="Ingresar Texto">
        <input type="number" name="cantidad" placeholder="Ingrese la totalidad de veces">
        <input type="submit" name="datos" value="Procesar"><br><br>
    <?php
        if(isset($_POST['datos']))
         {
             $texto=$_POST["nombre"];
             $num=$_POST["cantidad"];
             $num2=0;
            do{
                $num2=$num2+1;
                echo $texto. " ".$num2."<br>" ;
             }while($num2<$num);
    }    

    ?>
</body>
</html>