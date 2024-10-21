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
$fotonueva =$_FILES["Foto"]["name"];
echo "$fotonueva ";
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

 // Verificar si el archivo es una imagen real
 $check = getimagesize($_FILES["Foto"]["name"]);
 if($check !== false) {
     $uploadOk = 1;
 } else {
     echo "El archivo no es una imagen.";
     $uploadOk = 0;
 }

 // Verificar si el archivo ya existe
 if (file_exists($target_file)) {
     echo "Lo siento, el archivo ya existe.";
     $uploadOk = 0;
 }

 // Verificar el tamaño del archivo
if ($_FILES["foto"]["size"] > 500000) {
     echo "Lo siento, tu archivo es demasiado grande.";
     $uploadOk = 0;
 }

 // Permitir ciertos formatos de archivo
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
     echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
     $uploadOk = 0;
 }

 // Verificar si $uploadOk es 0 por un error
 if ($uploadOk == 0) {
     echo "Lo siento, tu archivo no fue subido.";
 }
 // Si todo está bien, intentar subir el archivo
 else {
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
       echo "El archivo ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " ha sido subido.";
// Actualizar la foto actual
        rename($target_file, $target_dir . "foto_actual.jpg");
    } else {
      echo "Lo siento, hubo un error al subir tu archivo.";
    }
}


if (!empty($_FILES['Foto']['name'])) {
    // Si se ha subido una nueva foto
    $persona['Foto'] = 'Genealorico/fotos/' . $_FILES['Foto']['name']; // Aquí deberías mover el archivo subido a tu directorio deseado
    $foto=$persona['Foto'];
} else if (empty($persona['Foto'])) {
    // Si no hay foto y se basa en el género
    if ($persona['Genero'] == 'M') {
        $persona['Foto'] = 'Genealorico/fotos/hombre.jpg';
        $foto=$persona['Foto'];
    } elseif ($persona['Genero'] == 'F') {
        $persona['Foto'] = 'Genealorico/fotos/mujer.jpg';
        $foto=$persona['Foto'];
    } else {
        $persona['Foto'] = 'Genealorico/fotos/default.jpg'; // Opcional: un valor por defecto si el género no es M o F
        $foto=$persona['Foto'];
    }

   }

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
    $sql = "UPDATE Personas SET Nombre ='$nombre' WHERE PersonaID = '$personaID'";
   // $stmt = $conn->prepare($sql);
   // $stmt->bind_param("si", $nombre, $personaID); // "s" para string, "i" para integer
   // $stmt->execute();
    $sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', PadreID = '$padre_id', MadreID = '$madre_id', Conyuge1 = '$conyuge1', Fecha_Boda_1 = '$fecha_boda_1', Conyuge2 = '$conyuge2'  WHERE PersonaID = '$personaID'";
    //$stmt = $conn->prepare($sql);
    //$stmt->bind_param("sssssssiiisii", $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $lugar_nacimiento, $lugar_defuncion, $genero, $padre_id, $madre_id, $conyuge1, $fecha_boda_1, $conyuge2, $personaID);
    //$stmt->execute();  
    echo "$nombre ";

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