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
                <li class="menu-item">
                    <a href="ver_personas.php?persona=<?php echo $_POST['PersonaID']; ?>"><img src="Genealorico/fotos/volver-02.png" title="Volver" alt="Ver Persona"></a>
                </li>
            </ul>
            </nav>
    
         <hr>   

<?php
include 'db.php';
$personaID = $_POST['PersonaID'];
$nombre = $_POST['Nombre'];
$apellido_paterno = $_POST['Apellido_Paterno'];
$apellido_materno = $_POST['Apellido_Materno'];
$valida_fecha = "0999/01/02";
$fecha_nacimiento = $_POST['Fecha_de_Nacimiento'];
$lugar_nacimiento = $_POST['Lugar_de_Nacimiento'];
$fecha_defuncion = $_POST['Fecha_de_Defunción'];
$lugar_defuncion = $_POST['Lugar_de_Defunción'];
$foto = $_POST['Foto'];
$fotonueva =$_FILES["Foto"]["name"];
$genero = $_POST['Genero'];
$padre_id = $_POST['PadreID'];
$madre_id = $_POST['MadreID'];
$conyuge1 = $_POST['Conyuge1'];
$fecha_boda_1 = $_POST['Fecha_Boda_1'];
$viveen = $_POST['Habita_en'];
$conyuge2 = $_POST['Conyuge2'];
$fecha_boda_2 = $_POST['Fecha_Boda_2'];




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

  // Verificar el tamaño del archivo
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
        echo "<br>$foto";
    } 
}
// Carga de la foto

$target_dir = "Genealorico/fotos/";
$target_file = $target_dir . basename($_FILES["Foto"]["name"]);
if (move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file)){
 echo "<br>la foto ha sido subido exitosamente";

}else{
    if (empty($_FILES["Foto"]["name"])){
        //echo "No hay foto para actualizar<br>";
    }else {
        //echo "hubo un error al subir el archivo<br>";
    }
}
//Ver datos que se van a cargar

// echo "personaid $personaID <br>";
// echo "Nombre $nombre ";
// echo "<br>Apellido P $apellido_paterno ";
// echo "<br>Apellido M $apellido_materno ";
// echo "<br>Fecha N $fecha_nacimiento ";
// echo "<br>Lugar N $lugar_nacimiento ";
// echo "<br>Fecha d $fecha_defuncion ";
// echo "<br>Lugar d $lugar_defuncion";
// echo "<br>Foto a cargar $foto";
// echo "<br>Foto Nueva $fotonueva";
// echo "<br>Genero $genero ";
 //echo "<br>Padreid $padre_id ";
 //echo "<br>Madreid $madre_id ";
// echo "<br>Conyuge1 $conyuge1 ";
// echo "<br>Fecha Boda1 $fecha_boda_1 ";
// echo "<br>Vive en $viveen ";
// echo "<br>Conyuge2 $conyuge2 ";
// echo "<br>Fecha boda2 $fecha_boda_2 <br>";


//echo "<br>El esquema de carga es:";
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
echo " 1001";
//1010    
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha) AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_1 = '$fecha_boda_1', Conyuge2 = '$conyuge2'  WHERE PersonaID = '$personaID'";
echo " 1010";
//1011  
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion < $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_1 = '$fecha_boda_1', Conyuge2 = '$conyuge2' ,Fecha_Boda_2 = '$fecha_boda_2' WHERE PersonaID = '$personaID'";
echo " 1011";
//1100   
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento',Fecha_de_Defunción = '$fecha_defuncion', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1',  Conyuge2 = '$conyuge2'  WHERE PersonaID = '$personaID'";
echo " 1100";
//1101
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 < $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento',Fecha_de_Defunción = '$fecha_defuncion', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1',  Conyuge2 = '$conyuge2' ,Fecha_Boda_2 = '$fecha_boda_2' WHERE PersonaID = '$personaID'";
echo " 1101";
//1110
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 < $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento',Fecha_de_Defunción = '$fecha_defuncion', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_1 = '$fecha_boda_1', Conyuge2 = '$conyuge2'  WHERE PersonaID = '$personaID'";
echo " 1110";
//1111
}else if (($fecha_nacimiento > $valida_fecha) AND  ($fecha_defuncion > $valida_fecha)AND ($fecha_boda_1 > $valida_fecha) AND ($fecha_boda_2 > $valida_fecha)) {
$sql = "UPDATE Personas SET Nombre = '$nombre', Apellido_Paterno = '$apellido_paterno', Apellido_Materno = '$apellido_materno', Fecha_de_Nacimiento = '$fecha_nacimiento', Lugar_de_Nacimiento = '$lugar_nacimiento',Fecha_de_Defunción = '$fecha_defuncion', Lugar_de_Defunción = '$lugar_defuncion', Genero ='$genero', Habita_en = '$viveen', PadreID = '$padre_id', MadreID = '$madre_id', Foto = '$foto', Conyuge1 = '$conyuge1', Fecha_Boda_1 = '$fecha_boda_1', Conyuge2 = '$conyuge2' ,Fecha_Boda_2 = '$fecha_boda_2' WHERE PersonaID = '$personaID'";
echo " 1111";
}else {
    echo "<br>Registro No Actualizado ";
}

// Validar registro creado


if ($conn->query($sql) === TRUE) {
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
         document.getElementById('message').innerText = 'Registro actualizado'; 
         // Redirigir a la página PHP después de un intervalo 
         setTimeout(function() { window.location.href = 'ver_personas.php?persona=<?php echo $personaID ?>'; }, 3000); 
         // Retraso de 5 segundos 
         }, 3000); 
         // Retraso inicial de 5 segundos 
         } 
</script>

<?php






$conn->close(); 

?>
