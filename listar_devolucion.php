<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Devoluciones</title>
</head>
<body>
    <h1>Lista de Devoluciones</h1>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Fecha de Devolucion</th>
            <th>Monto por Mora</th>
        </tr>
        <?php
        $sql="SELECT * FROM devolucion";
        $result = $conn->query($sql);

        if ($result->num_rows > 0){
            while ($row=$result->fetch_assoc()){
                echo   "<tr>
                            <td>{$row['id_prestamo']}</td>
                            <td>{$row['fecha_devolucion']}</td>
                            <td>{$row['monto_mora']}</td>
                        </tr>";
            }
        }
        else{
            echo "<tr><td colspan='5'>No hay devoluciones</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    <br><br>
    <a href='registrar_devolucion.php'>Registrar nueva Devolucion</a>
</body>
</html>