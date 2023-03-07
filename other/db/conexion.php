<?php

$host = "localhost";
$user = "root";
$pw = "";
$db = "mi_proyecto";


$conexion = new mysqli($host,$user,$pw,$db);
if ($conexion->connect_errno) {
    echo "Se experimentan fallos de conexion";
    exit();
}

?>