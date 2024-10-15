<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Genealopaco</title>
</head>
<body>
    <h1>Genealopaco</h1>
    <form action="ver_personas.php" method="GET">
        <label for="persona">Selecciona una persona:</label>
        <select name="persona" id="persona">
            <option value="">Selecciona una persona</option>
            <?php
            require 'conexion.php';
            $conexion = new Conexion();
            $pdo = $conexion->pdo;
            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas";
            $stmt = $pdo->query($sql);
            while ($row = $stmt->fetch()) {
                echo "<option value='" . $row["PersonaID"] . "'>" . $row["Nombre"] . " " . $row["Apellido_Paterno"] . " " . $row["Apellido_Materno"] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Ver Persona">
    </form>
</body>
</html>

