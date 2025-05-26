<?php require 'lo_visualdatos.php'; ?>
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
    <div class="container dashboard-container">
        <h2 class="text-center mb-4">Buscar Datos</h2>

        <form class="mb-4" method="GET" action="visual_datos.php">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label for="tipo" class="form-label">Buscar por</label>
                    <select name="tipo" id="tipo" class="form-select" required>
                        <option value="id" <?php if ($_GET['tipo'] ?? '' === 'id') echo 'selected'; ?>>ID</option>
                        <option value="cedula" <?php if ($_GET['tipo'] ?? '' === 'cedula') echo 'selected'; ?>>Cédula</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" name="valor" id="valor" class="form-control" placeholder="Ingrese el valor" required value="<?php echo htmlspecialchars($_GET['valor'] ?? ''); ?>">
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
                    <tr><th>Título</th><td><?php echo htmlspecialchars($datos['titulo']); ?></td></tr>
                    <tr><th>Archivo</th><td>
                        <?php if (!empty($datos['archivo'])): ?>
                            <a href="../uploads/<?php echo urlencode($datos['archivo']); ?>" target="_blank" class="text-info">Ver archivo</a>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td></tr>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Neon Masters. Todos los derechos reservados.
    </footer>
</body>
</html>
