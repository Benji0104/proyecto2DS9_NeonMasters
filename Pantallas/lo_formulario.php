<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    // 1) Conexión a las bases de datos
    $conexion_personal = new mysqli('localhost', 'root', '', 'Datos_personales');
    $conexion_academico = new mysqli('localhost', 'root', '', 'Academico');
    if ($conexion_personal->connect_error || $conexion_academico->connect_error) {
        die("Error de conexión: " .
            $conexion_personal->connect_error . " / " .
            $conexion_academico->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: formulario.php");
        exit;
    }

    // 2) Captura y validación de datos personales
    $cedula           = $_POST['cedula'];
    $nombre1          = $_POST['nombre1'];
    $nombre2          = $_POST['nombre2'] ?: null;
    $apellido1        = $_POST['apellido1'];
    $apellido2        = $_POST['apellido2'] ?: null;
    $apellido_casada  = null;

    $fecha_nacimiento = $_POST['nacimiento'];      // YYYY-MM-DD

    $sexo = trim($_POST['sexo'] ?? '');
    if ($sexo !== 'Masculino' && $sexo !== 'Femenino') {
        die("Error: Debes seleccionar un sexo válido.");
    }

    $estado_civil = $_POST['estado'] ?? '';
    $validos_estado = ['Soltero','Casado','Viudo','Divorciado','Unido'];
    if (!in_array($estado_civil, $validos_estado, true)) {
        die("Error: Estado civil inválido.");
    }

    if ($sexo === 'Femenino' && !empty($_POST['apellido_casada'])) {
        $apellido_casada = $_POST['apellido_casada'];
    }

    $telefono      = $_POST['telefono'];
    $email         = $_POST['email'];
    $provincia     = $_POST['provincia'];
    $distrito      = $_POST['distrito'];
    $corregimiento = $_POST['corregimiento'];

    // 3) Inserción de datos personales
    $sql = "INSERT INTO formulario_datospersonales (
        cedula, nombre1, nombre2, apellido1, apellido2, apellido_casada,
        fecha_nacimiento, sexo, estado_civil, telefono, email, provincia, distrito, corregimiento
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt_personal = $conexion_personal->prepare($sql);
    if (!$stmt_personal) {
        die("Error al preparar datos personales: " . $conexion_personal->error);
    }

    var_dump($fecha_nacimiento);

    $stmt_personal->bind_param(
        "ssssssssssssss",
        $cedula,
        $nombre1,
        $nombre2,
        $apellido1,
        $apellido2,
        $apellido_casada,
        $fecha_nacimiento,
        $sexo,
        $estado_civil,
        $telefono,
        $email,
        $provincia,
        $distrito,
        $corregimiento
    );

    if (!$stmt_personal->execute()) {
        die("Error al guardar datos personales: " . $stmt_personal->error);
    }

    // Obtener el ID del último insertado
    $lastId = $conexion_personal->insert_id;

    // Calcular edad solo para ese registro
    $sql_update_edad = "UPDATE formulario_datospersonales SET edad = TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) WHERE id = ?";
    $stmt_edad = $conexion_personal->prepare($sql_update_edad);
    if ($stmt_edad) {
        $stmt_edad->bind_param("i", $lastId);
        $stmt_edad->execute();
        $stmt_edad->close();
    }

    $id_personal = $stmt_personal->insert_id;

    $stmt_personal->close();

        // 4) Procesar y guardar datos académicos (múltiples)
        $titulos  = $_POST['titulo'];
        $archivos = $_FILES['archivo'];

        $sqlA = "
            INSERT INTO formulario_datosacademico
            (titulo, archivo, id_personal)
            VALUES (?, ?, ?)
        ";

        $stmt_academico = $conexion_academico->prepare($sqlA);
        if (!$stmt_academico) {
            die("Error al preparar datos académicos: " . $conexion_academico->error);
        }

        $ok2 = true;
        for ($i = 0; $i < count($titulos); $i++) {
            $titulo = $titulos[$i];

            if (!isset($archivos['error'][$i]) || $archivos['error'][$i] !== UPLOAD_ERR_OK) {
                $ok2 = false;
                break;
            }

            $bin = file_get_contents($archivos['tmp_name'][$i]);
            $null = NULL;

            // título, archivo (BLOB), id_personal
            $stmt_academico->bind_param("sbi", $titulo, $null, $id_personal);
            $stmt_academico->send_long_data(1, $bin);

            if (!$stmt_academico->execute()) {
                $ok2 = false;
                break;
            }
        }
        $stmt_academico->close();

    // 5) Cerrar conexiones y redirigir
    $conexion_personal->close();
    $conexion_academico->close();

    if ($ok2) {
        header("Location: formulario.php?enviado=1");
    } else {
        header("Location: formulario.php?error=1");
    }
    exit;
    ?>



