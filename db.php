<?php
$servername="localhost";
$username="prueba";
$password="123456";
$dbname="biblioteca";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Conexión fallida: ".$conn->connect_error);
}
?>