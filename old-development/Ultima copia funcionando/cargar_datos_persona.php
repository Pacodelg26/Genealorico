<?php
$servername = "localhost";
$username = "pacodelg";
$password = "Genealorico2024$";
$dbname = "Genealopaco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$personaID = $_GET['PersonaID'];

$sql = "SELECT p.Nombre, p.Apellido_Paterno, p.Apellido_Materno, p.Fecha_de_Nacimiento, p.Fecha_de_Defunción, p.Genero, p.Foto,
               (SELECT CONCAT(p2.Nombre, ' ', p2.Apellido_Paterno, ' ', p2.Apellido_Materno) FROM Personas p2 WHERE p.PadreID = p2.PersonaID) AS Padre,
               (SELECT CONCAT(p3.Nombre, ' ', p3.Apellido_Paterno, ' ', p3.Apellido_Materno) FROM Personas p3 WHERE p.MadreID = p3.PersonaID) AS Madre
        FROM Personas p
        WHERE p.PersonaID = $personaID";

$result = $conn->query($sql);
$data = $result->fetch_assoc();

echo json_encode($data);

$conn->close();
?>
