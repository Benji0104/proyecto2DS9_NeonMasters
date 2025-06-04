<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="icon" href="../Assets/imagenes/icono.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <link href="../Assets/style/style_r.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-dark" style="background: linear-gradient(135deg, #8a2be2, #4b0082); box-shadow: 0 0 15px #8a2be2;">
        <div class="container-fluid">
            <a href="NeonMasters.php" class="navbar-brand mb-0 h1" style="font-family: 'Orbitron', sans-serif; color: #fff; text-shadow: 0 0 10px #e0b0ff; text-decoration: none;">
                Neon Masters
            </a>
        </div>
    </nav>
    <main class="flex-fill d-flex justify-content-center align-items-center">
        <div class="registro-container">
            <h2>Registrar Usuario</h2>
            <form action="lo_registro.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Ingresa un nombre de usuario" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa una contraseña" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirmar contraseña</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirma la contraseña" required>
                </div>

                <button type="submit" class="btn btn-neon mt-3">Registrarse</button>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php elseif (!empty($success)): ?>
                    <div class="alert alert-success mt-3" role="alert">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </main>

    <footer class="mt-auto">
        <div class="container text-center">
            <p class="mb-0" style="font-size: 0.9rem;">
                &copy; <?php echo date('Y'); ?> Neon Masters. Todos los derechos reservados.
            </p>
        </div>
    </footer>

</body>
</html>
