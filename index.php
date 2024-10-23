<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GenealoRico - Pagina Principal</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
</head>
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 800px;
        }
        .img {
            width: 100%;
            max-width: 300px;
        }
        .desplegable, .desplegable2 {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .desplegable2 {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }
        .desplegable2:hover {
            background-color: #0056b3;
        }
        form {
            margin-bottom: 20px;
        }

        @media screen and (max-width: 768px) {
            .contenedor {
                width: 90%;
            }
            .img {
                max-width: 
            }
        }
        </style>
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
<div class="contenedorlista">       
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
        <br>
        <h1>o</h1>
        <br>
        <button class="desplegable" onclick="location.href='create.php'">Crear Personas</button>
       <div> 
            
        </div>
</body>
</div>       
</body>
</html>
