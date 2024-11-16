<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GenealoRico - Pagina Principal</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
</head>
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
    width: calc(50% - 20px);
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #ddd;
    font-size: 30px;
    
}
input[type="password"] {
    width: calc(50% - 20px);
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #ddd;
    font-size: 30px;
    
}
input[type="submit"] {
            width: calc(60% - 30px);
          
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 30px;
        } 
        .img {
    width: 100%;
    max-width: 80px;
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
        
    </div>   


<?php



include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $conn->real_escape_string($_POST['nombre_usuario']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $email = $conn->real_escape_string($_POST['email']);
    $sql = "INSERT INTO Usuarios (NombreUsuario, Contrasena, Email) VALUES ('$nombre_usuario', '$contrasena', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso. <a href='login.php'>Iniciar Sesión</a>";
    } else {
    
        echo "Error: <br>" . $conn->error;
    }

    $conn->close();
}
?>
