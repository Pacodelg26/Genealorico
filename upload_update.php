<?php
include 'db.php';
$personaID = $_POST['PersonaID'];
echo "personaid $personaID <br>";
$nombre = $_POST['Nombre'];
echo "Nombre $nombre ";
$apellido_paterno = $_POST['Apellido_Paterno'];
echo "<br>Apellido P $apellido_paterno ";
$apellido_materno = $_POST['Apellido_Materno'];
echo "<br>Apellido M $apellido_materno ";
$valida_fecha = "0999/01/02";

$fecha_nacimiento = $_POST['Fecha_de_Nacimiento'];
echo "<br>Fecha N $fecha_nacimiento ";
$lugar_nacimiento = $_POST['Lugar_de_Nacimiento'];
echo "<br>Lugar N $lugar_nacimiento ";
$fecha_defuncion = $_POST['Fecha_de_Defunción'];
echo "<br>Fecha d $fecha_defuncion ";
$lugar_defuncion = $_POST['Lugar_de_Defunción'];
echo "<br>Lugar d $lugar_defuncion";
$foto = $_POST['Foto'];
echo "<br>Foto Anterior $foto";
$fotonueva =$_FILES["Foto"]["name"];
echo "<br>Foto Nueva $fotonueva";
$genero = $_POST['Genero'];
echo "<br>Genero $genero ";
$padre_id = $_POST['padre'];
echo "<br>Padreid $padre_id ";
$madre_id = $_POST['madre'];
echo "<br>Madreid $madre_id ";
$conyuge1 = $_POST['Conyuge1'];
echo "<br>Conyuge1 $conyuge1 ";
$fecha_boda_1 = $_POST['Fecha_Boda_1'];
echo "<br>Fecha Boda1 $fecha_boda_1 ";
$viveen = $_POST['Habita_en'];
echo "<br>Vive en $viveen ";
$conyuge2 = $_POST['Conyuge2'];
echo "<br>Conyuge2 $conyuge2 ";
$fecha_boda_2 = $_POST['Fecha_Boda_2'];
echo "<br>Fecha boda2 $fecha_boda_2 <br>";



 // Verificar si el archivo es una imagen real
//  $check = getimagesize($target_file);
//  if($check !== false) {
//      $uploadOk = 1;
//  } else {
//      echo "El archivo no es una imagen.";
//      $uploadOk = 0;
//  }

//  // Verificar si el archivo ya existe
//  if (file_exists($target_file)) {
//      echo "Lo siento, el archivo ya existe.";
//      $uploadOk = 0;
//  }

//  // Verificar el tamaño del archivo
// if ($fotonueva > 500000) {
//      echo "Lo siento, tu archivo es demasiado grande.";
//      $uploadOk = 0;
//  }

//  // Permitir ciertos formatos de archivo
//  //if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
//  //    echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
//  //    $uploadOk = 0;
//  //}

//  // Verificar si $uploadOk es 0 por un error
//  if ($uploadOk == 0) {
//      echo "Lo siento, tu archivo no fue subido.";
//  }
 // Si todo está bien, intentar subir el archivo

 //   if (move_uploaded_file($_FILES["Foto"]["name"], $target_file)) {
   //    echo "El archivo ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " ha sido subido.";
// Actualizar la foto actual
     //   rename($target_file, $target_dir . "foto_actual.jpg");
  //  } else {
  //    echo "Lo siento, hubo un error al subir tu archivo.";
   // }

//elige entre la foto antigua o la nueva en caso de que se haya cargado una nueva

if (!empty($_FILES['Foto']['name'])) {
    // Si se ha subido una nueva foto se sustituye
    $foto= 'Genealorico/fotos/' . $_FILES['Foto']['name']; 
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
// Carga de la foto

$target_dir = "Genealorico/fotos/";
$target_file = $target_dir . basename($_FILES["Foto"]["name"]);
if (move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file)){
 echo "el archivo ha sido subido exitosamente";

}else{
    if (empty($_FILES["Foto"]["name"])){
        echo "<br>No hay foto para actualizar";
    }else {
        echo "hubo un error al subir el archivo";
    }
}
//Ver datos que se van a cargar

echo "personaid $personaID <br>";
echo "Nombre $nombre ";
echo "<br>Apellido P $apellido_paterno ";
echo "<br>Apellido M $apellido_materno ";
echo "<br>Fecha N $fecha_nacimiento ";
echo "<br>Lugar N $lugar_nacimiento ";
echo "<br>Fecha d $fecha_defuncion ";
echo "<br>Lugar d $lugar_defuncion";
echo "<br>Foto a cargar $foto";
echo "<br>Foto Nueva $fotonueva";
echo "<br>Genero $genero ";
echo "<br>Padreid $padre_id ";
echo "<br>Madreid $madre_id ";
echo "<br>Conyuge1 $conyuge1 ";
echo "<br>Fecha Boda1 $fecha_boda_1 ";
echo "<br>Vive en $viveen ";
echo "<br>Conyuge2 $conyuge2 ";
echo "<br>Fecha boda2 $fecha_boda_2 <br>";



// Validar fechas de nac, def, boda1 y boda 2
//0000
if (($fecha_defuncion < $valida_fecha) AND ($fecha_nacimiento < $valida_fecha) AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Lugar_de_Nacimiento = '$lugar_nacimiento', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Conyuge2 = '$conyuge2'  WHERE PersonaID = '$personaID'";
echo "0000";
//0001    
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Lugar_de_Nacimiento = '$lugar_nacimiento', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_2 = '$fecha_boda_2', Conyuge2 = '$conyuge2'  WHERE PersonaID = '$personaID'";
echo "0001";
//0010
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno',  Lugar_de_Nacimiento = '$lugar_nacimiento', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_1 = '$fecha_boda_1', Conyuge2 = '$conyuge2'  WHERE PersonaID = '$personaID'";
echo "0010";
//0011
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno',  Lugar_de_Nacimiento = '$lugar_nacimiento', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_1 = '$fecha_boda_1', Conyuge2 = '$conyuge2', Fecha_Boda_2 = '$fecha_boda_2'  WHERE PersonaID = '$personaID'";
echo "0011";
//0100
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno',  Lugar_de_Nacimiento = '$lugar_nacimiento',Fecha_de_Defunción = '$fecha_defuncion', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Conyuge2 = '$conyuge2'  WHERE PersonaID = '$personaID'";
echo "0100";
//0101
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Defunción = '$fecha_defuncion', Lugar_de_Nacimiento = '$lugar_nacimiento', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_2 = '$fecha_boda_2', Conyuge2 = '$conyuge2'  WHERE PersonaID = '$personaID'";
echo "0101";
//0110
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Lugar_de_Nacimiento = '$lugar_nacimiento',Fecha_de_Defunción = '$fecha_defuncion', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_1 = '$fecha_boda_1', Conyuge2 = '$conyuge2' WHERE PersonaID = '$personaID'";
echo "0110";
//0111
}else if (($fecha_nacimiento < $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Lugar_de_Nacimiento = '$lugar_nacimiento',Fecha_de_Defunción = '$fecha_defuncion', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_1 = '$fecha_boda_1', Conyuge2 = '$conyuge2' ,Fecha_Boda_2 = '$fecha_boda_2' WHERE PersonaID = '$personaID'";
echo "0111";
//1000
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento',Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1',  Conyuge2 = '$conyuge2'  WHERE PersonaID = '$personaID'";
echo "1000";
//1001
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Conyuge2 = '$conyuge2' ,Fecha_Boda_2 = '$fecha_boda_2' WHERE PersonaID = '$personaID'";
echo "1001";
//1010    
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha) AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_1 = '$fecha_boda_1', Conyuge2 = '$conyuge2'  WHERE PersonaID = '$personaID'";
echo "1010";
//1011  
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_1 = '$fecha_boda_1', Conyuge2 = '$conyuge2' ,Fecha_Boda_2 = '$fecha_boda_2' WHERE PersonaID = '$personaID'";
echo "1011";
//1100   
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento',Fecha_de_Defunción = '$fecha_defuncion', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1',  Conyuge2 = '$conyuge2'  WHERE PersonaID = '$personaID'";
echo "1100";
//1101
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento',Fecha_de_Defunción = '$fecha_defuncion', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1',  Conyuge2 = '$conyuge2' ,Fecha_Boda_2 = '$fecha_boda_2' WHERE PersonaID = '$personaID'";
echo "1101";
//1110
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento',Fecha_de_Defunción = '$fecha_defuncion', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_1 = '$fecha_boda_1', Conyuge2 = '$conyuge2'  WHERE PersonaID = '$personaID'";
echo "1110";
//1111
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento',Fecha_de_Defunción = '$fecha_defuncion', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_1 = '$fecha_boda_1', Conyuge2 = '$conyuge2' ,Fecha_Boda_2 = '$fecha_boda_2' WHERE PersonaID = '$personaID'";
echo "1111";
}else {
    echo "Registro No Actualizado ";
}

// Cargar las personas editadas en los conyuges

//if (!empty($conyuge1)) 
//    $sql = "UPDATE Personas SET Conyuge1 = '$personaID'  WHERE PersonaID = '$conyuge1'";
// }else if (!empty($conyuge2)) {
//    $sql = "UPDATE Personas SET Conyuge2 = '$personaID'  WHERE PersonaID = '$conyuge2'";
//}

?>
 <h2>Páginas del proyecto</h2>
     
 <ul>
        <li>
            <a href="index.php">Página de Inicio</a>
             --     
            <a href="ver_personas.php?persona=<$php echo "$personaID"" >Crear nuevas personas</a>

        </li>
 </ul>
 <hr>  
 <?php
// Validar registro creado
// echo "($conn->query($sql) ";

if ($conn->query($sql) === TRUE) {
    echo "Registro Actualizado exitosamente";
   // header("Location: ver_personas.php?persona=$personaID");

} else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close(); 

?>
