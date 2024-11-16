<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $conn->real_escape_string($_POST['nombre_usuario']);
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT Contrasena FROM Usuarios WHERE NombreUsuario = '$nombre_usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contrasena, $row['Contrasena'])) {
            header("Location: pagina_principal.php");
            echo "Inicio de sesión exitoso. <a href='pagina_principal.php'>Ir a la página principal</a>";
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró el usuario.";
    }

    $conn->close();
}
?>
