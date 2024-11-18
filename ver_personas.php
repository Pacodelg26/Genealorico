<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Detalles de la Persona</title>
    <style>
        body {
            width: 100%;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0 auto;
            padding: 0;
            text-align: center;
            font-size: 35px;
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
            max-width: 700px;
        }
        .contenedorlista {
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 700px;
            font: bold;
        }
        .img {
            width: 100%;
            max-width: 300px;
            margin: 20px auto;
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

        .menu-icon {
            font-size: 30px;
            cursor: pointer;
            padding: 10px;
            background-color: #333;
            color: #fff;
            display: inline-block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-menu a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 35px;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
        .img {
            width: 50px;
            height:50px;
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
<script src="script.js">
</script>
<body>

    <?php

    // Recibimos persona de otras paginas
    if (isset($_GET['persona'])) {
        $personaID = $_GET['persona'];
        require 'conexion.php';
        $conexion = new Conexion();
        $pdo = $conexion->pdo;
    // Sacamos todos los campos de la base de datos para esa persona al array $row
        
        $sql = "SELECT * FROM Personas WHERE PersonaID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$personaID]);
        $row = $stmt->fetch();
?>
<!-- Titulo y menú de Iconos -->
<h1>Visor de Personas </h1>
<hr>
    <nav class="menu">
        <ul class="menu-list">
            <li class="menu-item">
                <a href="index.php"><img src="Genealorico/fotos/home-02.png" title="Pagina Principal" alt="Icono 1"><div class="hover-text">Ir a Inicio</div></a>   
            </li>
 
            <li class="menu-item">
                <a href="ver_arbol.php?persona=<?php echo $personaID; ?>"><img src="Genealorico/fotos/ver arbol-02.png" title= "Ver en Arbol" alt="Icono 3"></a>
            
            </li>
            <li class="menu-item">
                <a href="editar_person.php?persona=<?php echo $personaID; ?>"><img src="Genealorico/fotos/editar persona-02.png" title="editar esta persona" alt="Icono 3"></a>
            <li class="menu-item" onclick="toggleMenu()">   
                    <img src="Genealorico/fotos/añadir persona-02.png">
                        <div id="dropdown-menu" class="dropdown-menu" >
                            <a href="crear_hermano.php?persona=<?php echo $personaID; ?>&padre=<?php echo $row['PadreID']; ?>&madre=<?php echo $row['MadreID']; ?>&apellido_paterno=<?php echo $row['Apellido_Paterno']; ?>&apellido_materno=<?php echo $row['Apellido_Materno']; ?>">Crear Hermano/a</a>
                            <a href="crear_padre.php?persona=<?php echo $personaID; ?>&apellido_paterno=<?php echo $row['Apellido_Paterno']; ?>&CP=1;">Crear Padre</a>
                            <a href="crear_madre.php?persona=<?php echo $personaID; ?>&apellido_materno=<?php echo $row['Apellido_Materno']; ?>&CM=1;">Crear Madre</a>
                            <!-- <a href="crear_hijo.php?persona=<?php echo $personaID; ?>&apellido_paterno=<?php echo $row['Apellido_Paterno']; ?>&apellido_materno=<?php echo $row['Apellido_Materno']; ?>&conyuge1=<?php echo $row['Conyuge1']; ?>">Crear Hijo/a</a> -->
                            <a href="crear_conyuge.php?persona=<?php echo $personaID; ?>">Crear Conyuge</a>
                        </div>
            </li>
            <li class="menu-item">
                <a href="borrar.php?persona=<?php echo $personaID; ?>"><img src="Genealorico/fotos/eliminar-02.png" title="Borrar Persona" alt="Borrar"><div class="hover-text">Borrar</div></a>   
            </li>
        </ul>
    </nav>

<?php

// si no hay foto asignamos una en función de su género 
    if ($row) {
        $foto = $row['Foto'] ? $row['Foto'] : ($row['Genero'] == 'M' ? 'Genealorico/fotos/hombre.jpg' : 'Genealorico/fotos/mujer.jpg');

?>
    
<!--// Presentamos a la persona-->
<hr> 
    <div class="contenedor">
        <img id="foto" width="300px" src="<?php echo "/", $foto; ?>"alt="Foto de la persona"  >
    </div>
    <div class="contenedorlista">
        <?php
           
            echo "<label>Nombre: " . $row['Nombre'] . " " . $row['Apellido_Paterno'] . " " . $row['Apellido_Materno'] ."</label>";
 
            if ($row['Fecha_de_Nacimiento']) {
            echo "<br><label>Fecha de Nacimiento: " . $row['Fecha_de_Nacimiento'] . "</label>";
            }
            if ($row['Fecha_de_Defunción']) {
            echo "<br><label>Fecha de Defunción: " . $row['Fecha_de_Defunción'] . "</label>";
            }
            if ($row['Habita_en']) {
                echo "<br><label>Vive o vivió en " . $row['Habita_en'] . "</label>";
            }
        ?>
    </div>
    <div class="contenedorlista">
        <?php    
            // Mostrar Padres
            echo "<h2>Padres</h2>";
            if ($row['PadreID']) {
                $sqlPadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
                $stmtPadre = $pdo->prepare($sqlPadre);
                $stmtPadre->execute([$row['PadreID']]);
                $padre = $stmtPadre->fetch();
                echo "<a href='ver_personas.php?persona=".$row['PadreID']."'>" . $padre['Nombre'] . " " . $padre['Apellido_Paterno'] . " " . $padre['Apellido_Materno'] . "</a><br>";

            }
            if ($row['MadreID']) {
                $sqlMadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
                $stmtMadre = $pdo->prepare($sqlMadre);
                $stmtMadre->execute([$row['MadreID']]);
                $madre = $stmtMadre->fetch();
                echo "<a href='ver_personas.php?persona=".$row['MadreID']."'>" . $madre['Nombre'] . " " . $madre['Apellido_Paterno'] . " " . $madre['Apellido_Materno'] . "</a><br>";
            }
        ?>
        
    <?php
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
            $sqlHermanos = "SELECT P2.PersonaID, P2.Nombre, P2.Apellido_Paterno, P2.Apellido_Materno
            FROM Personas P1
            JOIN Personas P2 ON (
                (P1.PadreID = P2.PadreID AND P1.PadreID > 0)
                OR 
                (P1.MadreID = P2.MadreID AND P1.MadreID > 0)
            )
            WHERE P1.PersonaID = ?
              AND P1.PersonaID <> P2.PersonaID";
            $stmtHermanos = $pdo->prepare($sqlHermanos);
            $stmtHermanos->execute([$personaID]);
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
                echo "<a href='ver_personas.php?persona=".$row['Conyuge1']."'>" . $conyuge1['Nombre'] . " " . $conyuge1['Apellido_Paterno'] . " " . $conyuge1['Apellido_Materno'] . "</a>";
            }
            if ($row['Conyuge2']) {
                $sqlConyuge2 = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
                $stmtConyuge2 = $pdo->prepare($sqlConyuge2);
                $stmtConyuge2->execute([$row['Conyuge2']]);
                $conyuge2 = $stmtConyuge2->fetch();
                echo "<a href='ver_personas.php?persona=".$row['Conyuge1']."'>" . $conyuge2['Nombre'] . " " . $conyuge2['Apellido_Paterno'] . " " . $conyuge2['Apellido_Materno'] . "</a>";
            }
            } else {
                echo "No se encontraron datos.";
            }
    }        
            
    ?>
    </div>


</body>

</html>

