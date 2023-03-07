<?php
/*
$edad = 0;

echo '<form action="index.php" method="POST">
        <input type="number" name="edad" placeholder="Ingrese la edad">
        <input type="submit" value="validar" name="datos">
    </form>';


if (isset($_POST['datos'])) {
   $edad = $_POST['edad'];
   
   if ($edad >= 18) {
    echo 'la persona es mayor de edad';
   }else{
    echo 'la persona es menor de edad';
   }

}


*/

/*
$edad = 0;

echo '
<form action="index.php" method="post">
        <input type="number" name="edad" placeholder="digitar edad">
        <input type="submit" value="verificar" name="datos">
</form>
';

if (isset($_POST['datos'])) {
    $edad = $_POST['edad'];

    if ($edad >= 18) {
        echo "es mayor de edad";
    }else{
        echo "es menor de edad";
    }
}




*/

echo '
<form action="index.php" method="post">
        <input type="number" name="n1" placeholder="digitar primer número">
        <input type="number" name="n2" placeholder="digitar segundo número">
        <select name="operacion" required>
            <option value="">Seleccione una opción</option>
            <option value="1">Suma</option>
            <option value="2">Resta</option>
            <option value="3">Multiplicación</option>
            <option value="4">División</option>
        </select>
        <input type="submit" value="operar" name="datos">
</form>
';

if (isset($_POST['datos'])) {
    $num1 = $_POST['n1'];
    $num2 = $_POST['n2'];
    $operacion = $_POST['operacion'];

    $resultado = 0;

    switch ($operacion) {
        case '1':
            //la operación sera de suma
            $resultado = $num1+$num2;
            break;
        case '2':
            //la operación sera de resta
            $resultado = $num1-$num2;
            break;
        case '3':
            //la operación sera de multiplicación
            $resultado = $num1*$num2;
            break;
        case '4':
            //la operación sera de división
            $resultado = $num1/$num2;
            break;
    }
    echo "El resultado es : ".$resultado;
}
/*

const num1 = 5.2;
const num2 = "andres pineda";


$suma = num1+num2;
$resta = num1-num2;
$mult = num1*num2;
$divi = num1/num2;
$modulo = num1%num2;
$exp = pow(num1,num2);

echo 'valor de suma = '.$suma.'<br>';
echo 'valor de resta = '.$resta.'<br>';
/*
echo 'valor de multiplicación = '.$mult.'<br>';
echo 'valor de división = '.$divi.'<br>';
echo 'valor de módulo = '.$modulo.'<br>';
echo 'valor de exponenciación = '.$exp.'<br>';


$a = 0;
while ($a <= 10) {
    if ($a == 5) {
        echo 'HOLA MUNDO <br>';
        $a++;
    }
    if($a == 6){
        echo 'HOLA MUNDO <br>';
         $a++;
    }
    echo $a.'<br>';
    $a++;
}





for ($i=20; $i >= 10 ; $i--) { 
    echo $i.'<br>';
}


$i=20;
$a=15;
$z=20;

if (($i == 20 || $a == 5)&&($a == 105)) {
    echo 'ambas son verdaderas';
}else {
    echo 'nada';
}
*/
?>