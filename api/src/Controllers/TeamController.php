<?php
/**
 * MOVINGENIA - Team Controller
 * 
 * Controlador para gestión de equipo
 */

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Response.php';

class TeamController {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    /**
     * GET /api/team
     * Listar todos los miembros activos del equipo
     */
    public function index() {
        $sql = "
            SELECT 
                id,
                name,
                position,
                bio,
                image,
                email,
                linkedin,
                display_order
            FROM team_members
            WHERE active = 1
            ORDER BY display_order ASC, id ASC
        ";
        
        try {
            $team = $this->db->query($sql);
            
            // Formatear respuesta
            $formatted = array_map(function($member) {
                return [
                    'id' => (int) $member['id'],
                    'name' => $member['name'],
                    'position' => $member['position'],
                    'bio' => $member['bio'],
                    'image' => $member['image'] ? '/uploads/' . $member['image'] : null,
                    'email' => $member['email'],
                    'linkedin' => $member['linkedin'],
                    'order' => (int) $member['display_order'],
                ];
            }, $team);
            
            Response::success($formatted, count($formatted));
            
        } catch (Exception $e) {
            error_log('Error in TeamController::index - ' . $e->getMessage());
            Response::serverError('Error retrieving team members');
        }
    }
    
    /**
     * GET /api/team/{id}
     * Obtener un miembro específico
     */
    public function show($params) {
        $id = $params['id'] ?? null;
        
        if (!$id || !is_numeric($id)) {
            Response::error('Invalid team member ID', 400);
        }
        
        $sql = "
            SELECT 
                id,
                name,
                position,
                bio,
                image,
                email,
                linkedin,
                display_order
            FROM team_members
            WHERE id = :id AND active = 1
        ";
        
        try {
            $member = $this->db->queryOne($sql, ['id' => $id]);
            
            if (!$member) {
                Response::notFound('Team member not found');
            }
            
            $formatted = [
                'id' => (int) $member['id'],
                'name' => $member['name'],
                'position' => $member['position'],
                'bio' => $member['bio'],
                'image' => $member['image'] ? '/uploads/' . $member['image'] : null,
                'email' => $member['email'],
                'linkedin' => $member['linkedin'],
                'order' => (int) $member['display_order'],
            ];
            
            Response::success($formatted);
            
        } catch (Exception $e) {
            error_log('Error in TeamController::show - ' . $e->getMessage());
            Response::serverError('Error retrieving team member');
        }
    }
}
