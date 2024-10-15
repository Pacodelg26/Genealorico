<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Detalles de la Persona</title>

</head>
<body>
<h1>Visor de Personas </h1>
    <hr>
     <h2>Páginas del proyecto</h2>
     
     <ul>
            <li>
                <a href="index.php">Página de Inicio</a>
                 --     
                Cargar Personas
                 --
                Visor/editor de datos 
                 --
                 <a href="visor_arbol.html">Vista de arbol</a>  
            </li>
     </ul>
     <hr>
    <?php
    if (isset($_GET['persona'])) {
        $personaID = $_GET['persona'];
        require 'conexion.php';
        $conexion = new Conexion();
        $pdo = $conexion->pdo;

        
        $sql = "SELECT * FROM Personas WHERE PersonaID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$personaID]);
        $row = $stmt->fetch();
      
        if ($row) {
            $foto = $row['Foto'] ? $row['Foto'] : ($row['Genero'] == 'M' ? 'Genealorico/fotos/hombre.jpg' : 'Genealorico/fotos/mujer.jpg');
            ?>
            <div class="contenedor">
                <img id="foto" width="200px" src="<?php echo "/", $foto; ?>" >
        </div>
            <?php
            echo "<p>Foto: " . $row['Foto'] . "</p>";
            echo "<p>Nombre: " . $row['Nombre'] . "</p>";
            echo "<p>Apellido Paterno: " . $row['Apellido_Paterno'] . "</p>";
            echo "<p>Apellido Materno: " . $row['Apellido_Materno'] . "</p>";
            echo "<p>Fecha de Nacimiento: " . $row['Fecha_de_Nacimiento'] . "</p>";
            echo "<p>Fecha de Defunción: " . $row['Fecha_de_Defunción'] . "</p>";

            // Mostrar Padres
            echo "<h2>Padres</h2>";
            if ($row['PadreID']) {
                $sqlPadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
                $stmtPadre = $pdo->prepare($sqlPadre);
                $stmtPadre->execute([$row['PadreID']]);
                $padre = $stmtPadre->fetch();
                echo "<p>Padre: <a href='ver_personas.php?persona=".$row['PadreID']."'>" . $padre['Nombre'] . " " . $padre['Apellido_Paterno'] . " " . $padre['Apellido_Materno'] . "</a></p>";

            }
            if ($row['MadreID']) {
                $sqlMadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
                $stmtMadre = $pdo->prepare($sqlMadre);
                $stmtMadre->execute([$row['MadreID']]);
                $madre = $stmtMadre->fetch();
                echo "<p>Madre: " . $madre['Nombre'] . " " . $madre['Apellido_Paterno'] . " " . $madre['Apellido_Materno'] . "</p>";
            }

            // Mostrar Hijos
            echo "<h2>Hijos</h2>";
            $sqlHijos = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PadreID = ? OR MadreID = ?";
            $stmtHijos = $pdo->prepare($sqlHijos);
            $stmtHijos->execute([$personaID, $personaID]);
            while ($hijo = $stmtHijos->fetch()) {
                echo "<p>" . $hijo['Nombre'] . " " . $hijo['Apellido_Paterno'] . " " . $hijo['Apellido_Materno'] . "</p>";
            }

            // Mostrar Hermanos
            echo "<h2>Hermanos</h2>";
            $sqlHermanos = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE (PadreID = ? OR MadreID = ?) AND PersonaID != ?";
            $stmtHermanos = $pdo->prepare($sqlHermanos);
            $stmtHermanos->execute([$row['PadreID'], $row['MadreID'], $personaID]);
            while ($hermano = $stmtHermanos->fetch()) {
                echo "<p>" . $hermano['Nombre'] . " " . $hermano['Apellido_Paterno'] . " " . $hermano['Apellido_Materno'] . "</p>";
            }

            // Mostrar Conyuges
            echo "<h2>Conyuges</h2>";
            if ($row['Conyuge1']) {
                $sqlConyuge1 = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
                $stmtConyuge1 = $pdo->prepare($sqlConyuge1);
                $stmtConyuge1->execute([$row['Conyuge1']]);
                $conyuge1 = $stmtConyuge1->fetch();
                echo "<p>Conyuge 1: " . $conyuge1['Nombre'] . " " . $conyuge1['Apellido_Paterno'] . " " . $conyuge1['Apellido_Materno'] . "</p>";
            }
            if ($row['Conyuge2']) {
                $sqlConyuge2 = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
                $stmtConyuge2 = $pdo->prepare($sqlConyuge2);
                $stmtConyuge2->execute([$row['Conyuge2']]);
                $conyuge2 = $stmtConyuge2->fetch();
                echo "<p>Conyuge 2: " . $conyuge2['Nombre'] . " " . $conyuge2['Apellido_Paterno'] . " " . $conyuge2['Apellido_Materno'] . "</p>";
            }
        } else {
            echo "No se encontraron datos.";
        }
    } else {
        echo "No se ha seleccionado ninguna persona.";
    }
    ?>
    <div class="contenedor">
    <a href="editar_persona.php?persona=<?php echo $personaID; ?>">Editar Persona</a>
</div>
</body>

</html>

