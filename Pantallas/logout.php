/**
 * Este código finaliza la sesión del usuario y redirige a la página de inicio.
 * This code terminates the user's session and redirects to the homepage.
 */
<?php
session_start();
session_unset();
session_destroy();
setcookie(session_name(), '', time() - 3600);

header("Location: index.php");
exit;
