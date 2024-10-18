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
      <div class="contenedor">
        <h2>Pagina web de la familia Rico Ibañez y sus parientes</h2>;
</div>   
<div class="contenedor">
        <img class="img" src="Genealorico/fotos/Rico.png" />
</div>  
        <h1>Para empezar selecciona o crea una persona</h1>
<div class="contenedor">       
        <form action="ver_personas.php" method="GET">
            <label for="persona"></label>
            <select class="desplegable" name="persona" id="persona">
                <option value="">Seleccionar</option>
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
        <button class="desplegable2" onclick="location.href='create.php'">Crear Personas</button>
       <div> 
            
        </div>
</body>
</div>       
</body>
</html>
