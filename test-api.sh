#!/bin/bash
# Script para testear API de MOVINGENIA

echo "🧪 TESTING MOVINGENIA API"
echo "========================="
echo ""

# Configurar colores
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

API_URL="http://localhost:8000"

# Función para testear endpoint
test_endpoint() {
    local method=$1
    local endpoint=$2
    local name=$3
    
    echo -n "Testing ${name}... "
    
    response=$(curl -s -w "\n%{http_code}" "${API_URL}${endpoint}" 2>/dev/null)
    http_code=$(echo "$response" | tail -n1)
    body=$(echo "$response" | sed '$d')
    
    if [ "$http_code" = "200" ]; then
        echo -e "${GREEN}✓ OK${NC} (HTTP $http_code)"
        echo "$body" | python3 -m json.tool 2>/dev/null || echo "$body"
        echo ""
    else
        echo -e "${RED}✗ FAIL${NC} (HTTP $http_code)"
        echo "$body"
        echo ""
    fi
}

# Verificar que el servidor esté corriendo
echo "Verificando servidor PHP..."
if ! curl -s http://localhost:8000 > /dev/null 2>&1; then
    echo -e "${RED}ERROR: Servidor no está corriendo en puerto 8000${NC}"
    echo "Ejecuta: php -S localhost:8000 -t api/"
    exit 1
fi
echo -e "${GREEN}✓ Servidor activo${NC}"
echo ""

# Tests
echo "ENDPOINTS PÚBLICOS"
echo "------------------"

test_endpoint "GET" "/health" "Health Check"
test_endpoint "GET" "/team" "Team List"
test_endpoint "GET" "/team/1" "Team Member #1"
test_endpoint "GET" "/projects" "Projects List"
test_endpoint "GET" "/projects/1" "Project #1"
test_endpoint "GET" "/projects?category=ITS" "Projects filtered by ITS"
test_endpoint "GET" "/projects?year=2023" "Projects filtered by 2023"

echo "========================="
echo "✓ Tests completados"
