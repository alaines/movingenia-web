<?php
/**
 * MOVINGENIA - Project Controller
 * 
 * Controlador para gestión de proyectos
 */

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Response.php';

class ProjectController {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    /**
     * GET /api/projects
     * Listar todos los proyectos activos
     */
    public function index() {
        // Parámetros de filtro opcionales
        $category = $_GET['category'] ?? null;
        $year = $_GET['year'] ?? null;
        
        $sql = "
            SELECT 
                id,
                title,
                description,
                year,
                category,
                client,
                location,
                image,
                technologies,
                results,
                featured,
                created_at
            FROM projects
            WHERE active = 1
        ";
        
        $params = [];
        
        // Filtro por categoría
        if ($category) {
            $sql .= " AND category = :category";
            $params['category'] = $category;
        }
        
        // Filtro por año
        if ($year && is_numeric($year)) {
            $sql .= " AND year = :year";
            $params['year'] = (int) $year;
        }
        
        $sql .= " ORDER BY year DESC, created_at DESC";
        
        try {
            $projects = $this->db->query($sql, $params);
            
            // Formatear respuesta
            $formatted = array_map(function($project) {
                return $this->formatProject($project);
            }, $projects);
            
            Response::success($formatted);
            
        } catch (Exception $e) {
            error_log('Error in ProjectController::index - ' . $e->getMessage());
            Response::serverError('Error retrieving projects');
        }
    }
    
    /**
     * GET /api/projects/{id}
     * Obtener un proyecto específico
     */
    public function show($params) {
        $id = $params['id'] ?? null;
        
        if (!$id || !is_numeric($id)) {
            Response::error('Invalid project ID', 400);
        }
        
        $sql = "
            SELECT 
                id,
                title,
                description,
                year,
                category,
                client,
                location,
                image,
                technologies,
                results,
                featured,
                created_at
            FROM projects
            WHERE id = :id AND active = 1
        ";
        
        try {
            $project = $this->db->queryOne($sql, ['id' => $id]);
            
            if (!$project) {
                Response::notFound('Project not found');
            }
            
            Response::success($this->formatProject($project));
            
        } catch (Exception $e) {
            error_log('Error in ProjectController::show - ' . $e->getMessage());
            Response::serverError('Error retrieving project');
        }
    }
    
    /**
     * Formatear proyecto para respuesta
     */
    private function formatProject($project) {
        // Decodificar JSON de technologies
        $technologies = $project['technologies'];
        if (is_string($technologies)) {
            $technologies = json_decode($technologies, true);
        }
        
        return [
            'id' => (int) $project['id'],
            'title' => $project['title'],
            'description' => $project['description'],
            'year' => (int) $project['year'],
            'category' => $project['category'],
            'client' => $project['client'] ?? null,
            'location' => $project['location'] ?? null,
            'image' => $project['image'] ? '/uploads/' . $project['image'] : null,
            'technologies' => $technologies ?? [],
            'results' => $project['results'] ?? null,
            'featured' => (bool) $project['featured'],
            'created_at' => $project['created_at'],
        ];
    }
}
