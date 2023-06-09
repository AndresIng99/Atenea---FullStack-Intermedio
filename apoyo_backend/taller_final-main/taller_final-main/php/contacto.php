<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $celular = $_POST["celular"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $mensaje = $_POST["mensaje"];

    $sql = "INSERT INTO Contacto (nombre, celular, email, direccion, mensaje) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nombre, $celular, $email, $direccion, $mensaje]);
    header("Location: ../html/index.html");
    exit();
}
?>