<?php
require __DIR__ . '/../Assets/db/config.php';

$tipo = $_GET['tipo'] ?? '';
$valor = $_GET['valor'] ?? '';

    if ($tipo && $valor) {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=Datos_personales;charset=utf8", 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            // Preparar la consulta según el tipo
            if ($tipo === 'id') {
                $stmt = $pdo->prepare("SELECT nombre1, nombre2, apellido1, apellido2, apellido_casada, sexo FROM formulario_datospersonales WHERE id = ?");
            } elseif ($tipo === 'cedula') {
                $stmt = $pdo->prepare("SELECT nombre1, nombre2, apellido1, apellido2, apellido_casada, sexo FROM formulario_datospersonales WHERE cedula = ?");
            } else {
                throw new Exception("Tipo inválido");
            }

            $stmt->execute([$valor]);
            $persona = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($persona) {
                $nombreCompleto = trim($persona['nombre1'] . ' ' . ($persona['nombre2'] ?? '') . ' ' . $persona['apellido1'] . ' ' . ($persona['apellido2'] ?? '') . ' ' . ($persona['apellido_casada'] ?? ''));
            } else {
                echo "<p style='color:red;'>No se encontraron datos.</p>";
                exit;
            }
        } catch (Exception $e) {
            echo "<p style='color:red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
            exit;
        }
    } else {
        echo "<p style='color:orange;'>No se proporcionaron parámetros.</p>";
        exit;
    }
