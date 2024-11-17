<?php
// Cargar las variables de entorno manualmente desde el archivo .env
$dotenv = fopen("../.env", "r");

if ($dotenv) {
    while (($line = fgets($dotenv)) !== false) {
        // Eliminar espacios en blanco y saltos de línea
        $line = trim($line);
        
        // Saltar comentarios
        if ($line[0] === "#" || empty($line)) {
            continue;
        }

        // Establecer la variable de entorno
        list($key, $value) = explode("=", $line, 2);
        putenv(trim($key) . "=" . trim($value));
    }
    fclose($dotenv);
}
?>