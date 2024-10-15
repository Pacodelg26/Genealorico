<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Nueva Persona</title>
</head>
<body>
    <h1>Editar Persona</h1>
    <form action="edit.php" method="post" enctype="multipart/form-data">
    <?php
if (isset($_GET['id'])){  // && isset($_GET['nombre'])) {
    $persona_elegida = $_GET['id'];
    $nombre = $_GET['nombre'];
    $apellido_paterno = $_GET['apellido_paterno'];
    $apellido_materno = $_GET['apellido_materno'];
 echo $persona_elegida;
 //echo $nombre;
 // Salida:

 // Preparar y ejecutar la consulta
//$stmt = $conn->prepare("SELECT Nombre FROM Personas WHERE PersonaID = ?");
//$stmt->bind_param("i", $persona_elegida); // "i" indica que la variable es de tipo entero
//$stmt->execute();

// Obtener el resultado
//$result = $stmt->get_result();
//while($row = $result->fetch_assoc()) {
  //  .$row['Nombre'];
//}
} 
   //  <td><a href='edit.php?id="urlencode(.$row['PersonaID'])."&nombre="urlencode(.$row['Nombre'])."'>Editar</a></td> 
   
//<?php echo $nombre; 

 
     ?>
     <br>
        Nombre: <input type="text" value= <?php echo $nombre?> name="Nombre" required><br>
   
        Apellido Paterno: <input type="text" value= <?php echo $apellido_paterno?> name="Apellido_Paterno" required><br>
        Apellido Materno: <input type="text" value= <?php echo $apellido_materno?> name="Apellido_Materno"><br>
        Fecha de Nacimiento: <input type="date" name="Fecha_de_Nacimiento"><br>
        Lugar de Nacimiento: <input type="text" name="Lugar_de_Nacimiento"><br>
        Fecha de Defunción: <input type="date"  name="Fecha_de_Defunción"><br>
        Lugar de Defunción: <input type="text" name="Lugar_de_Defunción"><br>
        Foto: <input type="file" name="Foto"><br>
        Género: 
        <select name="Genero" required>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select><br>
        
        
        Padre: 
        <select name="PadreID">
       
            <?php
            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='M'";
            $result = $conn->query($sql);
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
            ?>
        </select><br>
        Madre: 
        <select name="MadreID">
            <?php
            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas WHERE Genero='F'";
            $result = $conn->query($sql);
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
            ?>
        </select><br>
        Conyuge1: 
        <select name="Conyuge1">
            <?php
            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas";
            $result = $conn->query($sql);
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
            ?>
        </select><br>
        Conyuge2: 
        <select name="Conyuge2">
            <?php
            $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas";
            $result = $conn->query($sql);
            echo "<option value='0' selected>Seleccione una persona</option>"; // Opción por defecto
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['PersonaID']."'>".$row['Nombre']." ".$row['Apellido_Paterno']." ".$row['Apellido_Materno']."</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Crear">
    </form>
</body>
</html>
