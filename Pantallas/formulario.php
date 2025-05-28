<?php
if (isset($_GET['enviado']) && $_GET['enviado'] == 1) {
    echo "<script>alert('Datos enviados correctamente');</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <script src="/proyecto2/Scripts/validaciones.js"></script>
    <script src="/proyecto2/Scripts/validaciones_form.js" defer></script>
    <link rel="icon" href="../Assets/imagenes/icono.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <link href="../Assets/style/style_f.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-dark" style="background: linear-gradient(135deg, #8a2be2, #4b0082); box-shadow: 0 0 15px #8a2be2;">
        <div class="container-fluid">
            <a href="NeonMasters.php" class="navbar-brand mb-0 h1" style="font-family: 'Orbitron', sans-serif; color: #fff; text-shadow: 0 0 10px #e0b0ff; text-decoration: none;">
                Neon Masters
            </a>
        </div>
    </nav>

    <main class="flex-fill d-flex justify-content-center align-items-start px-3">
        <div class="formulario-container w-100">
            <h2 class="text-center form-section-title">Solicitud de empleo</h2>

            <form id="formulario" action="lo_formulario.php" method="POST" enctype="multipart/form-data">
                <fieldset class="mb-4">
                    <legend class="form-section-title fs-4">Datos Personales</legend>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="cedula" class="form-label">Cédula</label>
                            <input type="text" id="cedula" name="cedula" class="form-control" maxlength="11"
                                onkeypress="validarPEN(event, this)" oninput="validarPENPegado(this)" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" id="telefono" name="telefono" class="form-control" maxlength="9"
                                onkeypress="soloNumerosYGuion(event)" placeholder="6770-2949" 
                                oninput="validarTelefono(this)" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre1" class="form-label">Primer Nombre</label>
                            <input type="text" id="nombre1" name="nombre1" class="form-control"
                                onkeypress="soloLetrasConAcentos(event)" onblur="primeraLetraMayuscula(this)" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre2" class="form-label">Segundo Nombre</label>
                            <input type="text" id="nombre2" name="nombre2" class="form-control"
                                onkeypress="soloLetrasConAcentos(event)" onblur="primeraLetraMayuscula(this)">
                        </div>
                        <div class="col-md-6">
                            <label for="apellido1" class="form-label">Primer Apellido</label>
                            <input type="text" id="apellido1" name="apellido1" class="form-control"
                                onkeypress="soloLetrasConAcentos(event)" onblur="primeraLetraMayuscula(this)" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido2" class="form-label">Segundo Apellido</label>
                            <input type="text" id="apellido2" name="apellido2" class="form-control"
                                onkeypress="soloLetrasConAcentos(event)" onblur="primeraLetraMayuscula(this)">
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

                        <div class="col-md-6" id="apellidoCasadaContainer" style="display: none;">
                            <label for="apellido_casada" class="form-label">Apellido de casada</label>
                            <input type="text" class="form-control" id="apellido_casada" name="apellido_casada"
                                onkeypress="soloLetrasConAcentos(event)">
                                <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="usa_apellido_casada" name="usa_apellido_casada">
                                <label class="form-check-label" for="usa_apellido_casada">
                                    ¿Usa el apellido de casada?
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control"
                                onblur="validarEmail(this)" required>
                        </div>
                        <div class="col-md-4">
                            <label for="provincia" class="form-label">Provincia</label>
                            <select id="provincia" name="provincia" class="form-select" required>
                                <option value="">Selecciona</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="distrito" class="form-label">Distrito</label>
                            <select id="distrito" name="distrito" class="form-select" required>
                                <option value="">Selecciona</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="corregimiento" class="form-label">Corregimiento</label>
                            <select id="corregimiento" name="corregimiento" class="form-select" required>
                                <option value="">Selecciona</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="mb-4">
                    <legend class="form-section-title fs-4">Datos Académicos</legend>

                    <div id="bloque-academico">
                        <div class="row g-3 bloque-titulo align-items-end">
                            <div class="col-md-8">
                                <label for="titulo_1" class="form-label">Nombre del Título</label>
                                <input type="text" id="titulo_1" name="titulo[]" class="form-control titulo-input" required>
                            </div>
                            <div class="col-md-3">
                                <label for="archivo_1" class="form-label">Seleccionar Archivo</label>
                                <input type="file" id="archivo_1" name="archivo[]" class="form-control archivo-input"
                                    accept=".pdf,.jpg,.png" required>
                            </div>
                            <div class="col-md-1 text-end">
                                <!-- Sin botón eliminar en el primer bloque -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-end mt-3">
                            <button type="button" class="btn btn-sm btn-neon" id="quitarTitulo">−</button>
                            <button type="button" class="btn btn-sm btn-neon" id="agregarTitulo">+</button>
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
</body>
</html>
