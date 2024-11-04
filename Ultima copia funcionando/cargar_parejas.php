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

$sql = "SELECT p2.PersonaID, p2.Nombre, p2.Apellido_Paterno, p2.Apellido_Materno
        FROM Personas p1
        LEFT JOIN Personas p2 ON p1.Conyuge1 = p2.PersonaID OR p1.Conyuge2 = p2.PersonaID
        WHERE p1.PersonaID = $personaID ";

$result = $conn->query($sql);

$parejas = array();
while($row = $result->fetch_assoc()) {
    $parejas[] = $row;
}

echo json_encode($parejas);

$conn->close();
?>
