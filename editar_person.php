
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GenealoRico - Visor-Editor</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
            font-size: 20px;
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
        .img {
            width: 100%;
            max-width: 200px;
            display: flex;
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
            max-width: 700px;
            text-align: initial;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
             font-size: 30px;

        }
        .labelp {
            display: block;
            margin-bottom: 10px;  
            font-size: 30px;
            font-weight: bold;
             text-align: initial;
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
            font-size: 35px;
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
        select {
            max-width: 400px;
        }

        @media screen and (max-width: 668px) {
            .contenedor {
                width: 90%;
            }
            .img {
                max-width: 
            }
        }
    </style>
</head>
<body>
    <h1>Visor/Editor de Datos </h1>
   
</body>
</html>
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

// Mostrar los datos en un formulario para editar
?>
 <hr>
 <nav class="menu">
        <ul class="menu-list">
            <li class="menu-item">
                <a href="index.php"><img src="Genealorico/fotos/home-02.png" alt="Icono 1"><div class="hover-text">Ir a Inicio</div></a>                
            </li>
            <li class="menu-item">
                <a href="ver_arbol.php?persona=<?php echo $personaID; ?>"><img src="Genealorico/fotos/ver arbol-02.png" alt="Icono 3"></a>
            </li>
            <li class="menu-item">
                <a href="ver_personas.php?persona=<?php echo $personaID; ?>"><img src="Genealorico/fotos/volver-02.png" alt="Icono 3"></a>
            </li>
        </ul>
        </nav>
<hr>

<div class="contenedor">
    <form action="upload_update.php" method="post" enctype="multipart/form-data">
        <input type="text"  name="PersonaID" value="<?php echo $persona['PersonaID']; ?>" required hidden ><br> 
        <label> Nombre: <input type="text"  name="Nombre" value="<?php echo $persona['Nombre']; ?>" required></label>
        <label>Apellido Paterno: <input type="text" name="Apellido_Paterno" value="<?php echo $persona['Apellido_Paterno']; ?>" required></label>
        <label>Apellido Materno: <input type="text" name="Apellido_Materno" value="<?php echo $persona['Apellido_Materno']; ?>"></label>
        <?php
            if (empty($persona['Fecha_de_Nacimiento'])) {
                $persona['Fecha_de_Nacimiento'] = "0999-01-01";
            }
        ?>   
        <label>Fecha de Nacimiento: <input type="date" value="<?php echo $persona['Fecha_de_Nacimiento']; ?>" name="Fecha_de_Nacimiento"></label>
        <label>Lugar de Nacimiento: <input type="text" name="Lugar_de_Nacimiento" value="<?php echo $persona['Lugar_de_Nacimiento']; ?>"></label>
           <?php
            if (empty($persona['Fecha_de_Defunción'])) {
                $persona['Fecha_de_Defunción'] = "0999-01-01";
            }
        ?>       
        <label>Fecha de Defunción: <input type="date" value="<?php echo $persona['Fecha_de_Defunción']; ?>" name="Fecha_de_Defunción"></label>
        <label>Lugar de Defunción: <input type="text" name="Lugar_de_Defunción" value="<?php echo $persona['Lugar_de_Defunción']; ?>"></label>
         <?php       if (!empty($persona['Foto'])) {
            $persona['Foto'] = $persona['Foto'];
        }
        ?>
        <label>
         Foto:
        </label>
         <input type="text" name="Foto" value="<?php echo $persona['Foto']; ?>"><br> 
        <div class="contenedor"> 
                <img id="foto" width="200px" src="<?php echo $persona['Foto']; ?>" >
        </div>
        <label>Cargar otra foto: <input type="file" name="Foto"></label>
        <label>Género (F ó M): <input type="text" name="Genero" value="<?php echo $persona['Genero']; ?>"></label>

        
    <!-- Edición del Padre    -->    
        <label for="padre" class="labelp">Padre:
               <select name="padre" id="padre"> 
               <option value="<?php echo $persona['PadreID']?>">Seleccionar</option> 
               <option value="0" >No se conoce</option> 
            <?php
            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='M' ORDER BY Nombre";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row["PersonaID"]."'>".$row["Nombre"]." ".$row["Apellido_Paterno"]." ".$row["Apellido_Materno"]."</option>";
            }
            ?>
   <!-- Edición de la Madre    -->
    </select><br> 
        <label for="madre"class="labelp">Madre:
             <select name="madre" id="madre">   
             <option value="<?php echo $persona['MadreID']?>">Seleccionar</option>
             <option value="0" >No se conoce</option> 
            <?php        
            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='F' ORDER BY Nombre";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
            echo "<option value='".$row["PersonaID"]."'>".$row["Nombre"]." ".$row["Apellido_Paterno"]." ".$row["Apellido_Materno"]."</option>";
            }      
            ?> 

<!-- Edición del conyuge1    -->
    </select><br>       
        <label for="conyuge1" class="labelp">Conyuge1:
            <select name="Conyuge1" id="Conyuge1"> 
            <option value="<?php echo $persona['Conyuge1']?>">Seleccionar</option> 
            <option value="0" >No se conoce</option>  
            <?php        
            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas ORDER BY Nombre ";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
            echo "<option value='".$row["PersonaID"]."'>".$row["Nombre"]." ".$row["Apellido_Paterno"]." ".$row["Apellido_Materno"]."</option>";
            }
            ?>    

        </select><br>
        <?php
            if (empty($persona['Fecha_Boda_1'])) {
                $persona['Fecha_Boda_1'] = "0999-01-01";
            }
        ?>  
        <label>Fecha de 1er Matrimonio: <input type="date" value="<?php echo $persona['Fecha_Boda_1']; ?>" name="Fecha_Boda_1"><br>
        <label>Lugar de residencia principal:</label> <input type="text" name="Habita_en" value="<?php echo $persona['Habita_en']; ?>">
 <!-- Edición del conyuge2    -->
    </select><br>       
        <label for="conyuge2" class="labelp">Conyuge2:
            <select name="Conyuge2" id="Conyuge2">  
            <option value="<?php echo $persona['Conyuge2']?>">Seleccionar</option>
            <option value="0" >No se conoce</option>    
            <?php        
            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas ORDER BY Nombre ";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
            echo "<option value='".$row["PersonaID"]."'>".$row["Nombre"]." ".$row["Apellido_Paterno"]." ".$row["Apellido_Materno"]."</option>";      
            }
            ?>    
 </select><br>
        <?php
            if (empty($persona['Fecha_Boda_2'])) {
                $persona['Fecha_Boda_2'] = "0999-01-01";
            }
        ?> 
        <label>Fecha de 2do Matrimonio: <input type="date" value="<?php echo $persona['Fecha_Boda_2']; ?>" name="Fecha_Boda_2"><br>
        <script> function recargarPagina() { location.reload(); // Recarga la página actual } </script>
        <input type="submit" class="botong" value="Actualizar Datos de la Persona">
    </form>
</div>
</body>
</html>
