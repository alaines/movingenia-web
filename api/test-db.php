<?php
// Test de conexión a base de datos SQLite

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

echo "=== Test de Base de Datos SQLite ===\n\n";

try {
    $db = Database::getInstance();
    echo "✓ Conexión establecida\n\n";
    
    // Test 1: Contar team members
    $count = $db->queryOne("SELECT COUNT(*) as total FROM team_members");
    echo "Team Members: " . $count['total'] . "\n";
    
    // Test 2: Listar team members
    $team = $db->query("SELECT id, name, position FROM team_members WHERE active = 1 ORDER BY display_order");
    echo "\nTeam Members:\n";
    foreach ($team as $member) {
        echo "- {$member['name']} ({$member['position']})\n";
    }
    
    // Test 3: Contar proyectos
    $countProjects = $db->queryOne("SELECT COUNT(*) as total FROM projects");
    echo "\nProyectos: " . $countProjects['total'] . "\n";
    
    // Test 4: Listar proyectos
    $projects = $db->query("SELECT id, title, category, year FROM projects WHERE active = 1 ORDER BY year DESC");
    echo "\nProyectos:\n";
    foreach ($projects as $project) {
        echo "- {$project['title']} ({$project['category']}, {$project['year']})\n";
    }
    
    echo "\n✓ Todos los tests pasaron correctamente\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
