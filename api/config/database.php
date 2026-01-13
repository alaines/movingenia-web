<?php
/**
 * MOVINGENIA - Clase Database
 * 
 * Wrapper PDO para conexión a PostgreSQL/MySQL
 * Implementa singleton y prepared statements
 */

class Database {
    private static $instance = null;
    private $connection;
    private $config;
    
    /**
     * Constructor privado (Singleton)
     */
    private function __construct() {
        $this->config = require __DIR__ . '/config.php';
        $this->connect();
    }
    
    /**
     * Obtener instancia única
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Conectar a la base de datos
     */
    private function connect() {
        $db = $this->config['database'];
        
        try {
            // Construir DSN según el driver
            if ($db['driver'] === 'sqlite') {
                $dsn = sprintf('sqlite:%s', $db['database']);
                $username = null;
                $password = null;
            } else {
                $dsn = sprintf(
                    '%s:host=%s;port=%s;dbname=%s',
                    $db['driver'],
                    $db['host'],
                    $db['port'],
                    $db['database']
                );
                $username = $db['username'];
                $password = $db['password'];
            }
            
            $this->connection = new PDO(
                $dsn,
                $username,
                $password,
                $db['options']
            );
            
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }
    
    /**
     * Obtener conexión PDO
     */
    public function getConnection() {
        return $this->connection;
    }
    
    /**
     * Ejecutar query SELECT
     * 
     * @param string $sql Query SQL con placeholders
     * @param array $params Parámetros para bind
     * @return array Resultados
     */
    public function query($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $this->handleError($e);
            return [];
        }
    }
    
    /**
     * Ejecutar query que devuelve una sola fila
     * 
     * @param string $sql Query SQL
     * @param array $params Parámetros
     * @return array|null Fila o null
     */
    public function queryOne($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetch();
            return $result ?: null;
        } catch (PDOException $e) {
            $this->handleError($e);
            return null;
        }
    }
    
    /**
     * Ejecutar INSERT/UPDATE/DELETE
     * 
     * @param string $sql Query SQL
     * @param array $params Parámetros
     * @return bool Success
     */
    public function execute($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            $this->handleError($e);
            return false;
        }
    }
    
    /**
     * Obtener último ID insertado
     */
    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }
    
    /**
     * Iniciar transacción
     */
    public function beginTransaction() {
        return $this->connection->beginTransaction();
    }
    
    /**
     * Commit transacción
     */
    public function commit() {
        return $this->connection->commit();
    }
    
    /**
     * Rollback transacción
     */
    public function rollback() {
        return $this->connection->rollBack();
    }
    
    /**
     * Manejo de errores
     */
    private function handleError(PDOException $e) {
        $config = $this->config['app'];
        
        // En desarrollo mostrar error completo
        if ($config['debug']) {
            error_log('Database Error: ' . $e->getMessage());
            throw $e;
        }
        
        // En producción solo log
        error_log('Database Error: ' . $e->getMessage());
        throw new Exception('Database error occurred');
    }
    
    /**
     * Prevenir clonación
     */
    private function __clone() {}
    
    /**
     * Prevenir unserialize
     */
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}
