<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Persona</title>
</head>
<body>
    <?php
    if (isset($_GET['persona'])) {
        $personaID = $_GET['persona'];
        $conn = new mysqli('localhost', 'pacodelg', 'Alcocer2626$', 'Genealopaco');
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $apellido_paterno = $_POST['apellido_paterno'];
            $apellido_materno = $_POST['apellido_materno'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $fecha_defuncion = $_POST['fecha_defuncion'];
            
            $sql = "UPDATE Personas SET Nombre='$nombre', Apellido_Paterno='$apellido_paterno', Apellido_Materno='$apellido_materno', Fecha_de_Nacimiento='$fecha_nacimiento', Fecha_de_Defunción='$fecha_defuncion' WHERE PersonaID=$personaID";
            if ($conn->query($sql) === TRUE) {
                echo "Registro actualizado correctamente";
            } else {
                echo "Error actualizando el registro: " . $conn->error;
            }
        }
        $sql = "SELECT * FROM Personas WHERE PersonaID = $personaID";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $row['Nombre']; ?>"><br>
                <label for="apellido_paterno">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" value="<?php echo $row['Apellido_Paterno']; ?>"><br>
                <label for="apellido_materno">Apellido Materno:</label>
                <input type="text" id="apellido_materno" name="apellido_materno" value="<?php echo $row['Apellido_Materno']; ?>"><br>
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $row['Fecha_de_Nacimiento']; ?>"><br>
                <label for="fecha_defuncion">Fecha de Defunción:</label>
                <input type="date" id="fecha_defuncion" name="fecha_defuncion" value="<?php echo $row['Fecha_de_Defunción']; ?>"><br>
                <input type="submit" value="Guardar">
                <div>
                    <h2>Foto Actual</h2>
                    <img id="foto" width="200px" src="<?php echo $row['Foto']; ?>">
             
                </div> 
            </form>
            <?php
            //    <label for="foto">Selecciona una nueva foto:</label>
            //    <input type="file" name="foto" id="foto" accept="image/*" required>
            //    <img id="foto" width="200px" src="foto">

            //    <button type="submit">Subir Foto</button>
    
        } else {
            echo "No se encontraron datos.";
        }
        $conn->close();
    } else {
        echo "No se ha seleccionado ninguna persona.";
    }
    ?>
    <a href="ver_personas.php?persona=<?php echo $personaID; ?>">Volver</a>
</body>
</html>
