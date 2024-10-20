<?php
include 'db.php';
$personaID = $_POST['PersonaID'];
echo "$personaID";
$nombre = $_POST['Nombre'];
echo "$nombre ";
$apellido_paterno = $_POST['Apellido_Paterno'];
echo "$apellido_paterno ";
$apellido_materno = $_POST['Apellido_Materno'];
echo "$apellido_materno ";
$valida_fecha = "0999/01/02";

$fecha_nacimiento = $_POST['Fecha_de_Nacimiento'];
echo "$fecha_nacimiento ";
$lugar_nacimiento = $_POST['Lugar_de_Nacimiento'];
echo "$lugar_nacimiento ";
$fecha_defuncion = $_POST['Fecha_de_Defunción'];
echo "$fecha_defuncion ";
$lugar_defuncion = $_POST['Lugar_de_Defunción'];
echo "$lugar_defuncion ";
$foto = $_POST['Foto'];
echo "$foto ";
$genero = $_POST['Genero'];
echo "$genero ";
$padre_id = $_POST['padre'];
echo "$padre_id ";
$madre_id = $_POST['madre'];
echo "$madre_id ";
$conyuge1 = $_POST['Conyuge1'];
echo "$conyuge1 ";
$fecha_boda_1 = $_POST['Fecha_Boda_1'];
echo "$fecha_boda_1 ";
$viveen = $_POST['Habita_en'];
echo "$viveen ";
$conyuge2 = $_POST['Conyuge2'];
echo "$conyuge2 ";
$fecha_boda_2 = $_POST['Fecha_Boda_2'];
echo "$fecha_boda_2 ";

// Carga de la foto

$target_dir = "Genealorico/fotos/";
$target_file = $target_dir . basename($_FILES["Foto"]["name"]);
move_uploaded_file($_FILES["Foto"]["name"], $target_file);


// Validar fechas de nac, def, boda1 y boda 2
//0000
if ( ($fecha_defuncion < $valida_fecha) AND ($fecha_nacimiento < $valida_fecha) AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)  ){
$sql = "UPDATE Personas SET Nombre = ?, Apellido_Paterno = ?, Apellido_Materno = ?, Fecha_de_Nacimiento = ?, Lugar_de_Nacimiento = ?, Fecha_de_Defunción = ?, Lugar_de_Defunción = ?, Foto = ?, Genero = ?, PadreID = ?, MadreID = ?, Habita_en = ? Conyuge1 = ?, Fecha_Boda_1, Conyuge2 = ?, Fecha_Boda_2 = ?  WHERE PersonaID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssiisisisi", $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $lugar_nacimiento, $fecha_defuncion, $lugar_defuncion, $foto, $genero, $padre_id, $madre_id, $viveen, $conyuge1, $fecha_boda_1, $conyuge2, $fecha_boda_2);
$stmt->execute(); 
//0001    
//}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
//$sql = "UPDATE Personas SET Nombre = ?, Apellido_Paterno = ?, Apellido_Materno = ?, Fecha_de_Nacimiento = ?, Lugar_de_Nacimiento = ?, Fecha_de_Defunción = ?, Lugar_de_Defunción = ?, Genero = ?, PadreID = ?, MadreID = ?, Conyuge1 = ?, Fecha_Boda_1, Conyuge2 = ?, Fecha_Boda_2 = ?  WHERE PersonaID = ?";
//$stmt = $conn->prepare($sql);
//$stmt->bind_param("ssssssssiiisisi", $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $lugar_nacimiento, $fecha_defuncion, $lugar_defuncion, $genero, $padre_id, $madre_id, $conyuge1, $fecha_boda_1, $conyuge2, $fecha_boda_2);
//$stmt->execute();   
  //1010    
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha) AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
    $sql = "UPDATE Personas SET Nombre = ? WHERE PersonaID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nombre, $personaID); // "s" para string, "i" para integer
    $stmt->execute();
    //$sql = "UPDATE Personas SET Nombre = ?, Apellido_Paterno = ?, Apellido_Materno = ?, Fecha_de_Nacimiento = ?, Lugar_de_Nacimiento = ?, Lugar_de_Defunción = ?, Genero = ?, PadreID = ?, MadreID = ?, Conyuge1 = ?, Fecha_Boda_1 = ?, Conyuge2 = ?  WHERE PersonaID = ?";
    //$stmt = $conn->prepare($sql);
    //$stmt->bind_param("sssssssiiisii", $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $lugar_nacimiento, $lugar_defuncion, $genero, $padre_id, $madre_id, $conyuge1, $fecha_boda_1, $conyuge2, $personaID);
    //$stmt->execute();  
    echo "$nombre ";
   
   //  $sql = "UPDATE Personas SET Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2, Fecha_Boda_2
   // VALUES ('$nombre', '$apellido_paterno', '$apellido_materno',  '$lugar_nacimiento',  '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1',  '$conyuge2', '$fecha_boda_2')";
//0010
//}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
  //  $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2)
  //  VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento','$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2')";
//0011
//}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
//     $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2, Fecha_Boda_2)
//     VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento','$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2', '$fecha_boda_2')";
//  //0100
// }else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
//     $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2)
//     VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
//  //0101
// }else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
//     $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_2, Conyuge2)
//     VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_2', '$conyuge2')";
// //0110
// }else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
//     $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno,  Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2)
//     VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento', '$fecha_de_defuncion','$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2')";
//  //0111
// }else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion | $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
//     $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Fecha_de_Defunción,Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2, Fecha_Boda_2)
//     VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento','$fecha_de_defuncion','$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2', '$fecha_boda_2')";
// //1000
// }else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha) AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha) ) {
//     $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2)
//     VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
// //1001
// }else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
// $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_2, Conyuge2)
// VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_2', '$conyuge2')";
// //1010
// }else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
// $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2)
// VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2')";
// //1011
// }else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
//     $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2, Fecha_Boda_2)
//     VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2', '$fecha_boda_2')";
// //1100
// }else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
// $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2)
// VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
// //1101
// }else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
//     $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2, Fecha_Boda_2)
//     VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2', '$fecha_boda_2')";
// //1110
// }else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
// $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2)
// VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2')";
 //1111
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "UPDATE Personas SET Nombre = ?, Apellido_Paterno = ?, Apellido_Materno = ?, Fecha_de_Nacimiento = ?, Lugar_de_Nacimiento = ?, Fecha_de_Defunción = ?, Lugar_de_Defunción = ?, Genero = ?, PadreID = ?, MadreID = ?, Conyuge1 = ?, Fecha_Boda_1, Conyuge2 = ?, Fecha_Boda_2 = ? = ? WHERE PersonaID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssiiisisi", $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $lugar_nacimiento, $fecha_defuncion, $lugar_defuncion, $genero, $padre_id, $madre_id, $conyuge1, $fecha_boda_1, $conyuge2, $fecha_boda_2, $personaID);
    $stmt->execute(); 
}
?>
 <h2>Páginas del proyecto</h2>
     
 <ul>
        <li>
            <a href="index.php">Página de Inicio</a>
             --     
            <a href="create.php">Crear nuevas personas</a>

        </li>
 </ul>
 <hr>  
 <?php
// Validar registro creado
echo "$nombre ";
if ($conn->query($sql) === TRUE) {
    echo "Registro Actualizado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>