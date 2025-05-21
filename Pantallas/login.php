<?php
session_start();
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../Assets/imagenes/icono.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            background: radial-gradient(circle at top left, #0f0c29, #302b63, #24243e);
            color: #fff;
            font-family: 'Orbitron', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            background-color: rgba(20, 20, 35, 0.9);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(138, 43, 226, 0.8);
            width: 100%;
            max-width: 400px;
            margin: 20px;
        }

        .login-container h2 {
            text-align: center;
            color: #e0b0ff;
            margin-bottom: 30px;
            text-shadow: 0 0 10px #8a2be2;
        }

        .form-control {
            background-color: #1f1f2e;
            color: #fff;
            border: 1px solid #8a2be2;
        }

        .form-control:focus {
            box-shadow: 0 0 10px #8a2be2;
            border-color: #e0b0ff;
        }

        .btn-neon {
            background: linear-gradient(135deg, #8a2be2, #4b0082);
            border: none;
            color: white;
            font-weight: bold;
            width: 100%;
            box-shadow: 0 0 15px #8a2be2;
        }

        .btn-neon:hover {
            box-shadow: 0 0 25px #8a2be2, 0 0 30px #4b0082;
        }

        footer {
            text-align: center;
            padding: 1rem;
            color: #ccccff;
            text-shadow: 0 0 10px #8a2be2;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <main class="flex-fill d-flex justify-content-center align-items-center">
        <div class="login-container">
            <h2>Neon Masters</h2>
            <form action="lo_login.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Ingresa tu usuario" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                </div>
                <button type="submit" class="btn btn-neon mt-3">Iniciar sesión</button>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </main>

    <footer class="mt-auto">
        <div class="container">
            <p class="mb-0" style="font-size: 0.9rem;">
                &copy; <?php echo date('Y'); ?> Neon Masters. Todos los derechos reservados.
            </p>
        </div>
    </footer>

</body>
</html>

