<?php
session_start();
require __DIR__ . '/../Assets/db/config.php';

$conn = obtenerConexionPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $passwordInput = $_POST['password'] ?? '';

    try {
        $stmt = $conn->prepare("SELECT pass FROM info WHERE user = :user");
        $stmt->execute(['user' => $username]);
        $passwordHash = $stmt->fetchColumn();

        if ($passwordHash !== false) {
            if (password_verify($passwordInput, $passwordHash)) {
                $_SESSION['user'] = $username;
                header("Location: visual_datos.php");
                exit;
            } else {
                $_SESSION['login_error'] = "Contraseña incorrecta.";
            }
        } else {
            $_SESSION['login_error'] = "Usuario no encontrado.";
        }
    } catch (PDOException $e) {
        // Puedes registrar el error o mostrarlo (solo en desarrollo)
        $_SESSION['login_error'] = "Error en la base de datos.";
    }

    header("Location: login.php");
    exit;
} else {
    header("Location: login.php");
    exit;
}
