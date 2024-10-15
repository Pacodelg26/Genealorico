<?php
$servername = "localhost";
$username = "pacodelg";
$password = "Alcocer2626$";
$dbname = "Genealopaco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas ORDER BY Nombre";
$result = $conn->query($sql);

$personas = array();
while($row = $result->fetch_assoc()) {
    $personas[] = $row;
}

echo json_encode($personas);

$conn->close();
?>
