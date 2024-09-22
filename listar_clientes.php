<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
</head>
<body>
    <h1>Lista de Clientes</h1>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Identificacion</th>
            <th>Telefono</th>
        </tr>
        <?php
        $sql="SELECT * FROM cliente";
        $result = $conn->query($sql);

        if ($result->num_rows > 0){
            while ($row=$result->fetch_assoc()){
                echo   "<tr>
                            <td>{$row['id_cliente']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['identificacion']}</td>
                            <td>{$row['telefono']}</td>
                        </tr>";
            }
        }
        else{
            echo "<tr><td colspan='5'>No hay Clientes</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    <br><br>
    <a href='registrar_clientes.php'>Registrar nuevo Cliente</a>
</body>
</html>