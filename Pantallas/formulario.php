<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="icon" href="../Assets/imagenes/icono.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 130%;
            margin: 0;
            background: radial-gradient(circle at top left, #0f0c29, #302b63, #24243e);
            color: #fff;
            font-family: 'Orbitron', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .formulario-container {
            background-color: rgba(20, 20, 35, 0.95);
            border-radius: 15px;
            padding: 40px;
            margin: 30px auto;
            box-shadow: 0 0 20px rgba(138, 43, 226, 0.8);
            max-width: 900px;
        }

        .form-section-title {
            color: #e0b0ff;
            text-shadow: 0 0 10px #8a2be2;
            margin-bottom: 20px;
        }

        label {
            color: #ccc;
        }

        .form-control, .form-select {
            background-color: #1f1f2e;
            color: #fff;
            border: 1px solid #8a2be2;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 10px #8a2be2;
            border-color: #e0b0ff;
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

        footer {
            text-align: center;
            padding: 1rem;
            color: #ccccff;
            text-shadow: 0 0 10px #8a2be2;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <main class="flex-fill d-flex justify-content-center align-items-start">
        <div class="formulario-container w-100">
            <h2 class="text-center form-section-title">Formulario de Registro</h2>

            <form action="lo_formulario.php" method="POST" enctype="multipart/form-data">
                <fieldset class="mb-4">
                    <legend class="form-section-title fs-4">Datos Personales</legend>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="cedula" class="form-label">Cédula</label>
                            <input type="text" id="cedula" name="cedula" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" id="telefono" name="telefono" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre1" class="form-label">Primer Nombre</label>
                            <input type="text" id="nombre1" name="nombre1" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre2" class="form-label">Segundo Nombre</label>
                            <input type="text" id="nombre2" name="nombre2" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="apellido1" class="form-label">Primer Apellido</label>
                            <input type="text" id="apellido1" name="apellido1" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido2" class="form-label">Segundo Apellido</label>
                            <input type="text" id="apellido2" name="apellido2" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" id="nacimiento" name="nacimiento" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="text" id="edad" name="edad" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="sexo" class="form-label">Sexo</label>
                            <select id="sexo" name="sexo" class="form-select" required>
                                <option value="">Selecciona</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="estado" class="form-label">Estado Civil</label>
                            <select id="estado" name="estado" class="form-select" required>
                                <option value="">Selecciona</option>
                                <option value="Soltero">Soltero</option>
                                <option value="Casado">Casado</option>
                                <option value="Viudo">Viudo</option>
                                <option value="Divorciado">Divorciado</option>
                                <option value="Unido">Unido</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="provincia" class="form-label">Provincia</label>
                            <select id="provincia" name="provincia" class="form-select" required>
                                <option value="">Selecciona</option>
                                <option value="Panamá">Panamá</option>
                                <option value="Colón">Colón</option>
                                <option value="Chiriquí">Chiriquí</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="distrito" class="form-label">Distrito</label>
                            <select id="distrito" name="distrito" class="form-select" required>
                                <option value="">Selecciona</option>
                                <option value="Distrito 1">Distrito 1</option>
                                <option value="Distrito 2">Distrito 2</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="corregimiento" class="form-label">Corregimiento</label>
                            <select id="corregimiento" name="corregimiento" class="form-select" required>
                                <option value="">Selecciona</option>
                                <option value="Corregimiento 1">Corregimiento 1</option>
                                <option value="Corregimiento 2">Corregimiento 2</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="mb-4">
                    <legend class="form-section-title fs-4">Datos Académicos</legend>
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="titulo" class="form-label">Nombre del Título</label>
                            <input type="text" id="titulo" name="titulo" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="archivo" class="form-label">Seleccionar Archivo</label>
                            <input type="file" id="archivo" name="archivo" class="form-control" accept=".pdf,.jpg,.png" required>
                        </div>
                    </div>
                </fieldset>

                <div class="text-center">
                    <button type="submit" class="btn btn-neon px-5">Enviar</button>
                </div>
            </form>
        </div>
    </main>

    <footer class="mt-auto">
        <div class="container">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> Neon Masters. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        // Calcular edad en tiempo real
        document.getElementById('nacimiento').addEventListener('change', function () {
            const fechaNacimiento = new Date(this.value);
            const hoy = new Date();
            let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
            const m = hoy.getMonth() - fechaNacimiento.getMonth();
            if (m < 0 || (m === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                edad--;
            }
            document.getElementById('edad').value = edad;
        });
    </script>
</body>
</html>
