<?php
/**
 * MOVINGENIA - Configuración General
 * 
 * Carga variables de entorno desde .env (si existe)
 * o usa valores por defecto para desarrollo local
 */

// Cargar .env si existe
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignorar comentarios
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        // Parsear variable=valor
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // No sobrescribir si ya existe en $_ENV
            if (!isset($_ENV[$key])) {
                $_ENV[$key] = $value;
                putenv("$key=$value");
            }
        }
    }
}

// Helper para obtener variable de entorno con valor por defecto
if (!function_exists('env')) {
    function env($key, $default = null) {
        return $_ENV[$key] ?? getenv($key) ?: $default;
    }
}

// Configuración de la aplicación
return [
    'app' => [
        'name' => 'MOVINGENIA API',
        'version' => env('API_VERSION', 'v1'),
        'env' => env('APP_ENV', 'development'),
        'debug' => env('APP_DEBUG', 'true') === 'true',
    ],
    
    'database' => [
        'driver' => env('DB_CONNECTION', 'sqlite'),
        'host' => env('DB_HOST', 'localhost'),
        'port' => env('DB_PORT', '5432'),
        'database' => env('DB_DATABASE', '/workspaces/movingenia-web/api/database.sqlite'),
        'username' => env('DB_USERNAME', ''),
        'password' => env('DB_PASSWORD', ''),
        'charset' => 'utf8',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    ],
    
    'cors' => [
        'allowed_origins' => env('CORS_ALLOWED_ORIGINS', '*'),
        'allowed_methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        'allowed_headers' => 'Content-Type, Authorization',
    ],
];
