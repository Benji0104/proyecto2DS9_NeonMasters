<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexiones independientes
$conexion_personal = new mysqli('localhost', 'root', '', 'Datos_personales');
$conexion_academico = new mysqli('localhost', 'root', '', 'Academico');

// Verificar conexiones
if ($conexion_personal->connect_error || $conexion_academico->connect_error) {
    die("Error de conexión a las bases de datos.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos personales
    $cedula = $_POST['cedula'];
    $nombre1 = $_POST['nombre1'];
    $nombre2 = $_POST['nombre2'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $fecha_nacimiento = $_POST['nacimiento'];  // formato YYYY-MM-DD
    $sexo = $_POST['sexo'];
    $estado_civil = $_POST['estado'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $provincia = $_POST['provincia'];
    $distrito = $_POST['distrito'];
    $corregimiento = $_POST['corregimiento'];

    $apellido_casada = ($sexo === 'Femenino' && $estado_civil === 'Casado' && !empty($_POST['apellido_casada']))
        ? $_POST['apellido_casada']
        : null;

    // Calcular la edad en años basado en la fecha de nacimiento
    $fecha_nac_dt = new DateTime($fecha_nacimiento);
    $hoy = new DateTime();
    $edad = $hoy->diff($fecha_nac_dt)->y; // diferencia en años

    // Insertar en Datos_personales (añadido campo edad)
    $stmt_personal = $conexion_personal->prepare("
        INSERT INTO formulario_datospersonales 
        (cedula, nombre1, nombre2, apellido1, apellido2, fecha_nacimiento, edad, sexo, estado_civil, telefono, email, provincia, distrito, corregimiento, apellido_casada)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt_personal->bind_param("sssssisisssssss", 
        $cedula, $nombre1, $nombre2, $apellido1, $apellido2, $fecha_nacimiento, $edad,
        $sexo, $estado_civil, $telefono, $email, $provincia, $distrito, $corregimiento,
        $apellido_casada
    );

    $ok1 = $stmt_personal->execute();

    // Procesar datos académicos con múltiples títulos y archivos
    $titulos = $_POST['titulo'];  // Array de títulos
    $archivos = $_FILES['archivo']; // Array de archivos

    // Preparar statement para insertar datos académicos
    $stmt_academico = $conexion_academico->prepare("
        INSERT INTO formulario_datosacademico (titulo, archivo, fecha_registro) VALUES (?, ?, NOW())
    ");

    // Verificar que preparación fue correcta
    if (!$stmt_academico) {
        die("Error en la preparación de consulta académica: " . $conexion_academico->error);
    }

    // Recorrer todos los títulos y archivos
    $ok2 = true;
    for ($i = 0; $i < count($titulos); $i++) {
        $titulo_actual = $titulos[$i];

        // Validar archivo en la posición $i
        if (isset($archivos['error'][$i]) && $archivos['error'][$i] === 0) {
            // Validar extensión permitida
            $permitidos = ['pdf', 'jpg', 'jpeg', 'png'];
            $ext = strtolower(pathinfo($archivos['name'][$i], PATHINFO_EXTENSION));

            if (!in_array($ext, $permitidos)) {
                die("Tipo de archivo no permitido en archivo #" . ($i+1));
            }

            // Obtener contenido binario del archivo
            $contenido_binario = file_get_contents($archivos['tmp_name'][$i]);

            // Bind y execute para cada registro académico
            $stmt_academico->bind_param("sb", $titulo_actual, $null); // "sb" = string y blob
            $stmt_academico->send_long_data(1, $contenido_binario); // índice 1 = segundo parámetro (archivo)
            $ok2 = $ok2 && $stmt_academico->execute();

            if (!$ok2) {
                die("Error al guardar archivo académico #" . ($i+1));
            }
        } else {
            die("Debe adjuntar todos los archivos correctamente.");
        }
    }

    if ($ok1 && $ok2) {
        header("Location: formulario.php?enviado=1");
        exit;
    } else {
        echo "<h2 style='color: red;'>Error al guardar en la base de datos.</h2>";
    }

    $stmt_personal->close();
    $stmt_academico->close();
    $conexion_personal->close();
    $conexion_academico->close();

} else {
    header("Location: formulario.php");
    exit;
}


