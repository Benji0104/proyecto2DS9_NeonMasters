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
    <link rel="icon" href="../Assets/imagenes/icono.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: flex;
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
    <nav class="navbar navbar-dark" style="background: linear-gradient(135deg, #8a2be2, #4b0082); box-shadow: 0 0 15px #8a2be2;">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1" style="font-family: 'Orbitron', sans-serif; color: #fff; text-shadow: 0 0 10px #e0b0ff;">
                Neon Masters
            </span>
        </div>
    </nav>

    <main class="flex-fill d-flex justify-content-center align-items-start">
        <div class="formulario-container w-100">
            <h2 class="text-center form-section-title">Formulario de Registro</h2>

            <form id="formulario"action="lo_formulario.php" method="POST" enctype="multipart/form-data">
                <fieldset class="mb-4">
                    <legend class="form-section-title fs-4">Datos Personales</legend>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="cedula" class="form-label">Cédula</label>
                            <input type="text" id="cedula" name="cedula" class="form-control" maxlength="20" onkeypress="validarPEN(event, this)" oninput="validarPENPegado(this)" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" id="telefono" name="telefono" class="form-control" maxlength="9" onkeypress="soloNumerosYGuion(event)" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre1" class="form-label">Primer Nombre</label>
                            <input type="text" id="nombre1" name="nombre1" class="form-control" onkeypress="soloLetrasConAcentos(event)" onblur="primeraLetraMayuscula(this)" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre2" class="form-label">Segundo Nombre</label>
                            <input type="text" id="nombre2" name="nombre2" class="form-control" onkeypress="soloLetrasConAcentos(event)" onblur="primeraLetraMayuscula(this)">
                        </div>
                        <div class="col-md-6">
                            <label for="apellido1" class="form-label">Primer Apellido</label>
                            <input type="text" id="apellido1" name="apellido1" class="form-control" onkeypress="soloLetrasConAcentos(event)" onblur="primeraLetraMayuscula(this)" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido2" class="form-label">Segundo Apellido</label>
                            <input type="text" id="apellido2" name="apellido2" class="form-control" onkeypress="soloLetrasConAcentos(event)" onblur="primeraLetraMayuscula(this)">
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
                            <input type="text" class="form-control" id="apellido_casada" name="apellido_casada" onkeypress="soloLetrasConAcentos(event)">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" onblur="validarEmail(this)" required>
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
                            <div class="col-md-4">
                                <label for="archivo_1" class="form-label">Seleccionar Archivo</label>
                                <input type="file" id="archivo_1" name="archivo[]" class="form-control archivo-input" accept=".pdf,.jpg,.png" required>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-2">
                        <button type="button" class="btn btn-sm btn-light" id="agregarTitulo">+</button>
                    </div>
                </fieldset>


                <div class="text-center">
                    <button type="submit" class="btn btn-neon px-5">Enviar</button>
                </div>
                    <script>form.onsubmit = function () {
                         return validarPEFinal(document.getElementById("cedula"));
                            };
                     </script>
            </form>
        </div>
    </main>

    <footer class="mt-auto">
        <div class="container">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> Neon Masters. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        //Campo dinámico si la mujer es casada
        document.addEventListener("DOMContentLoaded", function () {
            const sexo = document.getElementById("sexo");
            const estado = document.getElementById("estado");
            const apellidoCasadaContainer = document.getElementById("apellidoCasadaContainer");

            function actualizarCampoCasada() {
                if (sexo.value === "Femenino" && estado.value === "Casado") {
                    apellidoCasadaContainer.style.display = "block";
                } else {
                    apellidoCasadaContainer.style.display = "none";
                    document.getElementById("apellido_casada").value = '';
                }
            }

            sexo.addEventListener("change", actualizarCampoCasada);
            estado.addEventListener("change", actualizarCampoCasada);
        });
    </script>

    <script>
        //Para jalar los datos de provincias.json
        document.addEventListener("DOMContentLoaded", function () {
            const provinciasSelect = document.getElementById("provincia");
            const distritoSelect = document.getElementById("distrito");
            const corregimientoSelect = document.getElementById("corregimiento");

            fetch("../Assets/data/provincias.json")
                .then(response => response.json())
                .then(data => {
                    data.provincia.forEach(prov => {
                        const option = document.createElement("option");
                        option.value = prov.nombre;
                        option.textContent = prov.nombre;
                        provinciasSelect.appendChild(option);
                    });

                    provinciasSelect.addEventListener("change", () => {
                        distritoSelect.innerHTML = '<option value="">Selecciona</option>';
                        corregimientoSelect.innerHTML = '<option value="">Selecciona</option>';

                        const provincia = data.provincia.find(p => p.nombre === provinciasSelect.value);
                        if (provincia) {
                            provincia.distrito.forEach(dist => {
                                const option = document.createElement("option");
                                option.value = dist.nombre;
                                option.textContent = dist.nombre;
                                distritoSelect.appendChild(option);
                            });
                        }
                    });

                    distritoSelect.addEventListener("change", () => {
                        corregimientoSelect.innerHTML = '<option value="">Selecciona</option>';
                        const provincia = data.provincia.find(p => p.nombre === provinciasSelect.value);
                        if (provincia) {
                            const distrito = provincia.distrito.find(d => d.nombre === distritoSelect.value);
                            if (distrito) {
                                distrito.corregimientos.forEach(correg => {
                                    const option = document.createElement("option");
                                    option.value = correg;
                                    option.textContent = correg;
                                    corregimientoSelect.appendChild(option);
                                });
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error("Error al cargar provincias.json:", error);
                });
        });
    </script>

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

    <script>
        //Añadir bloque en datos academicos
        document.addEventListener("DOMContentLoaded", function () {
            let contador = 1;

            document.getElementById("agregarTitulo").addEventListener("click", function () {
                contador++;

                const bloque = document.createElement("div");
                bloque.classList.add("row", "g-3", "bloque-titulo", "align-items-end", "mt-3");

                bloque.innerHTML = `
                    <div class="col-md-8">
                        <label for="titulo_${contador}" class="form-label">Nombre del Título</label>
                        <input type="text" id="titulo_${contador}" name="titulo[]" class="form-control titulo-input" required>
                    </div>
                    <div class="col-md-4">
                        <label for="archivo_${contador}" class="form-label">Seleccionar Archivo</label>
                        <input type="file" id="archivo_${contador}" name="archivo[]" class="form-control archivo-input" accept=".pdf,.jpg,.png" required>
                    </div>
                `;

              
                document.getElementById("bloque-academico").appendChild(bloque);
            });

            // Delegación para validar en cualquier input .titulo-input nuevo o existente
            document.getElementById("bloque-academico").addEventListener("keypress", function(event) {
                if (event.target.classList.contains("titulo-input")) {
                    soloLetrasConAcentos(event);
                }
            });
        });
    </script>
</body>
</html>
