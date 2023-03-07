<?php

$host = "localhost";
$usuario = "root"; 
$pass = "";
$bases_de_datos = "atenea";

$conexion = new mysqli($host,$usuario,$pass,$bases_de_datos);

if ($conexion->connect_errno) {
    echo "Se experimentan fallos de conexion";
    exit();
}

?>