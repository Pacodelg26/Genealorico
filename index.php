<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GenealoRico - Pagina Principal</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
</head>
<body>

    <h1>GenealoRico Página Principal</h1>
    <hr>
     <h2>Paginas del proyecto</h2>
     
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
     <div class="contenedor">
        <h2>Pagina web de la familia Rico Ibañez y sus parientes</h2>;
</div>   
<div class="contenedor">
        <img class="img" src="Genealorico/fotos/Rico.png" />
</div>  
        <h1>Para empezar selecciona una persona</h1>
<div class="contenedor">       
        <form action="ver_personas.php" method="GET">
            <label for="persona"></label>
            <select name="persona" id="persona">
                <option value="">Selecciona una persona</option>
                <?php
                require 'conexion.php';
                $conexion = new Conexion();
                $pdo = $conexion->pdo;
                $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas ORDER BY Nombre" ;
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch()) {
                    echo "<option value='" . $row["PersonaID"] . "'>" . $row["Nombre"] . " " . $row["Apellido_Paterno"] . " " . $row["Apellido_Materno"] . "</option>";
                }
                ?>
            </select>
            <input class="desplegable" type="submit" value="Ver Persona">
        </form>
</div>       
</body>
</html>
