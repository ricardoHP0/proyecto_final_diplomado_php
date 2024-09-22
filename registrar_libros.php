<?php include 'db.php'?>

<?php
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $titulo=$_POST['titulo'];
    $autor=$_POST['autor'];
    $isbn=$_POST['isbn'];
    $numero_edicion=$_POST['numero_edicion'];
    $costo_diario_mora=$_POST['costo_diario_mora'];

    $sql="INSERT INTO libro (titulo, autor, ISBN, numero_edicion, costo_diario_mora, prestado) VALUES
            ('$titulo', '$autor', '$isbn', '$numero_edicion', '$costo_diario_mora', 0)";

    if ($conn->query($sql) === TRUE){
        echo "Nuevo libro registrado con éxito";
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
    <title>Registrar Libro</title>
</head>
<body>
    <h1>Registrar Libro</h1>
    <form action='registrar_libros.php' method='POST'>
        <label>Titulo: </label>
        <input type="text" id="titulo" name="titulo" required>
        <br><br>
        <label>Autor: </label>
        <input type="text" id="autor" name="autor" required>
        <br><br>
        <label>ISBN: </label>
        <input type="text" id="isbn" name="isbn" required>
        <br><br>
        <label>Numero edicion: </label>
        <input type="text" id="numero_edicion" name="numero_edicion" required>
        <br><br>
        <label>Costo diario por mora: </label>
        <input type="number" id="costo_diario_mora" name="costo_diario_mora" required>
        <br><br>
        <input type="submit" value="Registrar">
    </form>
    <br><br><br>
    <a href='registrar_clientes.php'>Registrar Cliente &emsp;</a>
    <a href='registrar_libros.php'>Registrar libro &emsp;</a>
    <a href='registrar_prestamo.php'>Registrar prestamo &emsp;</a>
    <a href='registrar_devolucion.php'>Registrar devolucion</a>
</body>
</html>