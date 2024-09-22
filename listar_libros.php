<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Libros</title>
</head>
<body>
    <h1>Lista de Libros</h1>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Autor</th>
            <th>ISBN</th>
            <th>Numero de edicion</th>
            <th>Costo por mora</th>
            <th>Estado</th>
        </tr>
        <?php
        $sql="SELECT * FROM libro";
        $result = $conn->query($sql);

        if ($result->num_rows > 0){
            while ($row=$result->fetch_assoc()){
                echo   "<tr>
                            <td>{$row['id_libro']}</td>
                            <td>{$row['titulo']}</td>
                            <td>{$row['autor']}</td>
                            <td>{$row['ISBN']}</td>
                            <td>{$row['numero_edicion']}</td>
                            <td>{$row['costo_diario_mora']}</td>
                            <td>{$row['prestado']}</td>
                        </tr>";
            }
        }
        else{
            echo "<tr><td colspan='5'>No hay Libros</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    <br><br>
    <a href='registrar_libros.php'>Registrar nuevo Libro</a>
</body>
</html>