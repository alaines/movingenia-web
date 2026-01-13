#!/bin/bash
# Start API Server para desarrollo
# Este script inicia el servidor PHP con routing correcto

echo "🚀 Iniciando MOVINGENIA API Server..."
echo ""
echo "URL: http://localhost:8000"
echo "Presiona Ctrl+C para detener"
echo ""

cd "$(dirname "$0")/api"

# Usando router.php para simular mod_rewrite
if [ ! -f "router.php" ]; then
    echo "⚠️  Creando router.php..."
    cat > router.php << 'EOF'
<?php
// Router para desarrollo PHP built-in server
// Simula mod_rewrite de Apache

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Permitir acceso a archivos estáticos
if ($uri !== '/' && file_exists(__DIR__ . $uri)) {
    return false;
}

// Todo lo demás va a index.php
$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/index.php';
EOF
    echo "✓ router.php creado"
fi

php -S localhost:8000 router.php
