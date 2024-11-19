<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Cargar Persona</title>
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
  



<?php
include 'db.php';

$nombre = $_POST['Nombre'];
$apellido_paterno = $_POST['Apellido_Paterno'];
$apellido_materno = $_POST['Apellido_Materno'];
$valida_fecha = "0999/01/02";
$fecha_nacimiento = $_POST['Fecha_de_Nacimiento'];
$lugar_nacimiento = $_POST['Lugar_de_Nacimiento'];
$fecha_defuncion = $_POST['Fecha_de_Defunción'];
$lugar_defuncion = $_POST['Lugar_de_Defunción'];

$genero = $_POST['Genero'];
$habita_en = $_POST['Habita_en'];
$padre_id = $_POST['PadreID'];
$madre_id = $_POST['MadreID'];
$conyuge1 = $_POST['Conyuge1'];
$fecha_boda_1 = $_POST['Fecha_Boda_1'];
$conyuge2 = $_POST['Conyuge2'];
$fecha_boda_2 = $_POST['Fecha_Boda_2'];
$pagina_origen = $_POST['Origen'];

if ($pagina_origen == "CM" ){
  $hijo = $_POST['HijoID'];  
}
if ($pagina_origen == "CP" ){
    $hijo = $_POST['HijoID'];  
}
//if ($_POST['origen'] = "CHIJO" ){
  //  $hijo = $_POST['Padre'];  
//}


// Carga de la foto

$target_dir = "public/images/";
$target_file = $target_dir . basename($_FILES["Foto"]["name"]);
move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file);

if (!empty($foto)) {
    // Si se ha subido una nueva foto
    $persona['Foto'] = 'public/images/' . $_FILES['Foto']['name']; 
    $foto=$persona['Foto'];
    //echo "<br>hay foto cargada ";
    //echo "$foto";
} else if ((empty($foto)) AND (empty($fotonueva))) {
    // Si no hay foto y se basa en el género
    if ($genero == 'M') {
        $persona['Foto'] = 'public/images/hombre.jpg';
        $foto=$persona['Foto'];
        //echo "No hay foto nueva ni en la base de datos y es un hombre";
        //echo "<br>foto actual $foto";
    } elseif ($genero == 'F') {
        $persona['Foto'] = 'public/images/mujer.jpg';
        $foto=$persona['Foto']; 
        //echo "No hay foto nueva ni en la base de datos y es una Mujer ";
        //echo "$foto";
    } else {
        $persona['Foto'] = 'public/images/default.jpg'; // Opcional: un valor por defecto si el género no es M o F
        $foto=$persona['Foto'];
        //echo "$foto";
    }
}

// Validar fechas de nac, def, boda1 y boda 2
//0000
if ( ($fecha_defuncion < $valida_fecha) AND ($fecha_nacimiento < $valida_fecha) AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)  ){
$sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Conyuge2)
VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento', '$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
//0001    
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Conyuge2, Fecha_Boda_2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno',  '$lugar_nacimiento',  '$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1',  '$conyuge2', '$fecha_boda_2')";
//0010
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento','$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2')";
//0011
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2, Fecha_Boda_2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento','$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2', '$fecha_boda_2')";
 //0100
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Conyuge2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
 //0101
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Fecha_Boda_2, Conyuge2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_2', '$conyuge2')";
//0110
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno,  Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento', '$fecha_de_defuncion','$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2')";
 //0111
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion | $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Fecha_de_Defunción,Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2, Fecha_Boda_2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento','$fecha_de_defuncion','$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2', '$fecha_boda_2')";
//1000
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha) AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha) ) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Conyuge2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
//1001
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
$sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Fecha_Boda_2, Conyuge2)
VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_2', '$conyuge2')";
//1010
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2)
VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2')";
//1011
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2, Fecha_Boda_2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2', '$fecha_boda_2')";
//1100
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Conyuge2)
VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
//1101
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Conyuge2, Fecha_Boda_2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2', '$fecha_boda_2')";
//1110
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2)
VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2')";
//1111
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, Habita_en, PadreID, MadreID, Conyuge1, Fecha_boda_1, Conyuge2, Fecha_Boda_2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$foto', '$genero', '$habita_en', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2', '$fecha_boda_2')";
}
?>
<body>
<h1>Cargar Persona a Genealorico</h1>
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



// Validar registro creado
if ($conn->query($sql) === TRUE) {
     $persona_id = $conn->insert_id; echo "<br>Nuevo registro creado con éxito. El ID del registro es: " . $persona_id. " ";
    ?>
    <body onload="delayAction()"> <h1>Actualizando</h1> <p id="message"></p>
    <?php
} else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
<script> function delayAction() { 
    setTimeout(function() {
         // Mostrar un mensaje 
         document.getElementById('message').innerText = 'Registro finalizado'; 
         // Redirigir a la página PHP después de un intervalo 
         setTimeout(function() { window.location.href = 'ver_personas.php?persona=<?php echo $persona_id ?>'; }, 3000); 
         // Retraso de 5 segundos 
         }, 3000); 
         // Retraso inicial de 5 segundos 
         } 
</script>

<?php

   



// Si venimos de crear Padre o  Crear Madre actualizamos los hijos con los nuevos registros
if ($pagina_origen == "CP") {
    //Si en la carga de Padre venia una madre como conyuge...
    if ($conyuge1 >"0"){ // es decir si el registro original tenia madre y la hemos cargado aqui
        //actualizamos la madre con el nuevo registro como conyuge    
        $updateSql = "UPDATE Personas SET Conyuge1 = $persona_id WHERE PersonaID = $conyuge1";
   
        //validamos el registro de conyuges
        if ($conn->query($updateSql) === TRUE) { echo "<br>Registrode conyuges actualizado con éxito."; 
        } 
        else { 
        echo "<br>Error al actualizar el registro del cónyuge: " . $conn->error; 
        }
        // actualizamos los hijos que tenian la misma madre que el conyuge del registro creado
        $updatehijosql = "UPDATE Personas Set PadreID = $persona_id WHERE MadreID = $conyuge1";
        //validamos el registro de padres de los hijos de la madre conyuge
        if ($conn->query($updatehijosql) === TRUE) { echo "Registro de hermanos del inclito actualizado con éxito."; 
        } 
        else { 
        echo "<br>Error al actualizar el registro del padre de los hermanos del inclito: " . $conn->error; 
        }
    }
    if ($hijo >"0"){ // comprobamos si estamos creando desde 0 o si venimos de crear padre
        //actualizamos el hijo con su nuevo padre
        
            $updatehijoql = "UPDATE Personas SET PadreID = $persona_id WHERE PersonaID = $hijo";
            if ($conn->query($updatehijoql) === TRUE) { 
            echo "Registro de padre actualizado con éxito."; 
            } 
        else { 
        echo "<br>Error al actualizar el registro del padre del inclito: " . $conn->error; 
        }
    }    
 
} else if ($pagina_origen == "CM") {
    //Si en la carga de Madre venia un Padre como conyuge...
    if ($conyuge1 >"0"){ // es decir si el registro original tenia Padre y la hemos cargado aqui
        //actualizamos el padre con el nuevo registro como conyuge    
        $updateSql = "UPDATE Personas SET Conyuge1 = $persona_id WHERE PersonaID = $conyuge1";
   
        //validamos el registro de conyuges
        if ($conn->query($updateSql) === TRUE) { echo "<br>Registrode conyuges actualizado con éxito."; 
        } 
        else { 
        echo "<br>Error al actualizar el registro del cónyuge: " . $conn->error; 
        }
        // actualizamos los hijos que tenian el mismo padre que el conyuge del registro creado
        $updatehijosql = "UPDATE Personas Set MadreID = $persona_id WHERE PadreID = $conyuge1";
        //validamos el registro de padres de los hijos de la madre conyuge
        if ($conn->query($updatehijosql) === TRUE) { echo "Registro de hermanos del inclito actualizado con éxito."; 
        } 
        else { 
        echo "<br>Error al actualizar el registro del padre de los hermanos del inclito: " . $conn->error; 
        }
    }
    if ($hijo >"0"){ // comprobamos si estamos creando desde 0 o si venimos de crear padre
        //actualizamos el hijo con su nuevo padre
        
            $updatehijoql = "UPDATE Personas SET MadreID = $persona_id WHERE PersonaID = $hijo";
            if ($conn->query($updatehijoql) === TRUE) { 
            echo "Registro de madre actualizado con éxito."; 
            } 
        else { 
        echo "<br>Error al actualizar el registro de la madre del inclito: " . $conn->error; 
        }
    }    
} else if ($pagina_origen == "CHER") {
    //Si hay Padre hay que cargarlo como padre en el nuevo regist
    if ($padre_id >"0"){ 


 }  
} else if ($pagina_origen == "CCYG") {
   //cargar conyuge contrario
    if ($conyuge1>"0"){ 
        $updateconyugesql = "UPDATE Personas SET Conyuge1 = $persona_id WHERE PersonaID = $conyuge1";
        if ($conn->query($updateconyugesql) === TRUE) { 
            echo "Registro de conyuge actualizado con éxito."; 
            } 
        else { 
        echo "<br>Error al actualizar el registro de conyuge del inclito: " . $conn->error; 
        }
 }  
}





 

$conn->close(); 
?>