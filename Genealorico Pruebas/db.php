<?php
$servername = "localhost";
$username = "pacodelg";
$password = "Alcocer2626$";
$dbname = "Genealopaco";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
