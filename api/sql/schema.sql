-- ============================================
-- MOVINGENIA - Schema PostgreSQL
-- ============================================

-- Tabla de usuarios (para admin - FASE 3)
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de miembros del equipo
CREATE TABLE IF NOT EXISTS team_members (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    role VARCHAR(100) NOT NULL,
    bio TEXT,
    image_path VARCHAR(255),
    display_order INT DEFAULT 0,
    active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Índice para ordenamiento
CREATE INDEX idx_team_order ON team_members(display_order ASC, id ASC);
CREATE INDEX idx_team_active ON team_members(active);

-- Tabla de proyectos
CREATE TABLE IF NOT EXISTS projects (
    id SERIAL PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    summary TEXT NOT NULL,
    description TEXT,
    year INT NOT NULL,
    category VARCHAR(50),
    cover_image VARCHAR(255),
    technologies JSONB,
    active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Índices para proyectos
CREATE INDEX idx_projects_year ON projects(year DESC);
CREATE INDEX idx_projects_active ON projects(active);
CREATE INDEX idx_projects_category ON projects(category);

-- Tabla de mensajes de contacto
CREATE TABLE IF NOT EXISTS contact_messages (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT false,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Índice para mensajes
CREATE INDEX idx_messages_read ON contact_messages(is_read);
CREATE INDEX idx_messages_created ON contact_messages(created_at DESC);

-- Trigger para actualizar updated_at automáticamente
CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ language 'plpgsql';

CREATE TRIGGER update_team_members_updated_at BEFORE UPDATE ON team_members
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

CREATE TRIGGER update_projects_updated_at BEFORE UPDATE ON projects
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

-- Comentarios de documentación
COMMENT ON TABLE team_members IS 'Miembros del equipo MOVINGENIA';
COMMENT ON TABLE projects IS 'Portafolio de proyectos';
COMMENT ON TABLE contact_messages IS 'Mensajes del formulario de contacto';
COMMENT ON TABLE users IS 'Usuarios administradores (FASE 3)';
