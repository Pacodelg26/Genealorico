
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GenealoRico - Visor-Editor</title>
    <link rel="stylesheet" href="styles.css">
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

// Obtener el PersonaID de la URL
//$personaID = $_GET['persona'];

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
     <h2>Paginas del proyecto</h2>
     
     <ul>
            <li>
                <a href="index.php">Página de Inicio</a>
                 --
                 <a href="ver_personas.php?persona=<?php echo $personaID; ?>">Volver</a> 
                 --
                 <a href="ver_arbol.php?persona=<?php echo $personaID; ?>">Ver Arbol</a> 
            </li>
     </ul>
     <hr>
<div class="contenedor">

    <form action="upload_update.php" method="post" enctype="multipart/form-data">
        PersonaID: <input type="text"  name="PersonaID" value="<?php echo $persona['PersonaID']; ?>" required><br>
        Nombre: <input type="text"  name="Nombre" value="<?php echo $persona['Nombre']; ?>" required><br>
        Apellido Paterno: <input type="text" name="Apellido_Paterno" value="<?php echo $persona['Apellido_Paterno']; ?>" required><br>
        Apellido Materno: <input type="text" name="Apellido_Materno" value="<?php echo $persona['Apellido_Materno']; ?>"><br>
        <?php
            if (empty($persona['Fecha_de_Nacimiento'])) {
                $persona['Fecha_de_Nacimiento'] = "0999-01-01";
            }
        ?>   
        Fecha de Nacimiento: <input type="date" value="<?php echo $persona['Fecha_de_Nacimiento']; ?>" name="Fecha_de_Nacimiento"><br>
        Lugar de Nacimiento: <input type="text" name="Lugar_de_Nacimiento" value="<?php echo $persona['Lugar_de_Nacimiento']; ?>"><br>
           <?php
            if (empty($persona['Fecha_de_Defunción'])) {
                $persona['Fecha_de_Defunción'] = "0999-01-01";
            }
        ?>       
        Fecha de Defunción: <input type="date" value="<?php echo $persona['Fecha_de_Defunción']; ?>" name="Fecha_de_Defunción"><br>
        Lugar de Defunción: <input type="text" name="Lugar_de_Defunción" value="<?php echo $persona['Lugar_de_Defunción']; ?>"><br>
         <?php       if (!empty($persona['Foto'])) {
            $persona['Foto'] = $persona['Foto'];
        }
        ?>
        Foto <input type="text" name="Foto" value="<?php echo $persona['Foto']; ?>"><br>
        <div class="contenedor">
                <img id="foto" width="200px" src="<?php echo $persona['Foto']; ?>" >
        </div>
        Cargar otra foto: <input type="file" name="Foto"><br> 
        Género (F ó M): <input type="text" name="Genero" value="<?php echo $persona['Genero']; ?>"><br>
        <?php
       


?>



        
    <!-- Edición del Padre    -->    
        <label for="padre">Padre:</label>
   
   <?php
             if ($persona['PadreID']) {
               $sqlpadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
               $stmtpadre = $pdo->prepare($sqlpadre);
               $stmtpadre->execute([$persona['PadreID']]);
               $padre = $stmtpadre->fetch();
               echo "" . $padre['Nombre'] . " " . $padre['Apellido_Paterno'] . " " . $padre['Apellido_Materno'] . "";
             }
   ?> 
   <br>
            <label for="padre">o Selecciona Padre:</label>    
            <select name="padre" id="padre"> 
                <option value="<?php echo $persona['PadreID']?>">Seleccionar</option>  
   <?php
   
           $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='M'";
           $result = $conn->query($sql);
           while($row = $result->fetch_assoc()) {
           echo "<option value='".$row["PersonaID"]."'>".$row["Nombre"]." ".$row["Apellido_Paterno"]." ".$row["Apellido_Materno"]."</option>";
           }
   
   ?>
   <!-- Edición de la Madre    -->
    </select><br> 
        <label for="madre">Madre:</label>
   
   <?php
       if ($persona['MadreID']) {
           $sqlmadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
           $stmtmadre = $pdo->prepare($sqlmadre);
           $stmtmadre->execute([$persona['MadreID']]);
           $madre = $stmtmadre->fetch();
           echo "" . $madre['Nombre'] . " " . $madre['Apellido_Paterno'] . " " . $madre['Apellido_Materno'] . "";
       }

   ?>
   <br>
            <label for="madre">o Selecciona Madre:</label>    
             <select name="madre" id="madre">  
             <option value="<?php echo $persona['MadreID']?>">Seleccionar</option> 
<?php        
       $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='F'";
       $result = $conn->query($sql);
       while($row = $result->fetch_assoc()) {
       echo "<option value='".$row["PersonaID"]."'>".$row["Nombre"]." ".$row["Apellido_Paterno"]." ".$row["Apellido_Materno"]."</option>";
   }
?> 
<!-- Edición del conyuge1    -->
    </select><br>       
    <label for="conyuge1">Conyuge1:</label>
   
   <?php
       if ($persona['Conyuge1']) {
           $sqlConyuge1 = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
           $stmtConyuge1 = $pdo->prepare($sqlConyuge1);
           $stmtConyuge1->execute([$persona['Conyuge1']]);
           $Conyuge1 = $stmtConyuge1->fetch();
           echo "" . $Conyuge1['Nombre'] . " " . $Conyuge1['Apellido_Paterno'] . " " . $Conyuge1['Apellido_Materno'] . "";
       }

   ?>
<br>
            <label for="Conyuge1">o Selecciona de la lista:</label>    
   <select name="Conyuge1" id="Conyuge1"> 
   <option value="<?php echo $persona['Conyuge1']?>">Seleccionar</option>   
<?php        
       $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas ";
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
        Fecha de 1er Matrimonio: <input type="date" value="<?php echo $persona['Fecha_Boda_1']; ?>" name="Fecha_Boda_1"><br>
        Vive o vivió en: <input type="text" name="Habita_en" value="<?php echo $persona['Habita_en']; ?>">
 <!-- Edición del conyuge2    -->
 </select><br>       
    <label for="conyuge2">Conyuge2:</label>
   
   <?php
       if ($persona['Conyuge2']) {
           $sqlConyuge2 = "SELECT Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE PersonaID = ?";
           $stmtConyuge2 = $pdo->prepare($sqlConyuge2);
           $stmtConyuge2->execute([$persona['Conyuge2']]);
           $Conyuge2 = $stmtConyuge2->fetch();
           echo "" . $Conyuge2['Nombre'] . " " . $Conyuge2['Apellido_Paterno'] . " " . $Conyuge2['Apellido_Materno'] . "";
       }

   ?>
<br>
            <label for="Conyuge2">o Selecciona de la lista:</label>    
            <select name="Conyuge2" id="Conyuge2">
            <option value="<?php echo $persona['Conyuge2']?>">Seleccionar</option>   
<?php        
       
    $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas ";
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
        Fecha de 2do Matrimonio: <input type="date" value="<?php echo $persona['Fecha_Boda_2']; ?>" name="Fecha_Boda_2"><br>
     
        <input type="submit" value="Crear">
    </form>
</div>
</body>
</html>
