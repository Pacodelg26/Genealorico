<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Borrar Persona</title>
</head>
<style>

 
        body {
            width: 85%;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0 auto;
            padding: 0;
            text-align: center;
            font-size: 18px;
        } 
        label {
            font-size: 30px;
        }
            button {
              font-size: 25px;  
            }

        .contenedor {
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 700px;
        }
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 30px;
            
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
 <script> function delayAction() { 
    setTimeout(function() {
         // Mostrar un mensaje 
         document.getElementById('message').innerText = 'Persona Borrada'; 
         // Redirigir a la página PHP después de un intervalo 
         setTimeout(function() { window.location.href = 'index.php'; }, 3000); 
         // Retraso de 5 segundos 
         }, 3000); 
         // Retraso inicial de 5 segundos 
         } 
</script> 
<body>
<h1>Borrar una Persona</h1>
    <hr>
      <nav class="menu">
        <ul class="menu-list">
            <li class="menu-item">
                <a href="index.php"><img src="Genealorico/fotos/home-02.png" title="Pagina Principal" alt="Icono 1"><div class="hover-text">Ir a Inicio</div></a>
            </li>
            <li class="menu-item">
                <a href="crear_persona.php"><img src="Genealorico/fotos/añadir persona-02.png" title="Crear Persona" alt="Icono 2"></a>
            </li>

        </ul>
        </nav>

     <hr>    
<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "pacodelg";
$password = "Genealorico2024$";
$dbname = "Genealopaco";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $persona_id = $_POST['persona_id'];
    $respuesta_seguridad = $_POST['respuesta_seguridad'];

    // Pregunta de seguridad (en un caso real, esta información debería estar almacenada de manera segura en la base de datos)
    $respuesta_correcta = "Rico";

    if ($respuesta_seguridad === $respuesta_correcta) {
        $sqlUpdate = "UPDATE Personas SET PadreID = NULL WHERE PadreID = ?"; 
        $stmtUpdate = $conn->prepare($sqlUpdate); 
        $stmtUpdate->bind_param("i", $persona_id); 
        $stmtUpdate->execute(); 
        
        $sqlUpdate2 = "UPDATE Personas SET MadreID = NULL WHERE MadreID = ?"; 
        $stmtUpdate2 = $conn->prepare($sqlUpdate2); 
        $stmtUpdate2->bind_param("i", $persona_id); 
        $stmtUpdate2->execute();

        $sqlUpdate3 = "UPDATE Personas SET Conyuge1 = NULL WHERE Conyuge1 = ?"; 
        $stmtUpdate3 = $conn->prepare($sqlUpdate3); 
        $stmtUpdate3->bind_param("i", $persona_id); 
        $stmtUpdate3->execute();

        $sqlUpdate4 = "UPDATE Personas SET Conyuge2 = NULL WHERE Conyuge2 = ?"; 
        $stmtUpdate4 = $conn->prepare($sqlUpdate4); 
        $stmtUpdate4->bind_param("i", $persona_id); 
        $stmtUpdate4->execute();


        $sql = "DELETE FROM Personas WHERE PersonaID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $persona_id);
        $stmt->execute();

         if ($stmt->affected_rows > 0) { 
            
            ?>
            <body onload="delayAction()"> <h1>Borrando</h1> <p id="message"></p>
            <?php
        } else { echo "No se encontró la persona con ID: $persona_id.";
        }   
        $stmt->close();
    } else {
        echo "Respuesta de seguridad incorrecta.";
    }
} else {
    $persona_id = $_GET['persona'];
}
?>

<div class="contenedor">
<form method="POST" action="borrar.php">
    <input type="hidden" name="persona_id" value="<?php echo $persona_id; ?>">
    <label> Vas a "Borrar para siempre" un registro </label><br>
    <label>    de la base de datos </label><br>
    <label> Si no estas seguro, sal de esta pantalla </label><br>
    <label> y si lo estás, contesta a esta pregunta: </label><br>
    <label for="respuesta_seguridad">¿Cual es el segundo apellido de Paco?</label><br>
    <input type="text" id="respuesta_seguridad" name="respuesta_seguridad" required>
    <button type="submit">Borrar Persona</button>
</form>
</div>   




</body>
</html>


