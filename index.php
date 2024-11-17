<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GenealoRico - Pagina Principal</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
</head>

<script>
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/service-worker.js')
      .then(registration => {
        console.log('Service Worker registrado con éxito:', registration);
      }).catch(error => {
        console.log('Registro del Service Worker fallido:', error);
      });
  });
}


</script>    
 
    <style>

 
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            width: 90%;
            margin: 0 auto;
            padding: 0;
            font-size: 35px;
        } 



        .contenedor {
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 700px;
            gap: 10px;
        }
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 30px;
            
        }
        .lista-contenedor {
            max-height: 275px; /* Aproximadamente 10 líneas */
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
            
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .img {
            width: 100%;
            max-width: 80px;
        }
        .desplegable, .desplegable2 {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .desplegable2 {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }
        .desplegable2:hover {
            background-color: #0056b3;
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
    <div class="contenedor">
        <img class="img" src="Genealorico/fotos/Rico.png" />
        <h1>GenealoRico</h1>
    </div>
    <hr>
    <div class="contenedor">
        <h2>Pagina web de la familia Rico Ibañez y sus parientes <br>
        Para empezar selecciona o <a href='crear_persona.php'>crea</a> una persona</h2>
    </div>   

</div >   
        
<div class="contenedorlista">  
  

<script>
        function buscarPersonas() {
            const input = document.getElementById('buscarInput').value.toLowerCase();
            const nombres = document.querySelectorAll('.nombre');

            nombres.forEach(nombre => {
                const texto = nombre.innerText.toLowerCase();
                if (texto.includes(input)) {
                    nombre.parentElement.style.display = 'block';
                } else {
                    nombre.parentElement.style.display = 'none';
                }
            });
        }
    </script>
</head>
<body> 
   
    <div class="contenedor">
       
        <input type="text" id="buscarInput" onkeyup="buscarPersonas()" placeholder="Buscar por nombre o apellido...">
    </div>
    <div class="contenedor"> 
        <div class="lista-contenedor">
            <ul id="listaPersonas">
                <?php
                require 'conexion.php';
                $conexion = new Conexion();
                $pdo = $conexion->pdo;
              
                $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas ORDER BY Nombre";
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch()) {
                    echo "<li><span class='nombre'><a href='ver_personas.php?persona=".$row['PersonaID']."'> " . $row['Nombre'] . " " . $row['Apellido_Paterno'] . " " . $row['Apellido_Materno'] . "</a></span> </li>";
                   
                }
                ?>
            </ul>
        </div>
    </div>

<div class="contenedor">

    <div class="contenedor-hijo">
        <h2>Próximos Aniversarios</h2> 
        <table> 
            <thead> 
                <tr> 
                    <th>Nombre</th> 
                 
                    <th>Aniversario</th> 
                </tr> 
            </thead> 
            <tbody> 
            <?php
 
               // Consulta SQL para lista de proximos aniversarios
          
            $sql = " SELECT Nombre, Apellido_Paterno, Apellido_Materno, 
            DATE_FORMAT(Fecha_de_Nacimiento, '%d-%m') 
            AS Dia_Mes_Aniversario, TIMESTAMPDIFF(YEAR, Fecha_de_Nacimiento, CURDATE()) + 1 
            AS Edad_Proxima 
            FROM Personas 
            WHERE DATE_FORMAT(Fecha_de_Nacimiento, '%m-%d') >= DATE_FORMAT(NOW(), '%m-%d') 
                OR DATE_FORMAT(Fecha_de_Nacimiento, '%m-%d') < DATE_FORMAT(NOW(), '%m-%d') 
            ORDER BY 
                CASE 
                    WHEN DATE_FORMAT(Fecha_de_Nacimiento, '%m-%d') >= DATE_FORMAT(NOW(), '%m-%d') 
                        THEN DATE_FORMAT(Fecha_de_Nacimiento, '%m-%d') 
                    ELSE '9999-12-31' END ASC,
            DATE_FORMAT(Fecha_de_Nacimiento, '%m-%d') LIMIT 5; ";

                 $stmtcumpleaños = $pdo->query($sql);
                 // mostrar cumpleaños
               
                 while ($row = $stmtcumpleaños->fetch()) {
                     echo "<tr>
                         <td>" .$row["Nombre"]." " .$row["Apellido_Paterno"]." " .$row["Apellido_Materno"]." </td>
   
                         <td>" .$row["Dia_Mes_Aniversario"]."</td>
                         </tr>";
                   
                 }
           
           
            
                ?>


        </table>       
    </div>
</div>
<a href=https://www.myheritage.es/site-family-tree-814452191/delgado-ricomallo-bajon>Ver Arbol my heritage</a>

</body>
<br><h1>








        <!-- <form action="ver_personas.php" method="GET">
            <label for="persona"></label>
            <select class="desplegable" name="persona" id="persona">
                <option value="">Seleccionar</option>
                <?php
                require 'conexion.php';
                $conexion = new Conexion();
                $pdo = $conexion->pdo;
                $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas ORDER BY Nombre" ;
                $stmt = $pdo->query($sql);
                while ($row = $stmt->fetch()) {
                    echo "<option value='" . $row["PersonaID"] . "'>" . $row["Nombre"] . " " . $row["Apellido_Paterno"] . " " . $row["Apellido_Materno"] . "</option>";
                }
                ?>
            </select>
            <input class="desplegable" type="submit" value="Ver Persona">
            
        </form>
        
        <button class="desplegable" onclick="location.href='crear_persona.php'">Crear Personas</button> -->
      
            
        </div>
</body>
</div>       
</body>
<script>   
const CACHE_NAME = 'mi-pwa-cache-v1';
const urlsToCache = [
  '/',
  '/index.php',
  '/styles.css',
 
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        if (response) {
          return response;  // La respuesta está en la caché
        }
        return fetch(event.request);  // La respuesta no está en la caché
      })
  );
});

</script>    
</html>

