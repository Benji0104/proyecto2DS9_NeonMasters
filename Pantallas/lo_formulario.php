<?php
// Conexiones independientes
$conexion_personal = new mysqli('localhost', 'root', '', 'Datos_personales');
$conexion_academico = new mysqli('localhost', 'root', '', 'Academico');

// Verificar conexiones
if ($conexion_personal->connect_error || $conexion_academico->connect_error) {
    die("Error de conexión a las bases de datos.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar datos personales
    $cedula = $_POST['cedula'];
    $nombre1 = $_POST['nombre1'];
    $nombre2 = $_POST['nombre2'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $fecha_nacimiento = $_POST['nacimiento'];
    $sexo = $_POST['sexo'];
    $estado_civil = $_POST['estado'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $provincia = $_POST['provincia'];
    $distrito = $_POST['distrito'];
    $corregimiento = $_POST['corregimiento'];

    // Capturar datos académicos
    $titulo = $_POST['titulo'];
    $archivo_nombre = '';

    // Procesar archivo
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === 0) {
        $permitidos = ['pdf', 'jpg', 'jpeg', 'png'];
        $ext = strtolower(pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION));

        if (in_array($ext, $permitidos)) {
            $archivo_nombre = uniqid('titulo_', true) . '.' . $ext;
            $ruta = __DIR__ . '/../uploads/' . $archivo_nombre;
            move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
        } else {
            die("Formato de archivo no permitido.");
        }
    }

    // Insertar en Datos_personales
    $stmt_personal = $conexion_personal->prepare("
        INSERT INTO formulario_datospersonales
        (cedula, nombre1, nombre2, apellido1, apellido2, fecha_nacimiento, sexo, estado_civil, telefono, email, provincia, distrito, corregimiento)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt_personal->bind_param("sssssssssssss", 
        $cedula, $nombre1, $nombre2, $apellido1, $apellido2, $fecha_nacimiento,
        $sexo, $estado_civil, $telefono, $email, $provincia, $distrito, $corregimiento
    );

    // Insertar en Academico
    $stmt_academico = $conexion_academico->prepare("
        INSERT INTO formulario_datosacademico (titulo, archivo_nombre)
        VALUES (?, ?)
    ");

    $stmt_academico->bind_param("ss", $titulo, $archivo_nombre);

    // Ejecutar ambas
    $ok1 = $stmt_personal->execute();
    $ok2 = $stmt_academico->execute();

    if ($ok1 && $ok2) {
        echo "<h2 style='color: lightgreen;'>Datos guardados correctamente en ambas bases de datos.</h2>";
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
