<?php
require 'load-env.php';
?>

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

    }



    .contenedor {
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        max-width: 600px;
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
        max-height: 300px;
        /* Aproximadamente 10 líneas */
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
        max-width: 300px;
    }

    .desplegable,
    .desplegable2 {
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

    }
</style>

<body>

    <h1>GenealoRico Página Principal</h1>
    <hr>
    <div class="contenedor">
        <h2>Pagina web de la familia Rico Ibañez y sus parientes</h2>
    </div>
    <div class="contenedor">
        <img class="img" src="public/images/Rico.png" />
    </div>
    <h1>Para empezar selecciona una persona</h1>
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
                            echo "<li><span class='nombre'><a href='ver_personas.php?persona=" . $row['PersonaID'] . "'> " . $row['Nombre'] . " " . $row['Apellido_Paterno'] . " " . $row['Apellido_Materno'] . "</a></span> </li>";
                            //echo "<label>Padre: <a href='ver_personas.php?persona=".$row['PadreID']."'>" . $padre['Nombre'] . " " . $padre['Apellido_Paterno'] . " " . $padre['Apellido_Materno'] . "</a></label>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </body>

        <!-- <form action="ver_personas.php" method="GET">
            <label for="persona"></label>
            <select class="desplegable" name="persona" id="persona">
                <option value="">Seleccionar</option>
                <?php
                require 'conexion.php';
                $conexion = new Conexion();
                $pdo = $conexion->pdo;
                $sql = "SELECT PersonaID, Nombre, Apellido_Paterno, Apellido_Materno FROM Personas ORDER BY Nombre";
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
                    return response; // La respuesta está en la caché
                }
                return fetch(event.request); // La respuesta no está en la caché
            })
        );
    });
</script>

</html>