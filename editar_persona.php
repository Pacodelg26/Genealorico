
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
    // if (isset($_GET['persona'])) {
    //     $personaID = $_GET['persona'];
    //     require 'conexion.php';
    //     $conexion = new Conexion();
    //     $pdo = $conexion->pdo;

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
$personaID = $_GET['persona'];

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
<body>
    <div class="contenedor">
    <form action="actualizar_persona.php" method="post">
        <input type="text" name="PersonaID" value="<?php echo $persona['PersonaID']; ?>"><br>
        <label for="Nombre">Nombre:</label>
        <input type="text" id="nombre" name="Nombre" value="<?php echo $persona['Nombre']; ?>"><br>
        <label for="Apellido_Paterno">Apellido Paterno:</label>
        <input type="text" id="apellido_paterno" name="Apellido_Paterno" value="<?php echo $persona['Apellido_Paterno']; ?>"> <br>    
        
        <label for="Apellido_Materno">Apellido Materno:</label>
        <input type="text" id="apellido_materno" name="Apellido_Materno" value="<?php echo $persona['Apellido_Materno']; ?>"> <br>  
        <label for="Fecha_de_Nacimiento">Fecha de Nacimiento: YYYY-MM-DD</label>
        <input type="text" id="fecha_de_nacimiento" name="Fecha_de_Nacimiento" value="<?php echo $persona['Fecha_de_Nacimiento']; ?>"> <br>
        <label for="lugar_de_nacimiento">Lugar de Nacimiento:</label>
        <input type="text" id="lugar_de_nacimiento" name="Lugar_de_Nacimiento" value="<?php echo $persona['Lugar_de_Nacimiento']; ?>"> <br>  
        <label for="fecha_de_defuncion">Fecha de Defunción: YYYY-MM-DD</label>
        <input type="text" id="fecha_de_defuncion" name="Fecha_de_Defunción" value="<?php echo $persona['Fecha_de_Defunción']; ?>"><br>
        <label for="lugar_de_defuncion">Lugar de Defunción:</label>
        <input type="text" id="lugar_de_defuncion" name="Lugar_de_Defunción" value="<?php echo $persona['Lugar_de_Defunción']; ?>"> <br>  
        <button type="submit">Actualizar</button>
    </div>    
        <div class="contenedor">
        <h2>Foto Actual</h2>
</div>
<div class="contenedor">
        <img id="fotoActual" src="<?php echo $persona['Foto']; ?>" alt="Foto Actual" width="200">
        </div>    
    </form>
    
    
</body>
</html>
<?php
$stmt->close();
$conn->close();

//<label for="apellido_paterno">Apellido Paterno:</label>
//<input type="text" id="apellido_paterno" name="Apellido Paterno" value="<?php echo $persona['Apellido_Paterno']; 

?>
