-- MOVINGENIA API - SQLite Schema
-- Compatible con SQLite para desarrollo

-- Tabla de usuarios (para admin)
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role TEXT DEFAULT 'admin',
    active INTEGER DEFAULT 1,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP,
    updated_at TEXT DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de miembros del equipo
CREATE TABLE IF NOT EXISTS team_members (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    position TEXT NOT NULL,
    bio TEXT,
    image TEXT,
    email TEXT,
    linkedin TEXT,
    display_order INTEGER DEFAULT 0,
    active INTEGER DEFAULT 1,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP,
    updated_at TEXT DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de proyectos
CREATE TABLE IF NOT EXISTS projects (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT NOT NULL,
    category TEXT NOT NULL,
    client TEXT,
    year INTEGER,
    location TEXT,
    image TEXT,
    technologies TEXT,
    results TEXT,
    active INTEGER DEFAULT 1,
    featured INTEGER DEFAULT 0,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP,
    updated_at TEXT DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de mensajes de contacto
CREATE TABLE IF NOT EXISTS contact_messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    phone TEXT,
    company TEXT,
    subject TEXT NOT NULL,
    message TEXT NOT NULL,
    status TEXT DEFAULT 'new',
    read INTEGER DEFAULT 0,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP,
    updated_at TEXT DEFAULT CURRENT_TIMESTAMP
);

-- Índices
CREATE INDEX IF NOT EXISTS idx_team_display ON team_members(display_order, active);
CREATE INDEX IF NOT EXISTS idx_team_active ON team_members(active);
CREATE INDEX IF NOT EXISTS idx_projects_category ON projects(category, active);
CREATE INDEX IF NOT EXISTS idx_projects_year ON projects(year DESC);
CREATE INDEX IF NOT EXISTS idx_projects_featured ON projects(featured, active);
CREATE INDEX IF NOT EXISTS idx_contacts_status ON contact_messages(status, created_at DESC);

-- Datos de ejemplo
INSERT INTO team_members (name, position, bio, email, display_order, active) VALUES
('Ing. Carlos Miranda', 'Director General', 'Ingeniero Civil con más de 15 años de experiencia en consultoría de transporte y movilidad. Especialista en sistemas ITS y estudios de tráfico.', 'cmiranda@movingenia.pe', 1, 1),
('Ing. María Rodríguez', 'Gerente de Proyectos ITS', 'Ingeniera de Sistemas con especialización en ITS y Smart Cities. Lideró la implementación de sistemas de gestión de tráfico en Lima.', 'mrodriguez@movingenia.pe', 2, 1),
('Arq. José Gutierrez', 'Especialista en Movilidad Urbana', 'Arquitecto urbanista con enfoque en movilidad sostenible y diseño de espacios públicos. Experiencia en BRT y ciclovías.', 'jgutierrez@movingenia.pe', 3, 1);

INSERT INTO projects (title, description, category, client, year, location, technologies, active, featured) VALUES
('Sistema de Control de Tráfico - Av. Javier Prado', 'Diseño e implementación de sistema de control de semáforos adaptativos en 25 intersecciones de la Av. Javier Prado.', 'ITS', 'Municipalidad de Lima', 2024, 'Lima, Perú', '["SCOOT", "Cámaras CCTV", "Detectores de flujo", "Centro de Control"]', 1, 1),
('Corredor BRT Lima Norte', 'Estudio de factibilidad y diseño conceptual del corredor BRT que conecta Lima Norte con el Centro Histórico.', 'Transporte Público', 'ATU - Autoridad de Transporte Urbano', 2023, 'Lima, Perú', '["Modelación de demanda", "Diseño geométrico", "Estaciones BRT", "VISSIM"]', 1, 1),
('Plan de Movilidad Urbana Sostenible - Arequipa', 'Elaboración del PMUS para la ciudad de Arequipa, incluyendo diagnóstico, propuestas y plan de implementación.', 'Planificación', 'Municipalidad Provincial de Arequipa', 2023, 'Arequipa, Perú', '["Encuestas O-D", "Modelación TransCAD", "Análisis multicriterio", "SIG"]', 1, 1),
('Diseño de Ciclovía Metropolitana - Tramo 1', 'Diseño integral de 15 km de ciclovías segregadas en el distrito de San Isidro y Miraflores.', 'Infraestructura', 'Municipalidad de Miraflores', 2024, 'Lima, Perú', '["Diseño geométrico", "Señalización", "Mobiliario urbano", "Iluminación LED"]', 1, 0);
