<?php
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
$valida_fecha = "0999/01/02";
// Obtener los datos del formulario
$personaID = $_POST['PersonaID'];
$nombre = $_POST['Nombre'];
$apellido_paterno = $_POST['Apellido_Paterno'];
$apellido_materno = $_POST['Apellido_Materno'];
$fecha_de_nacimiento = $_POST['Fecha_de_Nacimiento'];
$lugar_de_nacimiento = $_POST['Lugar_de_Nacimiento'];
$fecha_de_defuncion = $_POST['Fecha_de_Defunción'];
$lugar_de_defuncion = $_POST['Lugar_de_Defunción'];
// $foto = $_POST['Foto'];

// // Cargar la nueva foto al servidor

// $target_dir = "Genealorico/fotos/";
// $target_file = $target_dir . basename($_FILES["foto"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// // Verificar si el archivo es una imagen real
// $check = getimagesize($_FILES["foto"]["tmp_name"]);
// if($check !== false) {
//     $uploadOk = 1;
// } else {
//     echo "El archivo no es una imagen.";
//     $uploadOk = 0;
// }

// // Verificar si el archivo ya existe
// if (file_exists($target_file)) {
//     echo "Lo siento, el archivo ya existe.";
//     $uploadOk = 0;
// }

// // Verificar el tamaño del archivo
// if ($_FILES["foto"]["size"] > 500000) {
//     echo "Lo siento, tu archivo es demasiado grande.";
//     $uploadOk = 0;
// }

// // Permitir ciertos formatos de archivo
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
//     echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
//     $uploadOk = 0;
// }

// // Verificar si $uploadOk es 0 por un error
// if ($uploadOk == 0) {
//     echo "Lo siento, tu archivo no fue subido.";
// }
// // Si todo está bien, intentar subir el archivo
// //} else {
// //    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
// //        echo "El archivo ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " ha sido subido.";
//         // Actualizar la foto actual
// //        rename($target_file, $target_dir . "foto_actual.jpg");
// //    } else {
// //        echo "Lo siento, hubo un error al subir tu archivo.";
// //    }
// //}

// if ( ($fecha_defuncion = NULL) AND ($fecha_nacimiento = NULL)){
//     $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2)
//     VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$lugar_nacimiento', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
//     }else if (($fecha_nacimiento != NULL) AND  ($fecha_defuncion = NULL)) {
//     $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, , Fecha de Nacimiento, Lugar_de_Nacimiento, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2)
//     VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', $lugar_nacimiento', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
//     }else {
//     $sql = "INSERT INTO Personas (Nombre, Apellido_Paterno, Apellido_Materno, Fecha_de_Nacimiento, Lugar_de_Nacimiento, Fecha_de_Defunción, Lugar_de_Defunción, Foto, Genero, PadreID, MadreID, Conyuge1, Conyuge2)
//     VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nacimiento', '$lugar_nacimiento', '$fecha_defuncion', '$lugar_defuncion', '$target_file', '$genero', '$padre_id', '$madre_id', '$conyuge1', '$conyuge2')";
//     }

// Actualizar los datos en la base de datos

if ( ($fecha_defuncion < $valida_fecha) AND ($fecha_nacimiento < $valida_fecha)){
$sql = "UPDATE Personas SET Nombre = ?, Apellido_Paterno = ?, Apellido_Materno = ?, Lugar_de_Nacimiento = ?, Lugar_de_Defunción = ? WHERE PersonaID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $nombre, $apellido_paterno, $apellido_materno, $lugar_de_nacimiento, $lugar_de_defuncion, $personaID);
$stmt->execute();
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha )) {
    $sql = "UPDATE Personas SET Nombre = ?, Apellido_Paterno = ?, Apellido_Materno = ?, Fecha_de_Nacimiento = ?, Lugar_de_Nacimiento = ?, Lugar_de_Defunción = ? WHERE PersonaID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nombre, $apellido_paterno, $apellido_materno, $fecha_de_nacimiento, $lugar_de_nacimiento, $lugar_de_defuncion, $personaID);
    $stmt->execute();
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)) {
    $sql = "UPDATE Personas SET Nombre = ?, Apellido_Paterno = ?, Apellido_Materno = ?, Lugar_de_Nacimiento = ?, Fecha_de_Defunción = ?, Lugar_de_Defunción = ? WHERE PersonaID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nombre, $apellido_paterno, $apellido_materno, $lugar_de_nacimiento, $fecha_de_defuncion, $lugar_de_defuncion, $personaID);
    $stmt->execute();
}else {
    $sql = "UPDATE Personas SET Nombre = ?, Apellido_Paterno = ?, Apellido_Materno = ?, Fecha_de_Nacimiento = ?, Lugar_de_Nacimiento = ?, Fecha_de_Defunción = ?, Lugar_de_Defunción = ? WHERE PersonaID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $nombre, $apellido_paterno, $apellido_materno, $fecha_de_nacimiento, $lugar_de_nacimiento, $fecha_de_defuncion, $lugar_de_defuncion, $personaID);
    $stmt->execute(); 
}

// Redirigir a la página de lista de personas
header("Location: ver_personas.php?persona=$personaID");
