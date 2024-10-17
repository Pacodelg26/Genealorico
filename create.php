
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Crear Nueva Persona</title>
</head>
<?php

?>
<body>
    <h1>Crear Nueva Persona</h1>
    <!-- Cabecera de la pagina -->
    <hr>
     <h2>Páginas del proyecto</h2>
     
     <ul>
            <li>
                <a href="index.php">Página de Inicio</a>
                ---
                <a href="ver_personas.php?persona=2">Volver</a> 
            </li>
     </ul>
     <hr>   
<div class="contenedor">

    <form action="upload.php" method="post" enctype="multipart/form-data">
        Nombre: <input type="text"  name="Nombre" required><br>
        Apellido Paterno: <input type="text" name="Apellido_Paterno" required><br>
        Apellido Materno: <input type="text" name="Apellido_Materno"><br>
        Fecha de Nacimiento: <input type="date" value= "0999-01-01" name="Fecha_de_Nacimiento"><br>
        Lugar de Nacimiento: <input type="text" name="Lugar_de_Nacimiento"><br>
        Fecha de Defunción: <input type="date" value= "0999-01-01" name="Fecha_de_Defunción"><br>
        Lugar de Defunción: <input type="text" name="Lugar_de_Defunción"><br>
        Foto: <input type="file" name="Foto"><br>
        Género: 
        <select name="Genero" required>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select><br>
        Padre: 
        <select name="PadreID">
            <?php
            require 'conexion.php';
            $conexion = new Conexion();
            $pdo = $conexion->pdo;
            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='M'";
            $stmt = $pdo->query($sql);
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $stmt->fetch()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
            ?>
        </select><br>
        Madre: 
        <select name="MadreID">
            <?php

            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='F'";
            $stmt = $pdo->query($sql);
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $stmt->fetch()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
            ?>
        </select><br>
        Conyuge1: 
        <select name="Conyuge1">
            <?php

            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas";
            $stmt = $pdo->query($sql);
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $stmt->fetch()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
            ?>
        </select><br>
        Conyuge2: 
        <select name="Conyuge2">
            <?php

            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas";
            $stmt = $pdo->query($sql);
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $stmt->fetch()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Crear">
    </form>
</div>
</body>
</html>
