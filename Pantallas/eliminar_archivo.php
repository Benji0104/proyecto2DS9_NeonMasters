<?php
require __DIR__ . '/../Assets/db/config.php';

$pdo = obtenerConexionPDO('academico');
$titulo_id = $_GET['titulo_id'] ?? null;

if ($titulo_id) {
    try {
        $stmt = $pdo->prepare("UPDATE formulario_datosacademico SET archivo = NULL WHERE id = ?");
        $stmt->execute([$titulo_id]);

        if ($stmt->rowCount() > 0) {
            echo "✅ Archivo eliminado correctamente.";
        } else {
            echo "⚠️ No se encontró archivo para eliminar.";
        }
    } catch (PDOException $e) {
        echo "❌ Error de base de datos: " . $e->getMessage();
    }
} else {
    echo "❗ Falta el parámetro 'titulo_id'.";
}
