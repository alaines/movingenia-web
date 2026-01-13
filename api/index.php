<?php
/**
 * MOVINGENIA API
 * Entry Point
 * 
 * Router principal para endpoints públicos
 */

// Headers de seguridad
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Autoload manual (sin Composer por ahora)
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/src/Response.php';
require_once __DIR__ . '/src/Router.php';
require_once __DIR__ . '/src/Controllers/TeamController.php';
require_once __DIR__ . '/src/Controllers/ProjectController.php';

// Manejo de errores
set_error_handler(function($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});

set_exception_handler(function($exception) {
    error_log('Uncaught Exception: ' . $exception->getMessage());
    Response::serverError('An unexpected error occurred');
});

// Manejar OPTIONS (preflight CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Crear router
$router = new Router();

// ============================================
// RUTAS DE LA API
// ============================================

// Team endpoints
$router->get('/team', function() {
    $controller = new TeamController();
    $controller->index();
});

$router->get('/team/{id}', function($params) {
    $controller = new TeamController();
    $controller->show($params);
});

// Project endpoints
$router->get('/projects', function() {
    $controller = new ProjectController();
    $controller->index();
});

$router->get('/projects/{id}', function($params) {
    $controller = new ProjectController();
    $controller->show($params);
});

// Health check
$router->get('/health', function() {
    Response::success([
        'status' => 'ok',
        'timestamp' => date('Y-m-d H:i:s'),
        'api_version' => 'v1',
    ]);
});

// Ejecutar router
$router->run();
