<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Detalles de la Persona</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h1, h2 {
            color: #333;
        }
        .contenedor {
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 400px;
        }
        .contenedorlista {
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 400px;
            font: bold;
        }
        .img {
            width: 100%;
            max-width: 300px;
            margin: 20px auto;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            display: inline;
            margin-right: 10px;
        }
        @media screen and (max-width: 768px) {
            .contenedor {
                width: 90%;
            }
            .img {
                max-width: 100%;
            }
        }
   </style> 
   </head>
<body>

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
<h1>Visor de Personas </h1>
    <hr>
      <nav class="menu">
        <ul class="menu-list">
            <li class="menu-item">
                <a href="index.php"><img src="Genealorico/fotos/Home.png" alt="Icono 1"><div class="hover-text">Ir a Inicio</div></a>
                
            </li>
            <li class="menu-item">
                <a href="crear_persona.php"><img src="Genealorico/fotos/Crear Persona.png" alt="Icono 2"></a>
            </li>
            <li class="menu-item">
                <a href="ver_arbol.php?persona=<?php echo $personaID; ?>"><img src="Genealorico/fotos/Ver Arbol.png" alt="Icono 3"></a>
            </li>
            <li class="menu-item">
                <a href="editar_person.php?persona=<?php echo $personaID; ?>"><img src="Genealorico/fotos/Editar Persona.png" alt="Icono 3"></a>
            </li>
        </ul>
        </nav>

     <hr>    
            <div class="contenedor">
                <img id="foto" width="200px" src="<?php echo "/", $foto; ?>"alt="Foto de la persona"  >
        </div>
        <div class="contenedorlista">
            <?php
            // echo "<p>Foto: " . $row['Foto'] . "</p>";
            echo "<label>Nombre: " . $row['Nombre'] . " " . $row['Apellido_Paterno'] . " " . $row['Apellido_Materno'] ."</label>";
            // echo "<p>Apellido Paterno: " . $row['Apellido_Paterno'] . "</p>";
            // echo "<p>Apellido Materno: " . $row['Apellido_Materno'] . "</p>";
            if ($row['Fecha_de_Nacimiento']) {
            echo "<br><label>Fecha de Nacimiento: " . $row['Fecha_de_Nacimiento'] . "</label>";
            }
            if ($row['Fecha_de_Defunción']) {
            echo "<br><label>Fecha de Defunción: " . $row['Fecha_de_Defunción'] . "</label>";
            }
            ?>
        </div>
        <?php    
            // Mostrar Padres
            echo "<h2>Padres</h2>";
            if ($row['PadreID']) {
                $sqlPadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
                $stmtPadre = $pdo->prepare($sqlPadre);
                $stmtPadre->execute([$row['PadreID']]);
                $padre = $stmtPadre->fetch();
                echo "<label>Padre: <a href='ver_personas.php?persona=".$row['PadreID']."'>" . $padre['Nombre'] . " " . $padre['Apellido_Paterno'] . " " . $padre['Apellido_Materno'] . "</a></label>";

            }
            if ($row['MadreID']) {
                $sqlMadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
                $stmtMadre = $pdo->prepare($sqlMadre);
                $stmtMadre->execute([$row['MadreID']]);
                $madre = $stmtMadre->fetch();
                echo "<p>Madre: <a href='ver_personas.php?persona=".$row['MadreID']."'>" . $madre['Nombre'] . " " . $madre['Apellido_Paterno'] . " " . $madre['Apellido_Materno'] . "</a></p>";
            }

            // Mostrar Hijos
            echo "<h2>Hijos</h2>";
            $sqlHijos = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PadreID = ? OR MadreID = ?";
            $stmtHijos = $pdo->prepare($sqlHijos);
            $stmtHijos->execute([$personaID, $personaID]);
            while ($hijo = $stmtHijos->fetch()) {
                echo "<p> <a href='ver_personas.php?persona=".$hijo['PersonaID']."'>" . $hijo['Nombre'] . " " . $hijo['Apellido_Paterno'] . " " . $hijo['Apellido_Materno'] . "</a></p>";
            }

            // Mostrar Hermanos
            echo "<h2>Hermanos</h2>";
            $sqlHermanos = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE (PadreID = ? OR MadreID = ?) AND PersonaID != ? AND (PadreID != 0 AND MadreID !=0)";
            $stmtHermanos = $pdo->prepare($sqlHermanos);
            $stmtHermanos->execute([$row['PadreID'], $row['MadreID'], $personaID]);
            while ($hermano = $stmtHermanos->fetch()) {
                echo "<p> <a href='ver_personas.php?persona=".$hermano['PersonaID']."'>" . $hermano['Nombre'] . " " . $hermano['Apellido_Paterno'] . " " . $hermano['Apellido_Materno'] . "</a></p>";
            }

            // Mostrar Conyuges
            echo "<h2>Conyuges</h2>";
            if ($row['Conyuge1']) {
                $sqlConyuge1 = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
                $stmtConyuge1 = $pdo->prepare($sqlConyuge1);
                $stmtConyuge1->execute([$row['Conyuge1']]);
                $conyuge1 = $stmtConyuge1->fetch();
                echo "<p>Conyuge 1: <a href='ver_personas.php?persona=".$row['Conyuge1']."'>" . $conyuge1['Nombre'] . " " . $conyuge1['Apellido_Paterno'] . " " . $conyuge1['Apellido_Materno'] . "</a></p>";
            }
            if ($row['Conyuge2']) {
                $sqlConyuge2 = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
                $stmtConyuge2 = $pdo->prepare($sqlConyuge2);
                $stmtConyuge2->execute([$row['Conyuge2']]);
                $conyuge2 = $stmtConyuge2->fetch();
                echo "<p>Conyuge 2: <a href='ver_personas.php?persona=".$row['Conyuge1']."'>" . $conyuge2['Nombre'] . " " . $conyuge2['Apellido_Paterno'] . " " . $conyuge2['Apellido_Materno'] . "</a></p>";
            }
        } else {
            echo "No se encontraron datos.";
        }
    } else {
        echo "No se ha seleccionado ninguna persona.";
    }
    ?>
    <!-- <div class="contenedor">
    <a class="link" href="editar_person.php?persona=<?php echo $personaID; ?>">Editar Persona</a> -->
</div>
</body>

</html>

