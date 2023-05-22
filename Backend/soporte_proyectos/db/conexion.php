<?php

$server = "localhost";
$username= "root";
$password= "";
$database= "proyecto_atenea";

$conexion = new mysqli($server,$username,$password,$database);

if ($conexion->connect_errno) {
echo "fallos en conexión";
exit();
}

?>