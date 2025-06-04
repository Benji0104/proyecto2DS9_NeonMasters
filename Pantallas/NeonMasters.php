<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Neon Masters</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../Assets/imagenes/icono.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <link href="../Assets/style/style_NM.css" rel="stylesheet">
</head>
<body>

    <div class="container container-main text-center">
        <h1 class="mb-5" style="color: #e0b0ff;">Neon Masters</h1>
        <div class="row g-4 justify-content-center">

            <!-- Tarjeta 1: Administrador -->
            <div class="col-md-6 col-lg-3">
                <div class="card p-4 h-100">
                    <h4 class="card-title mb-3">Administrador</h4>
                    <p>Accede para visualizar datos.</p>
                    <a href="login.php" class="btn btn-neon mt-3">Iniciar sesión</a>
                </div>
            </div>

            <!-- Tarjeta 2: Solicitud de empleo -->
            <div class="col-md-6 col-lg-3">
                <div class="card p-4 h-100">
                    <h4 class="card-title mb-3">Solicitud de empleo</h4>
                    <p>Completa el formulario para enviar tu solicitud laboral.</p>
                    <a href="formulario.php" class="btn btn-neon mt-3">Formulario</a>
                </div>
            </div>

            <!-- Tarjeta 3: Sobre Nosotros -->
            <div class="col-md-6 col-lg-3">
                <div class="card p-4 h-100">
                    <h4 class="card-title mb-3">Sobre Nosotros</h4>
                    <p>Conoce más sobre nuestra empresa y misión.</p>
                    <a href="aboutUs.php" class="btn btn-neon mt-3">Ver más</a>
                </div>
            </div>

            <!-- Tarjeta 4: Software Desarrollado -->
            <div class="col-md-6 col-lg-3">
                <div class="card p-4 h-100">
                    <h4 class="card-title mb-3">Software Desarrollado</h4>
                    <p>Explora el software que hemos creado.</p>
                    <a href="Pantallas/software.php" class="btn btn-neon mt-3">Ir</a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Neon Masters. Todos los derechos reservados.
    </footer>

</body>
</html>
