<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Detalles de la Persona</title>

</head>
<body>
<h1>Visor de Arbol </h1>
   
    <?php
    // Recibir persona de la URL y seleccionar su foto si no la hay en funcion del genero

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

    <!-- Cabecera de la pagina -->
    <hr>
     <h2>Páginas del proyecto</h2>
     
     <ul>
            <li>
                <a href="index.php">Página de Inicio</a>
                ---
                <a href="ver_personas.php?persona=<?php echo $personaID; ?>">Volver</a> 
            </li>
     </ul>
     <hr>   
    <?php
            // Localizar Padres
            echo "<h2>Padres</h2>";
            if ($row['PadreID']) {
                $sqlPadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PersonaID = ?";
                $stmtPadre = $pdo->prepare($sqlPadre);
                $stmtPadre->execute([$row['PadreID']]);
                $padre = $stmtPadre->fetch();
            }
            if ($row['MadreID']) {
                $sqlMadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PersonaID = ?";
                $stmtMadre = $pdo->prepare($sqlMadre);
                $stmtMadre->execute([$row['MadreID']]);
                $madre = $stmtMadre->fetch();
                
            }
            
    ?>
         <!-- Mostrar Padres y nombres con link -->
            <div class="contenedor">
               <img id="fotopadre" width="200px" src="<?php echo "/", $padre['Foto']; ?>" >
               <img id="fotomadre" width="200px" src="<?php echo "/", $madre['Foto']; ?>" >
            </div>
            <div class="contenedor">
                <p> <a href='ver_arbol.php?persona=<?php echo "".$row['PadreID']."'>" . $padre['Nombre'] . " " . $padre['Apellido_Paterno'] . " " . $padre['Apellido_Materno'] . "</a></p>"?>
                <p> "  " </p>
                <p> <a href='ver_arbol.php?persona=<?php echo "".$row['MadreID']."'>" . $madre['Nombre'] . " " . $madre['Apellido_Paterno'] . " " . $madre['Apellido_Materno'] . "</a></p>"?>
            </div>
            <!-- Foto del inclito -->
            <div class="contenedor">
                <img id="foto" width="200px" src="<?php echo "/", $foto; ?>" >  
            </div>   
            <?php
           // echo "<p>Padre: <a href='ver_personas.php?persona=".$row['PadreID']."'>" . $padre['Nombre'] . " " . $padre['Apellido_Paterno'] . " " . $padre['Apellido_Materno'] . "</a></p>";
           // echo "<img src=" . $padre['Foto'] . " border='0' width='250' height='250'>";
           // echo "<p>Madre: <a href='ver_personas.php?persona=".$row['MadreID']."'>" . $madre['Nombre'] . " " . $madre['Apellido_Paterno'] . " " . $madre['Apellido_Materno'] . "</a></p>";
           // echo "<img src=" . $madre['Foto'] . " border='0' width='250' height='250'>";
    ?> 

    <?php       
            //mostrar nombre del inclito
                echo "<p>Nombre: " . $row['Nombre'] . " " . $row['Apellido_Paterno'] ." " . $row['Apellido_Materno'] . " </p>";
            
                // Mostrar Conyuges
            echo "<h2>Matrimonios</h2>";
            if ($row['Conyuge1']) {
                $sqlConyuge1 = "SELECT Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PersonaID = ?";
                $stmtConyuge1 = $pdo->prepare($sqlConyuge1);
                $stmtConyuge1->execute([$row['Conyuge1']]);
                $conyuge1 = $stmtConyuge1->fetch(); 
              
                echo "<div style='display: flex; justify-content: center;'><img src='" . $conyuge1['Foto'] . "' border='0' width='250' height='250'></div>";
               echo "<p>Conyuge 1: <a href='ver_arbol.php?persona=".$row['Conyuge1']."'>" . $conyuge1['Nombre'] . " " . $conyuge1['Apellido_Paterno'] . " " . $conyuge1['Apellido_Materno'] . "</a></p>";
             
                
            }
            if ($row['Conyuge2']) {
                $sqlConyuge2 = "SELECT Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PersonaID = ?";
                $stmtConyuge2 = $pdo->prepare($sqlConyuge2);
                $stmtConyuge2->execute([$row['Conyuge2']]);
                $conyuge2 = $stmtConyuge2->fetch();
                echo "<div style='display: flex; justify-content: center;'><img src='" . $conyuge2['Foto'] . " border='0' width='250' height='250'></div>";
                echo "<p>Conyuge 2: <a href='ver_arbol.php?persona=".$row['Conyuge1']."'>" . $conyuge2['Nombre'] . " " . $conyuge2['Apellido_Paterno'] . " " . $conyuge2['Apellido_Materno'] . "</a></p>";
            }
    ?>
<!-- Mostrar foto del inclito-->
<!-- <div class="contenedor">
            <img id="foto" width="200px" src="<?php echo "/", $foto; ?>" >
            <img src="<?php //echo "/", $conyuge1['Foto']; ?>" border='0' width='250' height='250'>
    </div> -->
    <?php
    // Mostrar foto del conyuge
           // echo "<img src=" . $conyuge1['Foto'] . " border='0' width='250' height='250'>";
           // echo "<p>Conyuge 1: <a href='ver_arbol.php?persona=".$row['Conyuge1']."'>" . $conyuge1['Nombre'] . " " . $conyuge1['Apellido_Paterno'] . " " . $conyuge1['Apellido_Materno'] . "</a></p>";
            
            // Mostrar Hijos
            echo "<h2>Hijos</h2>";
            $sqlHijos = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PadreID = ? OR MadreID = ?";
            $stmtHijos = $pdo->prepare($sqlHijos);
            $stmtHijos->execute([$personaID, $personaID]);
            while ($hijo = $stmtHijos->fetch()) {
               
                echo "<div style='display: flex; justify-content: center;'><img src='" . $hijo['Foto'] . "' border='0' width='250' height='250'></div>";
                echo "<p> <a href='ver_arbol.php?persona=".$hijo['PersonaID']."'>" . $hijo['Nombre'] . " " . $hijo['Apellido_Paterno'] . " " . $hijo['Apellido_Materno'] . "</a></p>";
            }

            // Mostrar Hermanos
            echo "<h2>Hermanos</h2>";
            $sqlHermanos = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE (PadreID = ? OR MadreID = ?) AND PersonaID != ? AND (PadreID != 0 AND MadreID !=0)";
            $stmtHermanos = $pdo->prepare($sqlHermanos);
            $stmtHermanos->execute([$row['PadreID'], $row['MadreID'], $personaID]);
            while ($hermano = $stmtHermanos->fetch()) {
                
                echo "<div style='display: flex; justify-content: center;'><img src='" . $hermano['Foto'] . "' border='0' width='250' height='250'></div>";
                echo "<p> <a href='ver_arbol.php?persona=".$hermano['PersonaID']."'>" . $hermano['Nombre'] . " " . $hermano['Apellido_Paterno'] . " " . $hermano['Apellido_Materno'] . "</a></p>";
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

