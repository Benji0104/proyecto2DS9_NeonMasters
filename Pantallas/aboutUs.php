<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sobre Nosotros</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../Assets/imagenes/icono.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <link href="../Assets/style/style_aU.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark" style="background: linear-gradient(135deg, #8a2be2, #4b0082); box-shadow: 0 0 15px #8a2be2;">
        <div class="container-fluid">
            <a href="NeonMasters.php" class="navbar-brand mb-0 h1" style="font-family: 'Orbitron', sans-serif; color: #fff; text-shadow: 0 0 10px #e0b0ff; text-decoration: none;">
                Neon Masters
            </a>
        </div>
    </nav>

    <div class="container container-about">
        <h1 class="neon-title">Sobre Nosotros</h1>

        <div class="glass-card position-relative">
            <div class="pulse-ring" style="top: -10px; left: -10px;"></div>
            <h3 class="mb-3">¿Quiénes somos?</h3>
            <p>
                <strong>Neon Masters</strong> es una empresa panameña especializada en el <span class="highlight">desarrollo de videojuegos</span>.
                Fundada en <span class="highlight">2026</span> por el visionario <span class="highlight">Benjamín Gil</span>,
                hemos creado hasta la fecha <span class="highlight">cuatro videojuegos originales</span> y seguimos innovando.
            </p>
        </div>

        <div class="glass-card">
            <h4 class="mb-2">Ubicación</h4>
            <p>
                Nuestro centro de operaciones se encuentra en <span class="highlight">Costa Verde, La Chorrera</span>,
                provincia de <span class="highlight">Panamá Oeste</span>, Panamá. Estamos en un edificio moderno adaptado a la creatividad tecnológica.
            </p>
            <span class="badge badge-custom">Oficina Central</span>
        </div>

        <div class="glass-card">
            <h4 class="mb-2">Equipo</h4>
            <p>
                Actualmente, Neon Masters cuenta con un equipo multidisciplinario de <span class="highlight">35 empleados</span>,
                incluyendo desarrolladores, artistas visuales, diseñadores de sonido, escritores y testers.
            </p>
            <span class="badge badge-custom">Crecimiento constante</span>
        </div>

        <div class="glass-card">
            <h4 class="mb-2">Misión</h4>
            <p>
                Crear experiencias interactivas que destaquen por su calidad artística y técnica,
                mientras representamos a Panamá en la industria global del entretenimiento digital.
            </p>
            <span class="badge badge-custom">Pasión por innovar</span>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Neon Masters. Todos los derechos reservados.
    </footer>

</body>
</html>
