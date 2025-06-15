// Verifica si hay una sesión activa; redirige al usuario a la página de inicio si no está autenticado.
// Checks if a session is active; redirects the user to the homepage if not authenticated.
<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../Pantallas/index.php");
    exit;
}
