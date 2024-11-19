<?php
include 'db.php';

$sql = "SELECT * FROM Videos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Navegar Videos Familiares</title>
    <style>
        .video-container {
            margin-bottom: 20px;
        }
        video {
            width: 100%;
            max-width: 600px;
        }
    </style>
</head>
<body>

<h2>Videos Familiares</h2>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='video-container'>";
        echo "<h3>" . $row["Titulo"] . "</h3>";
        echo "<p>" . $row["Descripcion"] . "</p>";
        echo "<video controls>";
        echo "<source src='" . $row["RutaVideo"] . "' type='video/mp4'>";
        echo "Su navegador no soporta la etiqueta de video.";
        echo "</video>";
        echo "</div>";
    }
} else {
    echo "No se encontraron videos.";
}
$conn->close();
?>


</body>
</html>
