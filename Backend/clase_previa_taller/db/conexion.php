<?php

$host = "localhost";
$usuario = "root";
$contraseña = "";
$db = "prueba_atenea";


$conexion = new mysqli($host,$usuario,$contraseña,$db);

if ($conexion->connect_errno) {
    echo "Se experimentan fallos de conexion";
    exit();
}

?>