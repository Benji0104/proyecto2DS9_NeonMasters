/**
 * Este código maneja el registro de usuarios, validando datos y almacenándolos en una base de datos.
 * This code handles user registration, validating data and storing it in a database.
 */
<?php
session_start();
require __DIR__ . '/../Assets/db/config.php';

$conn = obtenerConexionPDO();

$errorMessage = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validaciones básicas
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $errorMessage = 'Todos los campos son obligatorios.';
    } elseif ($password !== $confirm_password) {
        $errorMessage = 'Las contraseñas no coinciden.';
    } else {
        // Verificar si el usuario ya existe
        $query = "SELECT user FROM info WHERE user = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            $errorMessage = 'El nombre de usuario ya está en uso.';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO info (user, pass) VALUES (?, ?)";
            $insert_stmt = $conn->prepare($insert_query);

            if ($insert_stmt->execute([$username, $hashed_password])) {
                $successMessage = 'Usuario registrado exitosamente. Puedes iniciar sesión.';
            } else {
                $errorMessage = 'Error al registrar el usuario. Intenta nuevamente.';
            }
        }
        header("Location: NeonMasters.php");
        exit;
    }
}
?>
