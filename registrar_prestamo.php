<?php include 'db.php' ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];
    $id_libro = $_POST['id_libro'];
    $fecha_prestamo = $_POST['fecha_prestamo'];
    $fecha_devolucion = $_POST['fecha_devolucion'];

    if ($fecha_prestamo > $fecha_devolucion) {
        echo "La fecha de prestamo no puede ser mayor a la fecha de devolucion";
        $conn->close();
    } else {
        $buscar_prestamos_vencidos = "SELECT * FROM prestamo WHERE CURDATE() > fecha_devolucion AND id_cliente='$id_cliente' AND activo=1";
        $result_prestamos_vencidos = $conn->query($buscar_prestamos_vencidos);

        if ($result_prestamos_vencidos->num_rows > 0) {
            echo "El cliente tiene prestamos vencidos";
            $conn->close();
        } else {
            $buscar_libro_prestado = "SELECT prestado FROM libro WHERE id_libro='$id_libro'";
            $result_libro_prestado = $conn->query($buscar_libro_prestado);
            if ($result_libro_prestado->num_rows > 0) {
                $row = $result_libro_prestado->fetch_assoc();
                if ($row['prestado'] == 1) {
                    echo "El libro ya esta prestado";
                    $conn->close();
                } else {
                    $actualizar_estado_libro = "UPDATE libro SET prestado=1 WHERE id_libro='$id_libro'";
                    $conn->query($actualizar_estado_libro);
                    
                    $sql = "INSERT INTO prestamo (id_cliente, id_libro, fecha_prestamo, fecha_devolucion, activo) VALUES
                    ('$id_cliente', '$id_libro', '$fecha_prestamo', '$fecha_devolucion' , 1)";

                    if ($conn->query($sql) === TRUE) {
                        echo "Nuevo prestamo registrado con éxito";
                    } else {
                        echo "Error: " . $conn->error;
                    }

                    $conn->close();
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Prestamo</title>
</head>

<body>
    <h1>Registrar Prestamo</h1>
    <form action='registrar_prestamo.php' method='POST'>
        <label>Id cliente: </label>
        <input type="number" id="id_cliente" name="id_cliente" required>
        <br><br>
        <label>Id libro: </label>
        <input type="number" id="id_libro" name="id_libro" required>
        <br><br>
        <label>Fecha del prestamo: </label>
        <input type="date" id="fecha_prestamo" name="fecha_prestamo" required>
        <br><br>
        <label>Fecha de devolucion: </label>
        <input type="date" id="fecha_devolucion" name="fecha_devolucion" required>
        <br><br>
        <input type="submit" value="Registrar">
    </form>
    <br><br><br>
    <a href='listar_prestamos.php'>Listado de prestamos</a>
    <br><br><br>
    <a href='registrar_clientes.php'>Registrar Cliente &emsp;</a>
    <a href='registrar_libros.php'>Registrar libro &emsp;</a>
    <a href='registrar_prestamo.php'>Registrar prestamo &emsp;</a>
    <a href='registrar_devolucion.php'>Registrar devolucion</a>
</body>

</html>