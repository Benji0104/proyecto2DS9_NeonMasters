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

                // --- Aquí añadimos la validación si el título tiene archivo ---
                if (!empty($titulos)) {
                    $titulo_ids = array_column($titulos, 'id');
                    $placeholders = implode(',', array_fill(0, count($titulo_ids), '?'));

                    $stmtArchivos = $pdoAcademico->prepare("
                        SELECT id, archivo IS NOT NULL AS tiene_archivo 
                        FROM formulario_datosacademico 
                        WHERE id IN ($placeholders)
                    ");
                    $stmtArchivos->execute($titulo_ids);
                    // Obtenemos [id => tiene_archivo]
                    $archivos = $stmtArchivos->fetchAll(PDO::FETCH_KEY_PAIR);

                    foreach ($titulos as &$titulo) {
                        $titulo['tiene_archivo'] = !empty($archivos[$titulo['id']]);
                    }
                    unset($titulo);
                }
                // ---------------------------------------------------------------

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
    <script src="/proyecto2/Scripts/validaciones.js"></script>
    <link rel="icon" href="../Assets/imagenes/icono.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <link href="../Assets/style/style_vd.css" rel="stylesheet">
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
                        <input type="text" name="valor" id="valor" class="form-control" placeholder="Ingrese el valor" onkeypress="soloNumerosYGuion(event)" required
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
                                            <?php if (!empty($titulo['tiene_archivo'])): ?>
                                                <button class="btn btn-link ver-archivo-btn"
                                                    data-url="cargar_archivo.php?tipo=<?php echo urlencode($tipo); ?>&valor=<?php echo urlencode($valor); ?>&titulo_id=<?php echo $titulo['id']; ?>">
                                                    Ver archivo
                                                </button>
                                            <?php else: ?>
                                                <span style="color: gray; font-style: italic;">Sin archivo</span>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Contenedor único para el iframe, oculto inicialmente -->
                <div id="visor-iframe-container" style="display:none; margin-top:20px; position: relative;">
                    <button id="cerrar-visor" style="position: absolute; top: 5px; right: 5px; background: transparent; border: none; font-size: 20px; cursor: pointer;">❌</button>
                    <h4 class="text-info">Visualización</h4>

                    <iframe id="visor-iframe" src="" width="100%" height="500px"
                        style="border:1px solid #ccc; border-radius:10px;"></iframe>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const visorContainer = document.getElementById('visor-iframe-container');
                        const iframe = document.getElementById('visor-iframe');
                        const btnCerrar = document.getElementById('cerrar-visor');
                        const btnEliminar = document.getElementById('eliminar-archivo');
                        let botonActual = null; // Referencia al botón que abrió el visor

                        // Mostrar visor al hacer clic en "Ver archivo"
                        document.querySelectorAll('.ver-archivo-btn').forEach(btn => {
                            btn.addEventListener('click', (e) => {
                                e.stopPropagation(); // Evita que el clic se propague al document
                                const url = btn.dataset.url;
                                iframe.src = url;
                                visorContainer.style.display = 'block';
                                iframe.scrollIntoView({ behavior: 'smooth' });
                                botonActual = btn; // Guardamos el botón activo para saber cuál eliminar luego
                            });
                        });

                        // Cerrar visor con botón ❌
                        btnCerrar.addEventListener('click', function () {
                            visorContainer.style.display = 'none';
                            iframe.src = '';
                        });

                        // Cerrar visor al hacer clic fuera del contenedor
                        document.addEventListener('click', function (e) {
                            if (visorContainer.style.display === 'block' && !visorContainer.contains(e.target)) {
                                visorContainer.style.display = 'none';
                                iframe.src = '';
                            }
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
