<?php
function obtenerConexionPDO(
    $base = 'usuario', 
    $host = 'localhost',    //IP o nombre del servidor
    $user = 'root',         //Nombre de usuario
    $pass = '',             //Contraseña
    $motor = 'mysql'  // Puede ser: 'mysql', 'pgsql', 'sqlite', etc.
) {
    // Mapeo de nombres lógicos de bases de datos
    switch (strtolower($base)) {
        case 'usuario':
            $db = 'Usuario';
            break;
        case 'datos_personales':
            $db = 'Datos_personales';
            break;
        case 'academico':
            $db = 'Academico';
            break;
        default:
            $db = $base;
            break;
    }

    try {
        // Selección de DSN (Data Source Name) según el motor
        switch (strtolower($motor)) {
            case 'mysql':
                $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
                break;
            case 'pgsql':
                $dsn = "pgsql:host=$host;dbname=$db";
                break;
            case 'sqlite':
                // Para SQLite, $db debería ser la ruta al archivo `.sqlite`
                $dsn = "sqlite:$db";
                $user = null;
                $pass = null;
                break;
            default:
                throw new Exception("Motor de base de datos no soportado: $motor");
        }

        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;

    } catch (PDOException $e) {
        die("❌ Error de conexión ($motor): " . $e->getMessage());
    } catch (Exception $e) {
        die("⚠️ Error: " . $e->getMessage());
    }
}
?>
