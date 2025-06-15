/**
 * Este código recupera un archivo binario desde una base de datos y lo envía al navegador con su tipo MIME correspondiente.
 * This code retrieves a binary file from a database and sends it to the browser with its corresponding MIME type.
 */
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../Assets/db/config.php';
$pdo = obtenerConexionPDO('academico');


$titulo_id = $_GET['titulo_id'] ?? null;

if ($titulo_id) {
    try {
        $stmt = $pdo->prepare("SELECT archivo FROM formulario_datosacademico WHERE id = ?");
        $stmt->execute([$titulo_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $row['archivo']) {
            // Detectar el tipo MIME del archivo binario
            $finfo = finfo_open();
            $mime = finfo_buffer($finfo, $row['archivo'], FILEINFO_MIME_TYPE);
            finfo_close($finfo);

            header("Content-Type: $mime");
            echo $row['archivo'];
        } else {
            echo "Archivo no encontrado.";
        }
    } catch (PDOException $e) {
        echo "Error al recuperar el archivo: " . $e->getMessage();
    }
} else {
    echo "Parámetro 'titulo_id' no proporcionado.";
}
?>
