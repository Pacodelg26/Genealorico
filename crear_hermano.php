
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Crear Nueva Persona</title>
    <style>
    body {
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
        select {
            font-size:30px;
            width: 380px;
            height: 40px;
            max-width: 400px;
        }
        form {
            margin-bottom: 20px;
            max-width: 700px;
            text-align: initial;
        }
        input {
            height: 40px;
            width: 300px;
            font-size: 30px;
        }
        .contenedor {
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 800px;
        }
        .contenedorlista {
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 700px;
        }
        .botong {
            font-family: Arial, sans-serif;
            font-size: 30px;
            font-weight: bold;
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
        select, input[type="text"] {
            width: calc(50% - 30px);
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 30px;
        } 
        input[type="submit"] {
            width: calc(60% - 30px);
          
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 30px;
        } 
        select, input[type="file"] {
            width: calc(90% - 30px);
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 25px;
        }    
            select, input[type="date"] {
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 20px;    
            width: calc(40% - 30px);
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
<?php

// Recuperar datos pasados por URL si existen
if (isset($_GET['persona'])) {
$personaID = isset($_GET['persona']) ? $_GET['persona'] : '';
$padreID = isset($_GET['padre']) ? $_GET['padre'] : '';
$madreID = isset($_GET['madre']) ? $_GET['madre'] : '';
$apellido_paterno = isset($_GET['apellido_paterno']) ? $_GET['apellido_paterno'] : '';
$apellido_materno = isset($_GET['apellido_materno']) ? $_GET['apellido_materno'] : '';

require 'conexion.php';
$conexion = new Conexion();
$pdo = $conexion->pdo;
}else {
    $apellido_paterno = "";
    $apellido_materno = "";
    $padreID = "";
    $madreID = "";
}



?>
<body>
    <h1>Crear hermano</h1>
    <!-- Cabecera de la pagina -->
    <hr>
 <nav class="menu">
        <ul class="menu-list">
            <li class="menu-item">
                <a href="index.php"><img src="Genealorico/fotos/home-02.png" alt="Icono 1"><div class="hover-text">Ir a Inicio</div></a>
            </li>
            <li class="menu-item">
                <a href="ver_personas.php?persona=<?php echo $personaID; ?>"><img src="Genealorico/fotos/volver-02.png" title="Volver" alt="Ver Persona"></a>
            </li>
        </ul>
</nav>
     

<hr>
<div class="contenedor">

    <form action="upload.php" method="post" enctype="multipart/form-data">
        Nombre: <input type="text"  name="Nombre" required><br>
        Apellido Paterno: <input type="text" name="Apellido_Paterno" value="<?php echo $apellido_paterno; ?>" required><br>
        Apellido Materno: <input type="text" name="Apellido_Materno" value="<?php echo $apellido_materno; ?>" > <br>
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
        Vive o Vivió en: <input type="text" name="Habita_en"><br>
   <?php
             if ($padreID) {
               $sqlpadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
               $stmtpadre = $pdo->prepare($sqlpadre);
               $stmtpadre->execute([$padreID]);
               $padre = $stmtpadre->fetch();
               //echo "" . $padre['Nombre'] . " " . $padre['Apellido_Paterno'] . " " . $padre['Apellido_Materno'] . "";
             }
             if ($madreID) {
                $sqlmadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
                $stmtmadre = $pdo->prepare($sqlmadre);
                $stmtmadre->execute([$madreID]);
                $madre = $stmtmadre->fetch();
               // echo "" . $madre['Nombre'] . " " . $madre['Apellido_Paterno'] . " " . $madre['Apellido_Materno'] . "";
             }
   ?> 
   <br>


        Padre: 
        <select name="PadreID">
            <?php

            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='M' ORDER BY Nombre";
            $stmt = $pdo->query($sql);
            if ($padreID) {
                echo "<option value='$padreID'selected>" . $padre['Nombre'] . " " . $padre['Apellido_Paterno'] . " " . $padre['Apellido_Materno'] . "</option>";
                while($row = $stmt->fetch()) {
                    echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
                }
            } else {
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $stmt->fetch()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
        }
            ?>
        </select><br>

    
        Madre: 
        <select name="MadreID">
            <?php
                

            if ($madreID) {
                echo "<option value='$madreID'selected>" . $madre['Nombre'] . " " . $madre['Apellido_Paterno'] . " " . $madre['Apellido_Materno'] . "</option>";
                while($row = $stmt->fetch()) {
                    echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
                }
            } else {
             $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='F' ORDER BY Nombre";
            $stmt = $pdo->query($sql);    
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $stmt->fetch()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
        }
            ?>
        </select><br>
        Conyuge1: 
        <select name="Conyuge1">
            <?php

            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas ORDER BY Nombre";
            $stmt = $pdo->query($sql);
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $stmt->fetch()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
            ?>
        </select><br>
        Fecha de 1er Matrimonio: <input type="date" value= "0999-01-01" name="Fecha_Boda_1"><br>
        Conyuge2: 
        <select name="Conyuge2">
            <?php

            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas ORDER BY Nombre";
            $stmt = $pdo->query($sql);
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $stmt->fetch()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
            ?>
        </select><br>
        Fecha de 2do Matrimonio: <input type="date" value= "0999-01-01" name="Fecha_Boda_2"><br>
        <input type="text"  name="Origen" value="CHER" hidden><br>
        <input type="submit" class= "botong" value="Cargar a GenealoRico">
    </form>
</div>
</body>
</html>
