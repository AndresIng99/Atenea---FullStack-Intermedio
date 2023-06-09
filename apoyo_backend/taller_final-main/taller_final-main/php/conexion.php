<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "almapizzeria";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 

catch(PDOException $e) {
    echo "Conexion fallida: " . $e->getMessage();
}

$conexion = new mysqli($host,$user,$pw,$db);
if ($conexion->connect_errno) {
    echo "Se experimentan fallos de conexion";
    exit();
}

?>