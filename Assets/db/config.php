<?php

$host = 'localhost';         // o IP del servidor
$db   = 'Usuario';
$user = 'root';              // cambiar según el servidor
$pass = '';                  // cambiar según el servidor

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
