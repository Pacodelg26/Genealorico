<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Genealopaco - Personas</title>
</head>
<body>
    <h1>Lista de Personas</h1>
    <a href="create.php">Crear Nueva Persona</a>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Fecha de Nacimiento</th>
            <th>Lugar de Nacimiento</th>
            <th>Fecha de Defunción</th>
            <th>Lugar de Defunción</th>
            <th>Foto</th>
            <th>Género</th>
            <th>Acciones</th>
        </tr>
        <?php
        $sql = "SELECT * FROM Personas";
        $result = $conn->query($sql);
       // $variable1 = ".$row['PersonaID']."
       // $variable2 = ".$row['PersonaID']."
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row['Nombre']."</td>
                    <td>".$row['Apellido_Paterno']."</td>
                    <td>".$row['Apellido_Materno']."</td>
                    <td>".$row['Fecha_de_Nacimiento']."</td>
                    <td>".$row['Lugar_de_Nacimiento']."</td>
                    <td>".$row['Fecha_de_Defunción']."</td>
                    <td>".$row['Lugar_de_Defunción']."</td>
                    <td><img src='".$row['Foto']."' width='50'></td>
                    <td>".$row['Genero']."</td>
                    <td><a href='edit.php?id=".$row['PersonaID']."&nombre=".$row['Nombre']."&apellido_paterno=".$row['Apellido_Paterno']."&apellido_materno=".$row['Apellido_Materno']."'>Editar</a></td>

                </tr>";
//<td><a href='edit.php?id="urlencode(.$row['PersonaID'])."&nombre="urlencode(.$row['Nombre'])."'>Editar</a></td> 
            }
        } else {
            echo "<tr><td colspan='10'>No hay registros</td></tr>";
        }
        ?>
    </table>
</body>
</html>
