<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Software Desarrollado - Neon Masters</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../Assets/imagenes/icono.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <link href="../Assets/style/style_sD.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-dark" style="background: linear-gradient(135deg, #8a2be2, #4b0082); box-shadow: 0 0 15px #8a2be2;">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand mb-0 h1" style="font-family: 'Orbitron', sans-serif; color: #fff; text-shadow: 0 0 10px #e0b0ff; text-decoration: none;">
                Neon Masters
            </a>
        </div>
    </nav>

    <div class="container container-main">
        <h1 class="neon-title">Software Desarrollado</h1>

        <!-- Juego 1 -->
        <div class="game-card">
            <h3 class="game-title">The Knight of Tomorrow</h3>
            <div class="game-genre">
                <span class="badge-neon">Puzzle</span>
                <span class="badge-neon">Acción</span>
                <span class="badge-neon">Aventura</span>
                <span class="badge-neon">3ra Persona</span>
            </div>
            <p class="game-desc">
                En un mundo medieval fantástico, un caballero tiene solo <strong>16 lunas</strong> para rescatar a la princesa encerrada en la cima de una torre encantada.
                El jugador debe resolver enigmas, superar trampas y enfrentar a otros caballeros en una carrera contra el tiempo, en esta intensa aventura de acción y puzzles.
            </p>
        </div>

        <!-- Juego 2 -->
        <div class="game-card">
            <h3 class="game-title">Dead Cruise</h3>
            <div class="game-genre">
                <span class="badge-neon">Survival Horror</span>
                <span class="badge-neon">3ra Persona</span>
                <span class="badge-neon">Narrativa</span>
            </div>
            <p class="game-desc">
                Lo que parecía unas vacaciones perfectas se convierte en una pesadilla: una familia queda atrapada en un <strong>crucero invadido por zombis</strong>.
                La protagonista, exagente del FBI con 4 años de experiencia, debe sobrevivir a una masacre nocturna mientras protege a su hija y esposo.
                Lucha, explora y toma decisiones que cambiarán tu destino en este <em>survival horror</em> emocional y brutal.
            </p>
        </div>

        <!-- Juego 3 -->
        <div class="game-card">
            <h3 class="game-title">Tersus Proxy</h3>
            <div class="game-genre">
                <span class="badge-neon">Shooter Táctico</span>
                <span class="badge-neon">TPS</span>
                <span class="badge-neon">Co-Op</span>
                <span class="badge-neon">Survival</span>
            </div>
            <p class="game-desc">
                Cinco mercenarios son contratados para eliminar toda evidencia de una oscura empresa bioquímica ubicada en la costa pacífica de Costa Rica.
                Pronto descubrirán secretos atroces detrás de sus misiones.
                Juego en escuadra con mecánicas de estrategia, sigilo y combate intenso, ideal para equipos de hasta 4 jugadores.
            </p>
        </div>

        <!-- Juego 4 -->
        <div class="game-card">
            <h3 class="game-title">J. Rix</h3>
            <div class="game-genre">
                <span class="badge-neon">Acción</span>
                <span class="badge-neon">Puzzle</span>
                <span class="badge-neon">Espionaje</span>
                <span class="badge-neon">Inmersivo</span>
            </div>
            <p class="game-desc">
                Un grupo de agentes de la CIA recibe una misión imposible: evitar la compra y dispersión de una arma química letal
                que destruye los pulmones de forma irreversible. <strong>Ni máscaras ni filtros funcionan</strong>.
                Sumérgete en una experiencia narrativa profunda, con mecánicas de infiltración, lógica avanzada y decisiones que afectan el curso de la historia.
            </p>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Neon Masters. Todos los derechos reservados.
    </footer>

</body>
</html>
