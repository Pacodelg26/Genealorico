<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Crear Madre</title>
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
            margin: 10px auto;
            padding: 5px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 800px;
        }
        form {
            margin-bottom: 20px;
            max-width: 700px;
            text-align: initial;
        }
        select, input[type="text"] {
            width: calc(50% - 30px);
            padding: 8px;
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
            
        }  
        .botong {
            font-family: Arial, sans-serif;
            font-size: 30px;
            font-weight: bold;
        }
</style>

<?php
// del fichero ver personas
     if (isset($_GET['persona'])) {
         $personaID = $_GET['persona'];
         require 'conexion.php';
         $conexion = new Conexion();
        $pdo = $conexion->pdo;
     }
// Conexión a la base de datos
 $servername = "localhost";
 $username = "pacodelg";
 $password = "Genealorico2024$";
 $dbname = "Genealopaco";

 $conn = new mysqli($servername, $username, $password, $dbname);

 // Verificar la conexión
 if ($conn->connect_error) {
     die("Conexión fallida: " . $conn->connect_error);
 }


// Consulta para obtener los datos de la persona
$sql = "SELECT * FROM Personas WHERE PersonaID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $personaID);
$stmt->execute();
$result = $stmt->get_result();
$persona = $result->fetch_assoc();
// Ya tenemos el apellido materno y el Padre que será el conyuge 1 en $persona[Apellido Materno] y $persona[MadreID]
?>
<body>
<h1>Crear Madre</h1>
    <!-- Cabecera de la pagina -->
    <hr>
 <nav class="menu">
        <ul class="menu-list">
            <li class="menu-item">
                <a href="index.php"><img src="Genealorico/fotos/home-02.png" alt="Icono 1"><div class="hover-text">Ir a Inicio</div></a>
            </li>
         <li class="menu-item">
                <a href="ver_personas.php?persona=<?php echo $persona['PersonaID']; ?>"><img src="Genealorico/fotos/volver-02.png" title="Volver" alt="Ver Persona"></a>
            </li> 
        </ul>
</nav>
<hr>
<!-- // empezamos el montaje del formulario -->
<div class="contenedor">
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Nombre: <input type="text"  name="Nombre" required><br>
        Apellido Paterno: <input type="text" name="Apellido_Paterno" value="<?php echo $persona['Apellido_Materno']; ?>" required><br>
        Apellido Materno: <input type="text" name="Apellido_Materno" > <br>
        Fecha de Nacimiento: <input type="date" value= "0999-01-01" name="Fecha_de_Nacimiento"><br>
        Lugar de Nacimiento: <input type="text" name="Lugar_de_Nacimiento"><br>
        Fecha de Defunción: <input type="date" value= "0999-01-01" name="Fecha_de_Defunción"><br>
        Lugar de Defunción: <input type="text" name="Lugar_de_Defunción"><br>
        Foto: 
        <!-- <label for="file-upload" class="custom-file-upload">Selecciona una foto</label> -->
        <input id="file-upload" class="custom-file-upload" type="file" name="Foto" /><br>
        Género: 
        <select name="Genero" required>
            <option value="F">Femenino</option>
            <option value="M">Masculino</option>
            
        </select><br>
        Vive o vivió en: <input type="text" name="Habita_en"><br>
        Padre: 
        <select name="PadreID">
            <?php

            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='M' ORDER BY Nombre";
            $stmt = $pdo->query($sql);
            echo "<option value='0' selected>Seleccione un Padre</option>"; // Opción por defecto
            while($row = $stmt->fetch()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
            ?>
        </select><br>
        Madre: 
        <select name="MadreID">
            <?php

            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='F' ORDER BY Nombre";
            $stmt = $pdo->query($sql);
            echo "<option value='0' selected>Seleccione una Madre</option>"; // Opción por defecto
            while($row = $stmt->fetch()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
            ?>
        </select>
        <br>
        <!-- Aqui cogemos el padre de la persona si la hay y la convertimos en el conyuge de la madre -->
        Conyuge1: 
        <select name="Conyuge1">
            <?php
            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='M' ORDER BY Nombre";
            $stmt = $pdo->query($sql);
            if ($persona['PadreID']) {
                $sqlconyuge1 = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
                $stmtconyuge1 = $pdo->prepare($sqlconyuge1);
                $stmtconyuge1->execute([$persona['PadreID']]);
                $conyuge1 = $stmtconyuge1->fetch();
                echo "" . $conyuge1['Nombre'] . " " . $conyuge1['Apellido_Paterno'] . " " . $conyuge1['Apellido_Materno'] . "";
                echo "<option value='" . $conyuge1['PersonaID'] ."'selected>" . $conyuge1['Nombre'] . " " . $conyuge1['Apellido_Paterno'] . " " . $conyuge1['Apellido_Materno'] . "</option>";
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


        1er Matrimonio: <input type="date" value= "0999-01-01" name="Fecha_Boda_1"><br>
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
        2do Matrimonio: <input type="date" value= "0999-01-01" name="Fecha_Boda_2"><br>
        
        <input type="text"  name="HijoID" value="<?php echo $persona['PersonaID']; ?>" hidden><br>
        <input type="text"  name="Origen" value="CM" hidden><br>
   
        <input class="botong" type="submit"  value="Cargar a GenealoRico" height="100px"  >
    </form>

</div>
    