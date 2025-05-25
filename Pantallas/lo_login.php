<?php
session_start();
require __DIR__ . '/../Assets/db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $passwordInput = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT pass FROM info WHERE user = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($passwordHash);
        $stmt->fetch();

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

    $stmt->close();
    $conn->close();
    header("Location: login.php");
    exit;
} else {
    header("Location: login.php");
    exit;
}
