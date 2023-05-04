<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hola mundo!!</h1>

    <form action="" method="post">
        <input type="number" name="num1">
        <input type="number" name="num2">
        <select name="oper" id="">
            <option value="1">suma</option>
            <option value="2">resta</option>
            <option value="3">multiplicación</option>
            <option value="4">división</option>
        </select>
        <input type="submit" value="enviar" name="proceso">
    </form>
    
    <?php 
    //Esto es un comentarion de una sola linea 

    #Comentario de una sola linea

    /*Esto es 
    un comentario
    de multiples
    lineas*/
    

    /*

    const CONSTANTE = 5;
     $CONSTANTE = 3;


    function funcioncita(){
                $num = 'fsdsdkfbasd'; 
                return $num;
            }
            echo funcioncita();
        
    */
    //Ejemplo de un incremento
       /* $a = 0;
        const PI = 3.14159265358979322384;

        while ($a <= 10) {
            echo $a.'</br>';
            ++$a;
        }
*/
    //Ejemplo de un decremento
    /*    $a = 10;

        while ($a >= 0) {
            echo $a.'</br>';
            $a--;
        }
            /*SALIDA DE CÓDIGO
            10
            9
            8
            7
            6
            5
            4
            3
            2
            1
            0
            */
            
/*
            $a = 100;

            while ($a >= 0) {
                echo $a.'</br>';
                $a -= 5;
            }*/
/*

            $a = 5;
            $b = 3;

            $suma = $a + $b;
            $resta = $a - $b;
            $multiplicacion = $a * $b;
            $div = $a / $b;
            $modulo = $a % $b;
            $exponen = $a ** $b;


            echo $suma.'<br>';
            echo $resta.'<br>';
            echo $multiplicacion.'<br>';
            echo $div.'<br>';
            echo $modulo.'<br>';
            echo $exponen.'<br>';
*/
 /*
        $a = 10;
        $b = 5;
        $c = 7;

        if (($a != $b || ($a != $c && ($a == $b || $a == $c ))) || ($a > $b)) {
            echo 'ingreso al modulo, la letra "a" es igual a '.$a.' la letra "b" es igual a '.$b.' y la letra c es igual a '.$c;
        }else{
            echo 'no ingreso'; 
        }
 
        $num1 = 0;
        if (isset($_POST['proceso'])) {
            $num1 = $_POST['num1'];
            
            if ($num1 <= 0) {
                echo 'no ha nacido';
            }else if ($num1 >= 18) {
                echo 'es mayor de edad';
            }else{
                echo 'es menor de edad';
            }
        }
        

 
        $a = 10;
        do {
            echo $a;
            $a--;
        } while ($a >= 0);
        

        for ($a=10; $a > 0; $a--) { 
            echo $a.'<br>';
        }


        $a = 0;
        while ($a <= 10) {

            if($a < 5){
                $a += 2;
            }if($a >= 5){
                $a--;
            }
            echo $a.'<br>';
        }
        */

        if (isset($_POST['proceso'])) {
            $num1 = $_POST['num1'];
            $num2 = $_POST['num2'];
            $oper = $_POST['oper'];

            switch ($oper) {
                case '1':
                    $resultado = $num1+$num2;
                    $name = 'suma';
                    break;
                case '2':
                    $resultado = $num1-$num2;
                    $name = 'resta';
                    break;
                case '3':
                    $resultado = $num1*$num2;
                    $name = 'multiplicación';
                    break;
                case '4':
                    $resultado = $num1/$num2;
                    $name = 'división';
                    break;
            }
            echo 'el resultado de la '.$name.' es: '.$resultado;
        }
            

    ?>
    

</body>
</html>