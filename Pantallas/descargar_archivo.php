<?php
require __DIR__ . '/../Assets/db/config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID inválido.');
}

$id = (int) $_GET['id'];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=Academico;charset=utf8", 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $stmt = $pdo->prepare("SELECT titulo, archivo FROM formulario_datosacademico WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row || empty($row['archivo'])) {
            die('Archivo no encontrado.');
        }

        $filename = $row['titulo'] ?: 'archivo';
        // Ajusta la extensión si sabes el tipo de archivo guardado; por ejemplo, .pdf o .docx
        $filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $filename) . '.pdf';

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($row['archivo']));
        echo $row['archivo'];
        exit;

    } catch (PDOException $e) {
        die('Error en la base de datos: ' . $e->getMessage());
    }
