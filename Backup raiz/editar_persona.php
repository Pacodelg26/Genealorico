
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GenealoRico - Visor-Editor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Visor/Editor de Datos </h1>
    <hr>
     <h2>Paginas del proyecto</h2>
     
     <ul>
            <li>
                <a href="index.html">Página de Inicio</a>
                 --     
                <a href="visor_personas.php">Visor Personas</a>
                 --
                 <a href="editar_persona.php">Visor/editor de datos</a> 
                 --
                 <a href="visor_arbol.html">Vista de arbol</a>  
            </li>
     </ul>
</body>
</html>
<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "pacodelg";
$password = "Alcocer2626$";
$dbname = "Genealopaco";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el PersonaID de la URL
//

// Consulta para obtener los datos de la persona
$sql = "SELECT * FROM Personas WHERE PersonaID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $personaID);
$stmt->execute();
$result = $stmt->get_result();
$persona = $result->fetch_assoc();

// Mostrar los datos en un formulario para editar
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Persona</title>
</head>
<body>
    <form action="actualizar_persona.php" method="post">
        <label for="PersonaID">PersonaID:</label>
        <input type="text" name="PersonaID" value="<?php echo $persona['PersonaID']; ?>"><br>
        <label for="Nombre">Nombre:</label>
        <input type="text" id="nombre" name="Nombre" value="<?php echo $persona['Nombre']; ?>"><br>
        <label for="Apellido_Paterno">Apellido Paterno:</label>
        <input type="text" id="apellido_paterno" name="Apellido_Paterno" value="<?php echo $persona['Apellido_Paterno']; ?>"> 
        <label for="Apellido_Materno">Apellido Materno:</label>
        <input type="text" id="apellido_materno" name="Apellido_Materno" value="<?php echo $persona['Apellido_Materno']; ?>"> <br>  
        <label for="Fecha_de_Nacimiento">Fecha de Nacimiento: YYYY-MM-DD</label>
        <input type="text" id="fecha_de_nacimiento" name="Fecha_de_Nacimiento" value="<?php echo $persona['Fecha_de_Nacimiento']; ?>"> 
        <label for="lugar_de_nacimiento">Lugar de Nacimiento:</label>
        <input type="text" id="lugar_de_nacimiento" name="Lugar_de_Nacimiento" value="<?php echo $persona['Lugar_de_Nacimiento']; ?>"> <br>  
        <label for="fecha_de_defuncion">Fecha de Defunción: YYYY-MM-DD</label>
        <input type="text" id="fecha_de_defuncion" name="Fecha_de_Defunción" value="<?php echo $persona['Fecha_de_Defunción']; ?>"> 
        <label for="lugar_de_defuncion">Lugar de Defunción:</label>
        <input type="text" id="lugar_de_defuncion" name="Lugar_de_Defunción" value="<?php echo $persona['Lugar_de_Defunción']; ?>"> <br>  
        <div>
        <h2>Foto Actual</h2>
        <img id="fotoActual" src="<?php echo $persona['Foto']; ?>" alt="Foto Actual" width="200">
        </div> 
        <label for="foto">Selecciona una nueva foto:</label>
        <input type="file" name="foto" id="foto" accept="image/*" required>
        <button type="submit">Subir Foto</button>
        <p> 
        <button type="submit">Actualizar datos en la base de datos</button>
    </form>
    
    
</body>
</html>
<?php
$stmt->close();
$conn->close();


?>
