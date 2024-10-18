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


// Validar fechas de nac, def, boda1 y boda 2
//0000
if ( ($fecha_defuncion < $valida_fecha) AND ($fecha_nacimiento < $valida_fecha) AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)  ){
$sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2)
VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
//0001    
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2, Fecha_Boda_2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno',  '$lugar_nacimiento',  '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1',  '$conyuge2', '$fecha_boda_2')";
//0010
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento','$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2')";
//0011
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2, Fecha_Boda_2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento','$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2', '$fecha_boda_2')";
 //0100
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
 //0101
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_2, Conyuge2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_2', '$conyuge2')";
//0110
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno,  Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento', '$fecha_de_defuncion','$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2')";
 //0111
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion | $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Fecha_de_Defunción,Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2, Fecha_Boda_2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento','$fecha_de_defuncion','$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2', '$fecha_boda_2')";
//1000
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha) AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha) ) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
//1001
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
$sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_2, Conyuge2)
VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_2', '$conyuge2')";
//1010
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2)
VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2')";
//1011
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2, Fecha_Boda_2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2', '$fecha_boda_2')";
//1100
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2)
VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
//1101
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2, Fecha_Boda_2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2', '$fecha_boda_2')";
//1110
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_Boda_1, Conyuge2)
VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2')";
//1111
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
    $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Fecha_boda_1, Conyuge2, Fecha_Boda_2)
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$fecha_boda_1', '$conyuge2', '$fecha_boda_2')";
 }


// Validar registro creado
if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro creado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
