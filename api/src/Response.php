<?php
/**
 * MOVINGENIA - Response Helper
 * 
 * Clase para generar respuestas JSON consistentes
 */

class Response {
    /**
     * Respuesta exitosa
     */
    public static function success($data, $message = null, $statusCode = 200) {
        self::setHeaders($statusCode);
        
        $response = [
            'success' => true,
            'data' => $data,
        ];
        
        if (is_array($data) && !self::isAssoc($data)) {
            $response['count'] = count($data);
        }
        
        if ($message) {
            $response['message'] = $message;
        }
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }
    
    /**
     * Respuesta de error
     */
    public static function error($message, $statusCode = 400, $errors = null) {
        self::setHeaders($statusCode);
        
        $response = [
            'success' => false,
            'error' => $message,
            'code' => $statusCode,
        ];
        
        if ($errors) {
            $response['errors'] = $errors;
        }
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    /**
     * Not Found 404
     */
    public static function notFound($message = 'Resource not found') {
        self::error($message, 404);
    }
    
    /**
     * Method Not Allowed 405
     */
    public static function methodNotAllowed($allowedMethods = []) {
        header('Allow: ' . implode(', ', $allowedMethods));
        self::error('Method not allowed', 405);
    }
    
    /**
     * Internal Server Error 500
     */
    public static function serverError($message = 'Internal server error') {
        self::error($message, 500);
    }
    
    /**
     * Establecer headers HTTP
     */
    private static function setHeaders($statusCode) {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        
        // CORS headers (si es necesario)
        $config = require __DIR__ . '/../config/config.php';
        $cors = $config['cors'];
        
        header('Access-Control-Allow-Origin: ' . $cors['allowed_origins']);
        header('Access-Control-Allow-Methods: ' . $cors['allowed_methods']);
        header('Access-Control-Allow-Headers: ' . $cors['allowed_headers']);
    }
    
    /**
     * Verificar si un array es asociativo
     */
    private static function isAssoc($array) {
        if (!is_array($array)) {
            return false;
        }
        return array_keys($array) !== range(0, count($array) - 1);
    }
}
