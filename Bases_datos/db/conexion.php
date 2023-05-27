<?php

$host = 'localhost';
$usuario = 'root';
$contraseña = '';
$basedatos1 = 'proyecto_atenea';
$basedatos2 = 'db_modulo7';
$basedatos3 = 'mi_proyecto';

$conexion = new mysqli($host,$usuario,$contraseña,$basedatos1);
$conexion2 = new mysqli($host,$usuario,$contraseña,$basedatos2);
$conexion3 = new mysqli($host,$usuario,$contraseña,$basedatos3);


if ($conexion->connect_errno) {
    echo "fallos en conexión db 1";
    exit();
}
if ($conexion2->connect_errno) {
    echo "fallos en conexión db 2";
    exit();
}

?>