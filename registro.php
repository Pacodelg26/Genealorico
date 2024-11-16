<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
</head>
<body>

<h2>Registro de Usuario</h2>
<form action="registro_procesar.php" method="POST">
    <label for="nombre_usuario">Nombre de Usuario:</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario" required>
    <br>
    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>
    <br>
    <input type="submit" value="Registrarse">
</form>

</body>
</html>

