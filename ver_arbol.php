<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <title>Visor de Árbol Familiar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
            font: bold;
            align-content: center;
        }
        h1, h2 {
            color: #333;
        }
        .contenedor {
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 400px;
        }
        .contenedorlista {
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 400px;
            font: bold;
        }
        .img {
            width: 100%;
            max-width: 300px;
            margin: 20px auto;
        }

        /* a {
            text-decoration: none;
            color: #007BFF;
        } */
        a:hover {
            text-decoration: underline;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 10px;
        }
        @media screen and (max-width: 768px) {
            .contenedor {
                width: 90%;
            }
            .img {
                max-width: 100%;
            }
        }
        h1 {
            color: #333;
        }
        .tree {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .tree ul {
            padding-top: 20px; 
            position: relative;
            transition: all 0.5s;
        }
        .tree li {
            float: left; 
            text-align: center; 
            list-style-type: none;
            position: relative; 
            padding: 20px 5px 0 5px;
            transition: all 0.5s;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .tree li::before, .tree li::after {
            content: '';
            position: absolute; 
            top: 0; 
            right: 50%; 
            border-top: 2px solid #ccc;
            width: 50%; 
            height: 20px; 
        }
        .tree li::after {
            right: auto; 
            left: 50%; 
            border-left: 2px solid #ccc;
        }
        .tree li:only-child::after, .tree li:only-child::before {
            display: none;
        }
        .tree li:only-child { 
            padding-top: 0;
        }
        .tree li:first-child::before, .tree li:last-child::after {
            border: 0 none;
        }
        .tree li:last-child::before {
            border-right: 2px solid #ccc;
        }
        .tree li:first-child::after {
            border-left: 2px solid #ccc;
        }
        .tree ul ul::before {
            content: '';
            position: absolute; 
            top: 0; 
            left: 50%; 
            border-left: 2px solid #ccc;
            width: 0; 
            height: 20px;
        }
        .tree li a {
            border: 2px solid #ccc;
            padding: 5px 10px;
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma, bold;
            font-size: 20px;
            
            display: inline-block; 
            border-radius: 15px;
            transition: all 0.5s;
            align-items: center;
        }
        .tree li a:hover, .tree li a:hover+ul li a {
            background: #c8e4f8; 
            color: #000; 
            border: 2px solid #94a0b4;
        }
        .tree li a:hover+ul li::after, 
        .tree li a:hover+ul li::before, 
        .tree li a:hover+ul::before, 
        .tree li a:hover+ul ul::before {
            border-color:  #94a0b4;
        }
        
        .menu-icon {
            font-size: 30px;
            cursor: pointer;
            padding: 10px;
            background-color: #333;
            color: #fff;
            display: inline-block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-menu a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 35px;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
        .img {
            width: 50px;
            height:50px;
        }
    </style>
</head>
<body>


    <?php
    // Recibir persona de la URL y seleccionar su foto si no la hay en función del género
    if (isset($_GET['persona'])) {
        $personaID = $_GET['persona'];
        require 'conexion.php';
        $conexion = new Conexion();
        $pdo = $conexion->pdo;

        $sql = "SELECT * FROM Personas WHERE PersonaID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$personaID]);
        $row = $stmt->fetch();
    }
        if ($row) {
            $foto = $row['Foto'] ? $row['Foto'] : ($row['Genero'] == 'M' ? 'Genealorico/fotos/hombre.jpg' : 'Genealorico/fotos/mujer.jpg');
        }
    ?>
 <!-- Encabezado de la Página -->
<h1>Visor de Árbol Familiar</h1>
    <hr>
      <nav class="menu">
        <ul class="menu-list">
            <li class="menu-item">
                <a href="index.php"><img src="Genealorico/fotos/home-02.png" title="Pagina Principal" alt="Icono 1"><div class="hover-text">Ir a Inicio</div></a>
            </li>
            <!-- <li class="menu-item" onclick="toggleMenu()">
                
                    <img src="Genealorico/fotos/añadir persona-02.png">
                 <div id="dropdown-menu" class="dropdown-menu" >
                    <a href="crear_hermano.php?persona=<?php echo $personaID; ?>&padre=<?php echo $row['PadreID']; ?>&madre=<?php echo $row['MadreID']; ?>&apellido_paterno=<?php echo $row['Apellido_Paterno']; ?>&apellido_materno=<?php echo $row['Apellido_Materno']; ?>">Crear Hermano/a</a>
                    <a href="crear_padre.php?persona=<?php echo $personaID; ?>&apellido_paterno=<?php echo $row['Apellido_Paterno']; ?>">Crear Padre</a>
                    <a href="crear_madre.php?persona=<?php echo $personaID; ?>&apellido_materno=<?php echo $row['Apellido_Materno']; ?>">Crear Madre</a>
                    <a href="crear_hijo.php?persona=<?php echo $personaID; ?>&apellido_paterno=<?php echo $row['Apellido_Paterno']; ?>&conyuge1=<?php echo $row['Conyuge1']; ?>">Crear Hijo/a</a>
                    <a href="crear_conyuge.php?persona=<?php echo $personaID; ?>">Crear Conyuge</a>
                </div>
            </li> -->
            <li class="menu-item">
                <a href="editar_person.php?persona=<?php echo $personaID; ?>"><img src="Genealorico/fotos/editar persona-02.png" title="editar esta persona" alt="Icono 3"></a>
            </li>
            <li class="menu-item">
                <a href="ver_personas.php?persona=<?php echo $personaID; ?>"><img src="Genealorico/fotos/ver persona-02.png" title="ver persona" alt="Ver Persona"></a>
            </li>
        </ul>
        </nav>
     <script src="script.js">
    </script>
     <hr>    



  

                    <?php 
 

 if (isset($_GET['persona'])) {
     $personaID = $_GET['persona'];
     
     $sql = "SELECT 
                 P.PersonaID, P.Nombre AS PersonaNombre, P.Foto AS PersonaFoto, P.Apellido_Paterno AS PersonaApellidoPaterno, P.Apellido_Materno AS PersonaApellidoMaterno, 
                 P.Conyuge1 AS PersonaConyuge1, P.Conyuge2 AS PersonaConyuge2,
                 Padre.PersonaID AS PadreID, Padre.Nombre AS PadreNombre, Padre.Foto AS PadreFoto, 
                 Madre.PersonaID AS MadreID, Madre.Nombre AS MadreNombre, Madre.Foto AS MadreFoto, 
                 AbueloP.PersonaID AS AbueloPaternoID, AbueloP.Nombre AS AbueloPaternoNombre, AbueloP.Foto AS AbueloPaternoFoto, AbueloP.Apellido_Paterno AS AbueloPaternoAP,
                 AbuelaP.PersonaID AS AbuelaPaternaID, AbuelaP.Nombre AS AbuelaPaternaNombre, AbuelaP.Foto AS AbuelaPaternaFoto, AbuelaP.Apellido_Paterno AS AbuelaPaternaAP,
                 AbueloM.PersonaID AS AbueloMaternoID, AbueloM.Nombre AS AbueloMaternoNombre, AbueloM.Foto AS AbueloMaternoFoto, AbueloM.Apellido_Paterno AS AbueloMaternoAP,
                 AbuelaM.PersonaID AS AbuelaMaternaID, AbuelaM.Nombre AS AbuelaMaternaNombre, AbuelaM.Foto AS AbuelaMaternaFoto, AbuelaM.Apellido_Paterno AS AbuelaMaternaAP
             FROM 
                 Personas P
             LEFT JOIN 
                 Personas Padre ON P.PadreID = Padre.PersonaID
             LEFT JOIN 
                 Personas Madre ON P.MadreID = Madre.PersonaID
             LEFT JOIN 
                 Personas AbueloP ON Padre.PadreID = AbueloP.PersonaID
             LEFT JOIN 
                 Personas AbuelaP ON Padre.MadreID = AbuelaP.PersonaID
             LEFT JOIN 
                 Personas AbueloM ON Madre.PadreID = AbueloM.PersonaID
             LEFT JOIN 
                 Personas AbuelaM ON Madre.MadreID = AbuelaM.PersonaID
             WHERE 
                 P.PersonaID = ?";
 require 'db.php';           
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("i", $personaID);
 $stmt->execute();
 $result = $stmt->get_result();
 $row = $result->fetch_assoc();

 if ($row) {
     ?>

  <!-- Abuelos -->     
<div class="tree">
<ul>
     <li>
        <div class="horizontal">

   
             <ul>
                <li>
                    <div class="horizontal">
                        <?php if ($row['AbueloPaternoID']) { ?>
                        <a href='ver_arbol.php?persona=<?php echo $row['AbueloPaternoID'] ?>'><img src="<?php echo $row['AbueloPaternoFoto']; ?>" alt="Abuelo Paterno" width='160' height='160'><br><?php echo " " . $row['AbueloPaternoNombre'] . " " . $row['AbueloPaternoAP'] . " "; ?></a>
                        <?php } ?>
                        <?php if ($row['AbuelaPaternaID']) { ?>
                        <a href='ver_arbol.php?persona=<?php echo $row['AbuelaPaternaID'] ?>'><img src="<?php echo $row['AbuelaPaternaFoto']; ?>" alt="Abuela Paterna" width='160' height='160'><br><?php echo " " . $row['AbuelaPaternaNombre'] . " " . $row['AbuelaPaternaAP'] . " "; ?></a>
                        <?php } ?>
                        <?php if ($row['AbueloMaternoID']) { ?>
                        <a href='ver_arbol.php?persona=<?php echo $row['AbueloMaternoID'] ?>'><img src="<?php echo $row['AbueloMaternoFoto']; ?>" alt="Abuelo Materno" width='160' height='160'><br><?php echo " " . $row['AbueloMaternoNombre'] . " " . $row['AbueloMaternoAP'] . " "; ?></a>
                        <?php } ?>
                        <?php if ($row['AbuelaMaternaID']) { ?>
                        <a href='ver_arbol.php?persona=<?php echo $row['AbuelaMaternaID'] ?>'><img src="<?php echo $row['AbuelaMaternaFoto']; ?>" alt="Abuela Materna" width='160' height='160'><br><?php echo " " . $row['AbuelaMaternaNombre'] . " " . $row['AbuelaMaternaAP'] . " "; ?></a>
                        <?php } ?>
                    </div>
         

        </div>   

 <!-- Presentar a los padres -->
        <ul>
            <li>
                <div class="horizontal">
                    <?php 
                    if ($row['PadreID']) { 
                        $sqlPadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PersonaID = ?";
                        $stmtPadre = $pdo->prepare($sqlPadre);
                        $stmtPadre->execute([$row['PadreID']]);
                        $padre = $stmtPadre->fetch();
                            echo "<a href='ver_arbol.php?persona=".$row['PadreID']."'><img src='/$padre[Foto]' alt='Padre' width='160' height='160'><br> " . $padre['Nombre'] . " " . $padre['Apellido_Paterno'] . "</a>";
                        }

                    if ($row['MadreID']) { 
                        $sqlMadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PersonaID = ?";
                        $stmtMadre = $pdo->prepare($sqlMadre);
                        $stmtMadre->execute([$row['MadreID']]);
                        $madre = $stmtMadre->fetch();
                            echo "<a href='ver_arbol.php?persona=".$row['MadreID']."'><img src='/$madre[Foto]' alt='Madre' width='160' height='160'><br>" . $madre['Nombre'] . " " . $madre['Apellido_Paterno'] . " </a>";
                        } 
                    ?>
                </div>   
<!-- Presentar a la persona -->
        <ul>
            <li>
                <a class="centrar-persona" href="#"><img src="/<?php echo $foto; ?>" alt="Persona" width="160" height="160"><br><?php echo  $row['PersonaNombre'] . " " . $row['PersonaApellidoPaterno'] . " " . $row['PersonaApellidoMaterno']; ?> </a>
      
                                          
                 <!-- Mostrar Hijos -->
                 <ul> 
                    <?php
                    $sqlHijos = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PadreID = ? OR MadreID = ?";
                    $stmtHijos = $pdo->prepare($sqlHijos);
                    $stmtHijos->execute([$personaID, $personaID]);
                    while ($hijo = $stmtHijos->fetch()) {
                        echo "<li><a href='ver_arbol.php?persona=".$hijo['PersonaID']."'><img src='/$hijo[Foto]' alt='Hijo' width='160' height='160'><br>" . $hijo['Nombre'] . " " . $hijo['Apellido_Paterno'] . " " . $hijo['Apellido_Materno'] . "</a></li>";
                    }
                    ?>
                </ul>
            </li>
        </ul>
             
  
            <!-- </div> -->


      <!-- Mostrar Conyuges -->
       Conyuges
   <div class="tree">
    <ul> 
        <?php        
        
            if ($row['PersonaConyuge1']) {
            $sqlConyuge1 = "SELECT Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PersonaID = ?";
            $stmtConyuge1 = $pdo->prepare($sqlConyuge1);
            $stmtConyuge1->execute([$row['PersonaConyuge1']]);
            $conyuge1 = $stmtConyuge1->fetch();
            echo "<li><a href='ver_arbol.php?persona=".$row['PersonaConyuge1']."'><img src='/$conyuge1[Foto]' alt='Conyuge' width='160' height='160'><br>" . $conyuge1['Nombre'] . " " . $conyuge1['Apellido_Paterno'] . " " . $conyuge1['Apellido_Materno'] . "</a></li>";
            }
            if ($row['PersonaConyuge2']) { 
            $sqlConyuge2 = "SELECT Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PersonaID = ?";
            $stmtConyuge2 = $pdo->prepare($sqlConyuge2);
            $stmtConyuge2->execute([$row['PersonaConyuge2']]);
            $conyuge2 = $stmtConyuge2->fetch();
            echo "<li><a href='ver_arbol.php?persona=".$row['PersonaConyuge2']."'><img src='/$conyuge2[Foto]' alt='Conyuge' width='160' height='160'><br>" . $conyuge2['Nombre'] . " " . $conyuge2['Apellido_Paterno'] . " " . $conyuge2['Apellido_Materno'] . "</a></li>";
            }
        ?>
    </div>
    </ul> 

  <!-- Fin Mostrar Conyuges -->
   
    <!--  Mostrar Hermanos --> 
    Hermanos
    <div class="tree">
    <ul>
        
          <div class="horizontal">  
             <?php

         
            $sqlHermanos = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE (PadreID = ? OR MadreID = ?) AND PersonaID != ? AND (PadreID != 0 AND MadreID !=0)";
            $stmtHermanos = $pdo->prepare($sqlHermanos);
            $stmtHermanos->execute([$row['PadreID'], $row['MadreID'], $personaID]);
            while ($hermano = $stmtHermanos->fetch()) {
            echo "<li><a href='ver_arbol.php?persona=".$hermano['PersonaID']."'><img src='/$hermano[Foto]' alt='Hermano' width='160' height='160'><br>" . $hermano['Nombre'] . " " . $hermano['Apellido_Paterno'] . " " . $hermano['Apellido_Materno'] . "</a></li>";   
            }
?>
</div>
       
        </ul>
    <?php                                                    
        } else {
            echo "No se encontraron datos.";
        }
    } else {
        echo "No se ha seleccionado ninguna persona.";
    }
    ?>
</body>
</html>
