<?php include 'db.php'?>

<?php
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $nombre=$_POST['nombre'];
    $identificacion=$_POST['identificacion'];
    $telefono=$_POST['telefono'];

    $sql="INSERT INTO cliente (nombre, identificacion, telefono) VALUES
            ( '$nombre', '$identificacion', '$telefono')";

    if ($conn->query($sql) === TRUE){
        echo "Nuevo cliente registrado con éxito";
    }
    else{
        echo "Error: ".$conn->error;
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente</title>
</head>
<body>
    <h1>Registrar Cliente</h1>
    <form action='registrar_clientes.php' method='POST'>
        <label>Nombre: </label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>
        <label>Identificacion: </label>
        <input type="text" id="identificacion" name="identificacion" required>
        <br><br>
        <label>Telefono: </label>
        <input type="text" id="telefono" name="telefono" required>
        <br><br>
        <input type="submit" value="Registrar">
    </form>
    <br><br><br>
    <a href='listar_clientes.php'>Listado de clientes</a>
    <br><br><br>
    <a href='registrar_clientes.php'>Registrar Cliente &emsp;</a>
    <a href='registrar_libros.php'>Registrar libro &emsp;</a>
    <a href='registrar_prestamo.php'>Registrar prestamo &emsp;</a>
    <a href='registrar_devolucion.php'>Registrar devolucion</a>
</body>
</html>