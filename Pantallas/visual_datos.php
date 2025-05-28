<?php
require __DIR__ . '/../Assets/db/config.php';

$tipo = $_GET['tipo'] ?? '';
$valor = $_GET['valor'] ?? '';

$datos = null;
$mensaje = '';

    if ($tipo && $valor) {
        try {
            // Conexión a la base de datos Datos_personales
            $pdoPersonal = new PDO("mysql:host=localhost;dbname=Datos_personales;charset=utf8", 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            // Consulta por ID o Cédula
            if ($tipo === 'id') {
                $stmt = $pdoPersonal->prepare("SELECT * FROM formulario_datospersonales WHERE id = ?");
            } elseif ($tipo === 'cedula') {
                $stmt = $pdoPersonal->prepare("SELECT * FROM formulario_datospersonales WHERE cedula = ?");
            } else {
                throw new Exception("Tipo de búsqueda no válido");
            }

            $stmt->execute([$valor]);
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($datos) {
                // Construcción del nombre completo
                $apellidoCasadaFormateado = '';
                if (!empty($datos['apellido_casada']) && !empty($datos['usa_apellido_casada'])) {
                    $apellidoCasadaFormateado = ' de ' . $datos['apellido_casada'];
                }
                $nombreCompleto = trim(
                    $datos['nombre1'] . ' ' .
                    ($datos['nombre2'] ?? '') . ' ' .
                    $datos['apellido1'] . ' ' .
                    ($datos['apellido2'] ?? '') .
                    $apellidoCasadaFormateado
                );
                // Limpieza de espacios extra
                $datos['nombre'] = preg_replace('/\s+/', ' ', $nombreCompleto);

                // Calcular edad
                if (!empty($datos['fecha_nacimiento'])) {
                    $fechaNacimiento = new DateTime($datos['fecha_nacimiento']);
                    $hoy = new DateTime();
                    $edad = $hoy->diff($fechaNacimiento)->y;
                    $datos['edad'] = $edad;
                } else {
                    $datos['edad'] = 'Desconocida';
                }

                // Conexión a la base de datos Academico
                $pdoAcademico = new PDO("mysql:host=localhost;dbname=Academico;charset=utf8", 'root', '', [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);

                // Consulta de títulos por ID
                $stmtTitulos = $pdoAcademico->prepare("SELECT id, titulo FROM formulario_datosacademico WHERE id_personal = ?");
                $stmtTitulos->execute([$datos['id']]);
                $titulos = $stmtTitulos->fetchAll(PDO::FETCH_ASSOC);

                // Si no hay títulos por ID, intentamos por cédula (respaldo)
                if (empty($titulos)) {
                    $stmtTitulos = $pdoAcademico->prepare("
                        SELECT a.id, a.titulo
                        FROM formulario_datosacademico a
                        JOIN formulario_datospersonales p ON a.id_personal = p.id
                        WHERE p.cedula = ?
                    ");
                    $stmtTitulos->execute([$datos['cedula']]);
                    $titulos = $stmtTitulos->fetchAll(PDO::FETCH_ASSOC);
                }

                $datos['titulos'] = $titulos;

            } else {
                $mensaje = 'No se encontraron datos con el valor proporcionado.';
            }
        } catch (PDOException $e) {
            $mensaje = 'Error de base de datos: ' . $e->getMessage();
        } catch (Exception $e) {
            $mensaje = 'Error: ' . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Visualización de datos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../Assets/imagenes/icono.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top left, #0f0c29, #302b63, #24243e);
            color: #fff;
            font-family: 'Orbitron', sans-serif;
            height: flex;
            padding-top: 40px;
        }

        .dashboard-container {
            background-color: rgba(20, 20, 35, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(138, 43, 226, 0.7);
            max-width: 900px;
            margin: auto;
        }

        label, th {
            color: #e0b0ff;
        }

        footer {
            text-align: center;
            padding: 1rem;
            margin-top: 40px;
            color: #ccccff;
            text-shadow: 0 0 10px #8a2be2;
        }

        .form-control {
            background-color: #1f1f2e;
            color: #fff;
            border: 1px solid #8a2be2;
        }

        .btn-neon {
            background: linear-gradient(135deg, #8a2be2, #4b0082);
            border: none;
            color: white;
            font-weight: bold;
            box-shadow: 0 0 15px #8a2be2;
        }

        .btn-neon:hover {
            box-shadow: 0 0 25px #8a2be2, 0 0 30px #4b0082;
        }
    </style>
</head>
    <body>
        <div class="container dashboard-container mt-5">
            <h2 class="text-center mb-4">Buscar Datos</h2>

            <form class="mb-4" method="GET" action="visual_datos.php">
                <div class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label for="tipo" class="form-label">Buscar por</label>
                        <select name="tipo" id="tipo" class="form-select" required>
                            <option value="id" <?php if (($_GET['tipo'] ?? '') === 'id') echo 'selected'; ?>>ID</option>
                            <option value="cedula" <?php if (($_GET['tipo'] ?? '') === 'cedula') echo 'selected'; ?>>Cédula</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="text" name="valor" id="valor" class="form-control" placeholder="Ingrese el valor" required
                            value="<?php echo htmlspecialchars($_GET['valor'] ?? ''); ?>">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-neon w-100">Buscar</button>
                    </div>
                </div>
            </form>

            <?php if ($mensaje): ?>
                <div class="alert alert-warning text-center"><?php echo htmlspecialchars($mensaje); ?></div>
            <?php elseif ($datos): ?>
                <table class="table table-bordered table-hover text-white">
                    <tbody>
                        <tr><th>Cédula</th><td><?php echo htmlspecialchars($datos['cedula']); ?></td></tr>
                        <tr><th>Nombre</th><td><?php echo htmlspecialchars($datos['nombre']); ?></td></tr>
                        <tr><th>Fecha de nacimiento</th><td><?php echo htmlspecialchars($datos['fecha_nacimiento']); ?></td></tr>
                        <tr><th>Edad</th><td><?php echo $datos['edad']; ?></td></tr>
                        <tr><th>Sexo</th><td><?php echo htmlspecialchars($datos['sexo']); ?></td></tr>
                        <tr><th>Teléfono</th><td><?php echo htmlspecialchars($datos['telefono']); ?></td></tr>
                        <tr><th>Provincia</th><td><?php echo htmlspecialchars($datos['provincia']); ?></td></tr>
                        <tr><th>Distrito</th><td><?php echo htmlspecialchars($datos['distrito']); ?></td></tr>
                        <tr><th>Corregimiento</th><td><?php echo htmlspecialchars($datos['corregimiento']); ?></td></tr>
                        <tr>
                            <th>Títulos</th>
                            <td>
                                <ul>
                                    <?php foreach ($datos['titulos'] as $titulo): ?>
                                        <li>
                                            <?php echo htmlspecialchars($titulo['titulo']); ?>
                                            <button class="btn btn-link ver-archivo-btn"
                                                    data-url="lo_visualdatos.php?tipo=<?php echo urlencode($tipo); ?>&valor=<?php echo urlencode($valor); ?>&titulo_id=<?php echo $titulo['id']; ?>">
                                                Ver archivo
                                            </button>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Contenedor único para el iframe, oculto inicialmente -->
                <div id="visor-iframe-container" style="display:none; margin-top:20px;">
                    <h4 class="text-info">Visualización extendida</h4>
                    <iframe id="visor-iframe" src="" width="100%" height="500px" style="border:1px solid #ccc; border-radius:10px;"></iframe>
                </div>

                <script>
                    document.querySelectorAll('.ver-archivo-btn').forEach(btn => {
                        btn.addEventListener('click', () => {
                            const url = btn.dataset.url;
                            const container = document.getElementById('visor-iframe-container');
                            const iframe = document.getElementById('visor-iframe');
                            iframe.src = url;              // Cambia la fuente del iframe
                            container.style.display = 'block';  // Muestra el iframe
                            iframe.scrollIntoView({ behavior: 'smooth' }); // Opcional: baja hasta el iframe
                        });
                    });
                </script>
            <?php endif; ?>
        </div>
        <footer class="text-center mt-4 text-muted">
            &copy; <?php echo date('Y'); ?> Neon Masters. Todos los derechos reservados.
        </footer>
    </body>
</html>
