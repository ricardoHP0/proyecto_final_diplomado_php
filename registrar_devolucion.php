<?php include 'db.php' ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_prestamo = $_POST['id_prestamo'];
    $fecha_devolucion = $_POST['fecha_devolucion'];

    if (isset($_POST['calcular'])) {
        $informacion_costo = "SELECT costo_diario_mora FROM libro WHERE id_libro=(SELECT id_libro FROM prestamo WHERE id_prestamo='$id_prestamo')";
        $result = $conn->query($informacion_costo);
        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            $costo_diario_mora = $row['costo_diario_mora'];
            $monto_mora = 0;

            $informacion_devolucion = "SELECT fecha_devolucion FROM prestamo WHERE id_prestamo='$id_prestamo'";
            $result_devolucion = $conn->query($informacion_devolucion);
            $row = $result_devolucion->fetch_assoc();
            $fecha_programada_devolucion = $row['fecha_devolucion'];


            $fecha_actual = date('Y-m-d');
            $dias = (strtotime($fecha_devolucion) - strtotime($fecha_programada_devolucion)) / (60 * 60 * 24);
            if ($dias <= 0) {
                $monto_mora = 0;
            } else {
                $monto_mora = $dias * $costo_diario_mora;
            }
        }
        else {
            echo "El prestamo no existe";
            $conn->close();
        }
    }

    if (isset($_POST['registrar'])) {
        $monto_mora = $_POST['monto_mora'];

        $buscar_devolucion = "SELECT * FROM devolucion WHERE id_prestamo='$id_prestamo'";
        $result_devolucion = $conn->query($buscar_devolucion);
        if ($result_devolucion->num_rows > 0) {
            echo "La devolucion no se pudo realizar ya que ha sido registrada anteriormente";
            $conn->close();
        } else {
            $buscar_prestamo = "SELECT * FROM prestamo WHERE id_prestamo='$id_prestamo'";
            $result_prestamo = $conn->query($buscar_prestamo);
            if ($result_prestamo->num_rows == 0) {
                echo "El prestamo no existe";
                $conn->close();
            } else {
                $validar_devolucion = "SELECT fecha_devolucion FROM prestamo WHERE id_prestamo='$id_prestamo'";
                $fecha_actual = date('Y-m-d');
                $result_devolucion = $conn->query($validar_devolucion);
                $row = $result_devolucion->fetch_assoc();

                $actualizar_prestado = "UPDATE libro SET prestado=0 WHERE id_libro=(SELECT id_libro FROM prestamo WHERE id_prestamo='$id_prestamo')";
                $conn->query($actualizar_prestado);

                $actualizar_devolucion = "UPDATE prestamo SET activo=0 WHERE id_prestamo='$id_prestamo'";
                $conn->query($actualizar_devolucion);


                $sql = "INSERT INTO devolucion (id_prestamo, fecha_devolucion, monto_mora) VALUES
                ( '$id_prestamo', '$fecha_devolucion', '$monto_mora')";

                if ($conn->query($sql) === TRUE) {
                    echo "Devolucion registrada con éxito";
                } else {
                    echo "Error: " . $conn->error;
                }

                $conn->close();
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
    <title>Registrar devolucion</title>
</head>

<body>
    <h1>Registrar Devolucion</h1>
    <form action='registrar_devolucion.php' method='POST'>
        <label>Id prestamo: </label>
        <input type="text" id="id_prestamo" name="id_prestamo" value="<?php echo isset($_POST['calcular']) ? $id_prestamo : (isset($_POST['registrar']) ? $id_prestamo : ''); ?>" required>
        <br><br>
        <label>Fecha de devolucion: </label>
        <input type="date" id="fecha_devolucion" name="fecha_devolucion" value="<?php echo $fecha_devolucion; ?>" required>
        <br><br>
        <input type="submit" name="calcular" value="Calcular">
        <br><br>
        <label>Monto por mora: </label>
        <input type="number" id="monto_mora" name="monto_mora" value="<?php echo $monto_mora; ?>" readonly>
        <br><br>
        <input type="submit" name="registrar" value="Registrar">
    </form>
    <br><br><br>
    <a href='listar_devolucion.php'>Listado de devoluciones realizadas</a>
    <br><br><br>
    <a href='registrar_clientes.php'>Registrar Cliente &emsp;</a>
    <a href='registrar_libros.php'>Registrar libro &emsp;</a>
    <a href='registrar_prestamo.php'>Registrar prestamo &emsp;</a>
    <a href='registrar_devolucion.php'>Registrar devolucion</a>
</body>

</html>