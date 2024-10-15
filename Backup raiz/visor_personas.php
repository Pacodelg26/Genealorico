<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GenealoRico - Visor de Datos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>GenealoRico - Visor de Datos</h1>
    <h2>Paginas del proyecto</h2>
      <ul>
           <li>
           <a href="index.html">Página de Inicio</a>
                 --     
                <a href="visor_personas.php">Visor Personas</a>
                 --
                 <a href="editar_persona.php">Visor/editor de datos</a> 
                 --
                 <a href="visor_arbol.html">Vista de arbol</a>  
           </li>
    </ul>
    <hr>
    <!-- Selector de Personas -->
    <div id="selector-personas">
        <h2>Selector de Personas</h2>
        <select id="persona-select" onchange="cargarDatosPersona()" class="myOption" option >
            
            <!-- Opciones serán cargadas dinámicamente -->
       </select>
    </div>
    <hr>
     <div>
        <h2>Foto</h2>
        
        <img id="foto" width="200px" src="Foto"  />

    </div>
       <?php
// esto no funciona

  
// Crear la URL con el parámetro
 $url = "editar_persona.php?PersonaID = 40";
    ?>

    <td>
        <a href="<?php echo $url; ?>">
            <button>Editar datos de la Persona</button>
        </a>
    </td>
    <!-- Información de la Persona -->

    <div id="info-persona">
        <h2>Información de la Persona</h2>
            <p>PersonaID:<span id="foto"></span></p>
            <p>Nombre: <span id="nombre"></span></p>
            <p>Apellido Paterno: <span id="apellido_paterno"></span></p>
            <p>Apellido Materno: <span id="apellido_materno"></span></p>
            <p>Fecha de Nacimiento: <span id="fecha_nacimiento"></span></p>
            <p>Fecha de Defunción: <span id="fecha_defuncion"></span></p>
     
       
    </div>

    <!-- Padres -->
    <div id="padres">
        <h2>Padres</h2>
        <p>Padre: <span id="padre"></span></p>
        <p>Madre: <span id="madre"></span></p>
    </div>

    <!-- Hermanos -->
    <div id="hermanos">
        <h2>Hermanos</h2>
        <ul id="lista-hermanos"></ul>
    </div>

    <!-- Hijos -->
    <div id="hijos">
        <h2>Hijos</h2>
        <ul id="lista-hijos"></ul>
    </div>

    <!-- Parejas -->
    <div id="parejas">
        <h2>Parejas</h2>
        <ul id="lista-parejas"></ul>
    </div>

    <script src="scripts.js"></script>

</body>
</html>
