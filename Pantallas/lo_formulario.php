<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../Assets/db/config.php';

    function validarDatosPersonales(array $data): void {
        $sexo = trim($data['sexo'] ?? '');
        if ($sexo !== 'Masculino' && $sexo !== 'Femenino') {
            throw new Exception("Debes seleccionar un sexo válido.");
        }

        $validos_estado = ['Soltero','Casado','Viudo','Divorciado','Unido'];
        if (!in_array($data['estado'] ?? '', $validos_estado, true)) {
            throw new Exception("Estado civil inválido.");
        }
    }

    function insertarDatosPersonales(PDO $db, array $data): int {
        $sql = "INSERT INTO formulario_datospersonales (
            cedula, nombre1, nombre2, apellido1, apellido2, apellido_casada,
            fecha_nacimiento, sexo, estado_civil, telefono, email, provincia, distrito, corregimiento
        ) VALUES (
            :cedula, :nombre1, :nombre2, :apellido1, :apellido2, :apellido_casada,
            :fecha_nacimiento, :sexo, :estado_civil, :telefono, :email, :provincia, :distrito, :corregimiento
        )";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':cedula'           => $data['cedula'],
            ':nombre1'          => $data['nombre1'],
            ':nombre2'          => $data['nombre2'] ?: null,
            ':apellido1'        => $data['apellido1'],
            ':apellido2'        => $data['apellido2'] ?: null,
            ':apellido_casada'  => ($data['sexo'] === 'Femenino' && !empty($data['apellido_casada'])) ? $data['apellido_casada'] : null,
            ':fecha_nacimiento' => $data['nacimiento'],
            ':sexo'             => $data['sexo'],
            ':estado_civil'     => $data['estado'],
            ':telefono'         => $data['telefono'],
            ':email'            => $data['email'],
            ':provincia'        => $data['provincia'],
            ':distrito'         => $data['distrito'],
            ':corregimiento'    => $data['corregimiento'],
        ]);
        return (int)$db->lastInsertId();
    }

    function actualizarEdad(PDO $db, int $id): void {
        $sql = "UPDATE formulario_datospersonales 
                SET edad = TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) 
                WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    function insertarDatosAcademicos(PDO $db, array $titulos, array $archivos, int $id_personal): bool {
        $sql = "INSERT INTO formulario_datosacademico (titulo, archivo, id_personal) VALUES (:titulo, :archivo, :id_personal)";
        $stmt = $db->prepare($sql);

        for ($i = 0; $i < count($titulos); $i++) {
            if (!isset($archivos['error'][$i]) || $archivos['error'][$i] !== UPLOAD_ERR_OK) {
                return false;
            }

            $titulo = $titulos[$i];
            $bin = file_get_contents($archivos['tmp_name'][$i]);

            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $stmt->bindParam(':archivo', $bin, PDO::PARAM_LOB);
            $stmt->bindParam(':id_personal', $id_personal, PDO::PARAM_INT);

            if (!$stmt->execute()) {
                return false;
            }
        }
        return true;
    }

    // --- PROCESO PRINCIPAL ---

    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: formulario.php");
            exit;
        }

        $datos = $_POST;

        validarDatosPersonales($datos);

        $conexion_personal = obtenerConexionPDO('datos_personales');
        $conexion_academico = obtenerConexionPDO('academico');

        $id_personal = insertarDatosPersonales($conexion_personal, $datos);
        actualizarEdad($conexion_personal, $id_personal);

        $titulos = $_POST['titulo'] ?? [];
        $archivos = $_FILES['archivo'] ?? [];

        $ok = insertarDatosAcademicos($conexion_academico, $titulos, $archivos, $id_personal);

        $conexion_personal = null;  // cierra conexión PDO
        $conexion_academico = null;

        if ($ok) {
            header("Location: formulario.php?enviado=1");
        } else {
            header("Location: formulario.php?error=1");
        }
        exit;

    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
