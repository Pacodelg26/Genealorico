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
.desplegable2 {2
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
        Para empezar registraté o <a href='login.php'>haz login</a></h2>
    </div>   
  
Registro

<div class="contenedor">
<form action="registro_procesar.php" method="POST">
    <label for="nombre_usuario">Nombre de Usuario:</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario" required>
    <br>
    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>
    <br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required>
    <br>
    <input type="submit" value="Registrarse">
</form>
</div>  

</body>
</html>
