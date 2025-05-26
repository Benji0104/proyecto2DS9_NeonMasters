<?php
require __DIR__ . '/../Assets/db/config.php';

$datos = null;
$mensaje = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tipo'], $_GET['valor']) && $_GET['valor'] !== '') {
    $tipo = $_GET['tipo'];
    $valor = trim($_GET['valor']);

    // Validaciones básicas
    if ($tipo === 'id' && !is_numeric($valor)) {
        $mensaje = "El ID debe ser un número válido.";
    } elseif ($tipo === 'cedula' && !preg_match('/^[0-9\-]+$/', $valor)) {
        $mensaje = "La cédula solo debe contener números y guiones.";
    } else {
        // Conectar a ambas bases
        $conn_personal = new mysqli('localhost', 'root', '', 'Datos_personales');
        $conn_academico = new mysqli('localhost', 'root', '', 'Academico');

        if ($conn_personal->connect_error || $conn_academico->connect_error) {
            $mensaje = "Error de conexión a las bases de datos.";
        } else {
            // Consulta por tipo
            if ($tipo === 'id') {
                $stmt_personal = $conn_personal->prepare("SELECT * FROM formulario_datospersonales WHERE id = ?");
                $stmt_academico = $conn_academico->prepare("SELECT * FROM formulario_datosacademico WHERE id = ?");
                $stmt_personal->bind_param("i", $valor);
                $stmt_academico->bind_param("i", $valor);
            } else {
                $stmt_personal = $conn_personal->prepare("SELECT * FROM formulario_datospersonales WHERE cedula = ?");
                $stmt_academico = $conn_academico->prepare("SELECT * FROM formulario_datosacademico WHERE cedula = ?");
                $stmt_personal->bind_param("s", $valor);
                $stmt_academico->bind_param("s", $valor);
            }

            $stmt_personal->execute();
            $result_personal = $stmt_personal->get_result();
            $stmt_academico->execute();
            $result_academico = $stmt_academico->get_result();

            if ($row_personal = $result_personal->fetch_assoc()) {
                $row_academico = $result_academico->fetch_assoc();

                $datos = [
                    'cedula' => $row_personal['cedula'],
                    'nombre' => $row_personal['nombre1'] . ' ' . $row_personal['nombre2'] . ' ' . $row_personal['apellido1'] . ' ' . $row_personal['apellido2'],
                    'fecha_nacimiento' => $row_personal['fecha_nacimiento'],
                    'edad' => date_diff(date_create($row_personal['fecha_nacimiento']), date_create())->y,
                    'sexo' => $row_personal['sexo'],
                    'telefono' => $row_personal['telefono'],
                    'provincia' => $row_personal['provincia'],
                    'titulo' => $row_academico['titulo'] ?? '',
                    'archivo' => $row_academico['archivo_nombre'] ?? ''
                ];
            } else {
                $mensaje = "No se encontró información con el valor ingresado.";
            }

            $stmt_personal->close();
            $stmt_academico->close();
            $conn_personal->close();
            $conn_academico->close();
        }
    }
} else {
    $mensaje = "Ingrese un valor para buscar.";
}
