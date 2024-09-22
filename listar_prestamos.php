<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Prestamos</title>
</head>
<body>
    <h1>Lista de Prestamos</h1>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Id Cliente</th>
            <th>Id Libro</th>
            <th>Fecha del Prestamo</th>
            <th>Fecha de Devolucion</th>
        </tr>
        <?php
        $sql="SELECT * FROM prestamo WHERE activo=1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0){
            while ($row=$result->fetch_assoc()){
                echo   "<tr>
                            <td>{$row['id_prestamo']}</td>
                            <td>{$row['id_cliente']}</td>
                            <td>{$row['id_libro']}</td>
                            <td>{$row['fecha_prestamo']}</td>
                            <td>{$row['fecha_devolucion']}</td>
                        </tr>";
            }
        }
        else{
            echo "<tr><td colspan='5'>No hay prestamos activos</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    <br><br>
    <a href='registrar_prestamo.php'>Registrar nuevo Prestamo</a>
</body>
</html>