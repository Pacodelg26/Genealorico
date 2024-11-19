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

        h1,
        h2 {
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
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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
            height: 50px;
        }
    </style>

    <style>
        .tree {
            display: flex;
            flex-direction: column;
        }

        .tree *:before,
        .tree *:after {
            content: "";
            position: absolute;
        }

        .tree .card,
        .tree .couple,
        .tree .generation {
            position: relative;
        }

        .tree .generation {
            display: flex;
            margin-bottom: 20px;
        }

        .tree .generation .couple {
            display: flex;
        }

        .tree .generation:last-of-type {
            margin-bottom: 0;
        }

        .tree .card {
            margin: 10px;
            border: 2px solid #ccc;
            padding: 5px 10px;
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 11px;
            display: flex;
            border-radius: 5px;
            flex-direction: column;
            align-items: center;
            width: 100px;
        }

        .tree .couple:after {
            width: calc(50% - 2px);
            border: 2px solid #c6d1cb;
            border-top: 0;
            border-bottom-left-radius: 3px;
            border-bottom-right-radius: 3px;
            right: 0;
            left: 0;
            margin: auto;
            top: calc(100% + 20px / 2 - 3px);
            height: 3px;
        }

        .tree .card:before,
        .tree .card:after {
            right: 0;
            left: 0;
            width: 0;
            margin: auto;
            border-left: 2px solid #c6d1cb;
            height: calc(10px + 20px / 2);
        }

        .tree .card:before {
            bottom: 100%;
        }

        .tree .card:after {
            top: 100%;
        }

        .tree #grandParents .card:before,
        .tree .generation:last-of-type .card:after,
        .tree .brothers .card:not(:last-of-type):after {
            border: 0;
            opacity: 0;
        }

        #person {
            display: grid;
            width: 100%;
            grid-template-columns: 1fr 1fr;
            position: relative;
        }

        .husband::before {
            content: none;
        }

        .brothers {
            display: flex;
            justify-self: end;
            position: relative;
        }

        .tree .brothers:before {
            width: calc(100% - 146px);
            border: 2px solid #c6d1cb;
            border-bottom: 0;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            right: 0;
            left: 0;
            margin: auto;
            bottom: calc(100% + 20px / 2 - 5px);
            height: 3px;
        }

        .tree #childs::before {
            width: calc(100% - 146px);
            border: 2px solid #c6d1cb;
            border-bottom: 0;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            right: 0;
            left: 0;
            margin: auto;
            bottom: calc(100% + 20px / 2 - 5px);
            height: 3px;
        }
    </style>
</head>

<body>


    <?php

    require "clean-photo-url.php";
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
        $foto = $row['Foto'] ? $row['Foto'] : ($row['Genero'] == 'M' ? 'public/images/hombre.jpg' : 'public/images/mujer.jpg');
    }
    ?>
    <!-- Encabezado de la Página -->
    <h1>Visor de Árbol Familiar</h1>
    <hr>
    <nav class="menu">
        <ul class="menu-list">
            <li class="menu-item">
                <a href="index.php"><img src="public/images/home-02.png" title="Pagina Principal" alt="Icono 1">
                    <div class="hover-text">Ir a Inicio</div>
                </a>
            </li>
            <!-- <li class="menu-item" onclick="toggleMenu()">
                
                    <img src="public/images/añadir persona-02.png">
                 <div id="dropdown-menu" class="dropdown-menu" >
                    <a href="crear_hermano.php?persona=<?php echo $personaID; ?>&padre=<?php echo $row['PadreID']; ?>&madre=<?php echo $row['MadreID']; ?>&apellido_paterno=<?php echo $row['Apellido_Paterno']; ?>&apellido_materno=<?php echo $row['Apellido_Materno']; ?>">Crear Hermano/a</a>
                    <a href="crear_padre.php?persona=<?php echo $personaID; ?>&apellido_paterno=<?php echo $row['Apellido_Paterno']; ?>">Crear Padre</a>
                    <a href="crear_madre.php?persona=<?php echo $personaID; ?>&apellido_materno=<?php echo $row['Apellido_Materno']; ?>">Crear Madre</a>
                    <a href="crear_hijo.php?persona=<?php echo $personaID; ?>&apellido_paterno=<?php echo $row['Apellido_Paterno']; ?>&conyuge1=<?php echo $row['Conyuge1']; ?>">Crear Hijo/a</a>
                    <a href="crear_conyuge.php?persona=<?php echo $personaID; ?>">Crear Conyuge</a>
                </div>
            </li> -->
            <li class="menu-item">
                <a href="editar_person.php?persona=<?php echo $personaID; ?>"><img src="public/images/editar persona-02.png" title="editar esta persona" alt="Icono 3"></a>
            </li>
            <li class="menu-item">
                <a href="ver_personas.php?persona=<?php echo $personaID; ?>"><img src="public/images/ver persona-02.png" title="ver persona" alt="Ver Persona"></a>
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

            <div class="tree">
                <div class="generation" id="grandParents">
                    <div class="couple">
                        <?php if ($row['AbueloPaternoID']) { ?>
                            <a class="card" href='ver_arbol.php?persona=<?php echo $row['AbueloPaternoID'] ?>'><img src="<?php echo "/public/images/" . cleanPhotoUrl($row['AbueloPaternoFoto'], $pdo, $row['AbueloPaternoID']); ?>" alt="Abuelo Paterno" width='100' height='100'><br><?php echo " " . $row['AbueloPaternoNombre'] . " " . $row['AbueloPaternoAP'] . " "; ?></a>
                        <?php } ?>
                        <?php if ($row['AbuelaPaternaID']) { ?>
                            <a class="card" href='ver_arbol.php?persona=<?php echo $row['AbuelaPaternaID'] ?>'><img src="<?php echo "/public/images/" . cleanPhotoUrl($row['AbuelaPaternaFoto'], $pdo, $row['AbuelaPaternaID']); ?>" alt="Abuela Paterna" width='100' height='100'><br><?php echo " " . $row['AbuelaPaternaNombre'] . " " . $row['AbuelaPaternaAP'] . " "; ?></a>
                        <?php } ?>
                    </div>

                    <div class="couple">
                        <?php if ($row['AbueloMaternoID']) { ?>
                            <a class="card" href='ver_arbol.php?persona=<?php echo $row['AbueloMaternoID'] ?>'><img src="<?php echo "/public/images/" . cleanPhotoUrl($row['AbueloMaternoFoto'], $pdo, $row['AbueloMaternoID']); ?>" alt="Abuelo Materno" width='100' height='100'><br><?php echo " " . $row['AbueloMaternoNombre'] . " " . $row['AbueloMaternoAP'] . " "; ?></a>
                        <?php } ?>
                        <?php if ($row['AbuelaMaternaID']) { ?>
                            <a class="card" href='ver_arbol.php?persona=<?php echo $row['AbuelaMaternaID'] ?>'><img src="<?php echo "/public/images/" . cleanPhotoUrl($row['AbuelaMaternaFoto'], $pdo, $row['AbuelaMaternaID']); ?>" alt="Abuela Materna" width='100' height='100'><br><?php echo " " . $row['AbuelaMaternaNombre'] . " " . $row['AbuelaMaternaAP'] . " "; ?></a>
                        <?php } ?>
                    </div>
                </div>

                <div class="generation" id="parents">
                    <div class="couple">
                        <?php
                        if ($row['PadreID']) {
                            $sqlPadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PersonaID = ?";
                            $stmtPadre = $pdo->prepare($sqlPadre);
                            $stmtPadre->execute([$row['PadreID']]);
                            $padre = $stmtPadre->fetch();
                            echo "<a class='card' href='ver_arbol.php?persona=" . $row['PadreID'] . "'><img src='/public/images/" . cleanPhotoUrl($padre["Foto"], $pdo, $row['PadreID']) . "' alt='Padre' width='100' height='100'><br> " . $padre['Nombre'] . " " . $padre['Apellido_Paterno'] . "</a>";
                        }

                        if ($row['MadreID']) {
                            $sqlMadre = "SELECT Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PersonaID = ?";
                            $stmtMadre = $pdo->prepare($sqlMadre);
                            $stmtMadre->execute([$row['MadreID']]);
                            $madre = $stmtMadre->fetch();
                            echo "<a class='card' href='ver_arbol.php?persona=" . $row['MadreID'] . "'><img src='/public/images/" . cleanPhotoUrl($madre["Foto"], $pdo, $row['MadreID']) . "' alt='Madre' width='100' height='100'><br>" . $madre['Nombre'] . " " . $madre['Apellido_Paterno'] . " </a>";
                        }
                        ?>
                    </div>
                </div>

                <div class="generation" id="person">
                    <div class="brothers">

                        <?php
                        $sqlHermanos = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE (PadreID = ? OR MadreID = ?) AND PersonaID != ? AND (PadreID != 0 AND MadreID !=0)";
                        $stmtHermanos = $pdo->prepare($sqlHermanos);
                        $stmtHermanos->execute([$row['PadreID'], $row['MadreID'], $personaID]);
                        while ($hermano = $stmtHermanos->fetch()) {
                            echo "<a class='card' href='ver_arbol.php?persona=" . $hermano['PersonaID'] . "'><img src='/public/images/" . cleanPhotoUrl($hermano["Foto"], $pdo, $hermano["PersonaID"]) . "' alt='Hermano' width='100' height='100'><br>" . $hermano['Nombre'] . " " . $hermano['Apellido_Paterno'] . " " . $hermano['Apellido_Materno'] . "</a>";
                        }
                        ?>

                        <a class="card" href="#"><img src="/public/images/<?php echo cleanPhotoUrl($foto, $pdo, $personaID); ?>" alt="Persona" width="100" height="100"><br><?php echo $row['PersonaNombre'] . " " . $row['PersonaApellidoPaterno'] . " " . $row['PersonaApellidoMaterno']; ?></a>
                    </div>

                    <?php
                    if ($row['PersonaConyuge1']) {
                        $sqlConyuge1 = "SELECT Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PersonaID = ?";
                        $stmtConyuge1 = $pdo->prepare($sqlConyuge1);
                        $stmtConyuge1->execute([$row['PersonaConyuge1']]);
                        $conyuge1 = $stmtConyuge1->fetch();
                        echo "<a class='card husband' href='ver_arbol.php?persona=" . $row['PersonaConyuge1'] . "'><img src='/public/images/" . cleanPhotoUrl($conyuge1["Foto"], $pdo, $row['PersonaConyuge1']) . "' alt='Conyuge' width='100' height='100'><br>" . $conyuge1['Nombre'] . " " . $conyuge1['Apellido_Paterno'] . " " . $conyuge1['Apellido_Materno'] . "</a>";
                    }
                    if ($row['PersonaConyuge2']) {
                        $sqlConyuge2 = "SELECT Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PersonaID = ?";
                        $stmtConyuge2 = $pdo->prepare($sqlConyuge2);
                        $stmtConyuge2->execute([$row['PersonaConyuge2']]);
                        $conyuge2 = $stmtConyuge2->fetch();
                        echo "<a class='card husband' href='ver_arbol.php?persona=" . $row['PersonaConyuge2'] . "'><img src='/public/images/" . cleanPhotoUrl($conyuge2["Foto"], $pdo, $row['PersonaConyuge2']) . "' alt='Conyuge' width='100' height='100'><br>" . $conyuge2['Nombre'] . " " . $conyuge2['Apellido_Paterno'] . " " . $conyuge2['Apellido_Materno'] . "</a>";
                    }
                    ?>
                </div>

                <?php
                $sqlHijos = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno, Foto FROM Personas WHERE PadreID = ? OR MadreID = ?";
                $stmtHijos = $pdo->prepare($sqlHijos);
                $stmtHijos->execute([$personaID, $personaID]);
                $childs = $stmtHijos->fetchAll();

                if (count($childs) > 0) {
                ?>
                    <div class="generation" id="childs">
                        <?php
                        foreach ($childs as $hijo) {
                        ?>
                            <a class="card" href='ver_arbol.php?persona=<?php echo $hijo['PersonaID'] ?>'><img src="<?php echo "/public/images/" . cleanPhotoUrl($hijo['Foto'], $pdo, $hijo['PersonaID']); ?>" alt="Hijo" width='100' height='100'><br><?php echo $hijo['Nombre'] . " " . $hijo['Apellido_Paterno'] . " " . $hijo['Apellido_Materno'] . " "; ?></a>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
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