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

$sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno
        FROM Personas
        WHERE PadreID = $personaID OR MadreID = $personaID";

$result = $conn->query($sql);

$hijos = array();
while($row = $result->fetch_assoc()) {
    $hijos[] = $row;
}

echo json_encode($hijos);

$conn->close();
?>

