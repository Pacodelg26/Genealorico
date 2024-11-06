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
$foto= $_POST['Foto'];
$genero = $_POST['Genero'];
$habita_en = $_POST['Habita_en']
$padre_id = $_POST['PadreID'];
$madre_id = $_POST['MadreID'];
$conyuge1 = $_POST['Conyuge1'];
$fecha_boda_1 = $_POST['Fecha_Boda_1'];
$conyuge2 = $_POST['Conyuge2'];
$fecha_boda_2 = $_POST['Fecha_Boda_2'];
// Carga de la foto

$target_dir = "Genealorico/fotos/";
$target_file = $target_dir . basename($_FILES["Foto"]["name"]);
move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file);

if (!empty($foto)) {
    // Si se ha subido una nueva foto
    $persona['Foto'] = 'Genealorico/fotos/' . $_FILES['Foto']['name']; 
    $foto=$persona['Foto'];
    echo "hay foto nueva ";
    echo "$foto";
} else if ((empty($foto)) AND (empty($fotonueva))) {
    // Si no hay foto y se basa en el género
    if ($genero == 'M') {
        $persona['Foto'] = 'Genealorico/fotos/hombre.jpg';
        $foto=$persona['Foto'];
        echo "No hay foto nueva ni en la base de datos y es un hombre";
        echo "<br>foto actual $foto";
    } elseif ($genero == 'F') {
        $persona['Foto'] = 'Genealorico/fotos/mujer.jpg';
        $foto=$persona['Foto']; 
        echo "No hay foto nueva ni en la base de datos y es una Mujer ";
        echo "$foto";
    } else {
        $persona['Foto'] = 'Genealorico/fotos/default.jpg'; // Opcional: un valor por defecto si el género no es M o F
        $foto=$persona['Foto'];
        echo "$foto";
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
<h1>Visor de Personas </h1>
    <hr>
      <nav class="menu">
        <ul class="menu-list">
            <li class="menu-item">
                <a href="index.php"><img src="Genealorico/fotos/Home.png" alt="Icono 1"><div class="hover-text">Ir a Inicio</div></a>
                
            </li>
            <li class="menu-item">
                <a href="crear_persona.php"><img src="Genealorico/fotos/Crear Persona.png" alt="Icono 2"></a>
            </li>
            <li class="menu-item">
                <a href="ver_arbol.php?persona=<?php echo $personaID; ?>"><img src="Genealorico/fotos/Ver Arbol.png" alt="Icono 3"></a>
            </li>
            <li class="menu-item">
                <a href="editar_person.php?persona=<?php echo $personaID; ?>"><img src="Genealorico/fotos/Editar Persona.png" alt="Icono 3"></a>
            </li>
        </ul>
        </nav>

     <hr>    
      
 <?php
// Validar registro creado
if ($conn->query($sql) === TRUE) {
    echo "Registro creado exitosamente";
  header("Location: index.php");

} else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "SELECT PersonaID, Conyuge1 FROM Personas WHERE PersonaID = '$conyuge1'" ;
if (empty($conyuge1)) {
    $sql = "UPDATE Personas SET Conyuge1 = '$personaID'  WHERE PersonaID = '$conyuge1'";
}


$conn->close(); 
?>