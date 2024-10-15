<?php


$servername = "localhost";
$username = "pacodelg";
$password = "Alcocer2626$";
$dbname = "Genealopaco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$personaID = $_GET['PersonaID'];

$sql = "SELECT p2.PersonaID, p2.Nombre, p2.Apellido_Paterno, p2.Apellido_Materno
        FROM Personas p1
        JOIN Personas p2 ON p1.PadreID = p2.PadreID AND p1.MadreID = p2.MadreID
        WHERE p1.PersonaID = $personaID AND p2.PersonaID <> $personaID";

$result = $conn->query($sql);

$hermanos = array();
while($row = $result->fetch_assoc()) {
    $hermanos[] = $row;
}

echo json_encode($hermanos);

$conn->close();
?>
