
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Crear Nueva Persona</title>
    <style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            font-size: 35px;
        }
        h1, h2 {
            color: #333;
        }
        input {
            width: 295px;
            height: 40px;
            font-size: 30px;
            margin: 5px;
            border-radius: 4px;
        }
        input .imputsubmit {
               width: 400px;
            height: 50px;
        }
        select {
            width: 400px;
            height: 40px;
            font-size: 30px;
            margin: 5px;
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
            max-width: 800px;
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
        .botong {
            font-family: Arial, sans-serif;
            font-size: 30px;
            font-weight: bold;
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
            
        }  
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            display: inline;
            margin-right: 10px;
        }
        form {
            margin-bottom: 20px;
            max-width: 700px;
            text-align: initial;
        }
    .custom-file-upload { 
        font-size: 30px; /* Tamaño de la fuente */ 
        margin: 3px;
        color: #000; /* Color del texto */ 
        background-color: #e6e6e6; /* Color de fondo */ 
        padding: 10px 20px; /* Relleno */ 
        height: 40px;
        border-radius: 5px; /* Esquinas redondeadas */ 
    } .custom-file-upload:hover { 
        background-color: #bbb; /* Color de fondo en hover */ 
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
$persona = isset($_GET['persona']) ? $_GET['persona'] : '';
echo "$persona";
$padreID = isset($_GET['padre']) ? $_GET['padre'] : '';
echo "$padreID";
$madreID = isset($_GET['madre']) ? $_GET['madre'] : '';
$apellido_paterno = isset($_GET['apellido_paterno']) ? $_GET['apellido_paterno'] : '';
$apellido_materno = isset($_GET['apellido_materno']) ? $_GET['apellido_materno'] : '';
require 'conexion.php';
$conexion = new Conexion();
$pdo = $conexion->pdo;
}else {
    $apellido_paterno = "";
    $apellido_materno = "";
    $padreID ="";
    $madreID ="";
}



?>
<body>
    <h1>Crear Nueva Persona</h1>
    <!-- Cabecera de la pagina -->
    <hr>
 <nav class="menu">
        <ul class="menu-list">
            <li class="menu-item">
                <a href="index.php"><img src="Genealorico/fotos/home-02.png" alt="Icono 1"><div class="hover-text">Ir a Inicio</div></a>
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
      
        <label for="file-upload" >Carga una foto</label> 
        <input id="file-upload" class="custom-file-upload" type="file" name="Foto" value="" /><br>
        Género: 
        <select name="Genero" required>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select><br>
        Vive o vivió en: <input type="text" name="Habita_en"><br>


        
         <?php
             require 'conexion.php';
             $conexion = new Conexion();
             $pdo = $conexion->pdo;
            //  $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='M' ORDER BY Nombre";
            //  $stmt = $pdo->query($sql);
            //  echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            //  while($row = $stmt->fetch()) {
            //      echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            //  }
         ?> 
        Padre: 
        <select name="PadreID">
            <?php

            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='M' ORDER BY Nombre";
            $stmt = $pdo->query($sql);
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $stmt->fetch()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
            ?>
        </select>

        <br>
        Madre: 
        <select name="MadreID">
            <?php

            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='F' ORDER BY Nombre";
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

            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas ORDER BY Nombre";
            $stmt = $pdo->query($sql);
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $stmt->fetch()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
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
        2do Matrimonio:
        <input type="date" value= "0999-01-01" name="Fecha_Boda_2"><br>
        <input  type="text" value= "CPER" name="Origen" hidden>
        <input class="botong" type="submit"  value="Cargar a GenealoRico" height="100px"  >
    </form>
</div>
</body>
</html>
