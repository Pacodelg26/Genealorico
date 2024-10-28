<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Borrar Persona</title>
</head>
<body>

<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "pacodelg";
$password = "Genealorico2024$";
$dbname = "Genealopaco";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $persona_id = $_POST['persona_id'];
    $respuesta_seguridad = $_POST['respuesta_seguridad'];

    // Pregunta de seguridad (en un caso real, esta información debería estar almacenada de manera segura en la base de datos)
    $respuesta_correcta = "Rico";

    if ($respuesta_seguridad === $respuesta_correcta) {
        $sql = "DELETE FROM Personas WHERE PersonaID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $persona_id);

        if ($stmt->execute()) {
            echo "Registro $persona_id borrado exitosamente.";
        } else {
            echo "Error al borrar el registro: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Respuesta de seguridad incorrecta.";
    }
} else {
    $persona_id = $_GET['persona'];
}
?>
<h1>Visor de Árbol Familiar</h1>
    <hr>
      <nav class="menu">
        <ul class="menu-list">
            <li class="menu-item">
                <a href="index.php"><img src="Genealorico/fotos/Home.png" title="Pagina Principal" alt="Icono 1"><div class="hover-text">Ir a Inicio</div></a>
            </li>
            <li class="menu-item">
                <a href="crear_persona.php"><img src="Genealorico/fotos/Crear Persona.png" title="Crear Persona" alt="Icono 2"></a>
            </li>

        </ul>
        </nav>

     <hr>    



<form method="POST" action="borrar.php">
    <input type="hidden" name="persona_id" value="<?php echo $persona_id; ?>">
    <label> Vas a Borrar un registro de la base de datos </label><br>
    <label> Si no estas seguro sal de esta pantalla </label><br>
    <label> y si lo estás contesta a esta pregunta: </label><br>
    <label for="respuesta_seguridad">¿Cual es el segundo apellido de Paco?</label>
    <input type="text" id="respuesta_seguridad" name="respuesta_seguridad" required>
    <button type="submit">Borrar</button>
</form>

</body>
</html>


