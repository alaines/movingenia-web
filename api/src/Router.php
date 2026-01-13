<?php
/**
 * MOVINGENIA - Router Simple
 * 
 * Enrutador básico para API REST
 */

class Router {
    private $routes = [];
    
    /**
     * Registrar ruta GET
     */
    public function get($path, $callback) {
        $this->addRoute('GET', $path, $callback);
    }
    
    /**
     * Registrar ruta POST
     */
    public function post($path, $callback) {
        $this->addRoute('POST', $path, $callback);
    }
    
    /**
     * Registrar ruta PUT
     */
    public function put($path, $callback) {
        $this->addRoute('PUT', $path, $callback);
    }
    
    /**
     * Registrar ruta DELETE
     */
    public function delete($path, $callback) {
        $this->addRoute('DELETE', $path, $callback);
    }
    
    /**
     * Agregar ruta
     */
    private function addRoute($method, $path, $callback) {
        // Convertir path a regex
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';
        
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'pattern' => $pattern,
            'callback' => $callback,
        ];
    }
    
    /**
     * Ejecutar router
     */
    public function run() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remover /api/ del path si existe
        $requestUri = preg_replace('#^/api#', '', $requestUri);
        
        // Buscar ruta coincidente
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && preg_match($route['pattern'], $requestUri, $matches)) {
                // Extraer parámetros de URL
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                // Ejecutar callback
                call_user_func_array($route['callback'], [$params]);
                return;
            }
        }
        
        // No se encontró ruta
        Response::notFound('Endpoint not found');
    }
}
