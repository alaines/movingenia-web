-- ============================================
-- MOVINGENIA - Datos de Prueba
-- ============================================
-- Ejecutar después de schema.sql

-- Equipo de ejemplo
INSERT INTO team_members (name, role, bio, display_order, active) VALUES
('Ing. Carlos Méndez', 'Director Técnico', 'Especialista en sistemas ITS con experiencia en PROMOVILIDAD y GMU Lima. Más de 10 años en proyectos de semaforización centralizada.', 1, true),
('Ing. Ana Torres', 'Jefa de Proyectos', 'Experta en gestión de centros de control de tránsito. Experiencia en PROTRÁNSITO y municipalidades.', 2, true),
('Ing. Roberto Silva', 'Desarrollador Senior', 'Especialista en desarrollo de software operativo y analítica de datos. PostgreSQL, Python, APIs REST.', 3, true);

-- Proyectos de ejemplo
INSERT INTO projects (title, summary, description, year, category, technologies, active) VALUES
(
    'Sistema de Semaforización Centralizada Inteligente',
    'Diseño e implementación de arquitectura de red semafórica con integración de controladores inteligentes y plataforma de gestión centralizada para zona metropolitana.',
    'Proyecto integral que incluyó el diseño de la arquitectura de comunicaciones, migración de controladores legacy a protocolo NTCIP, implementación de servidor central con PostgreSQL y desarrollo de interfaz web para monitoreo en tiempo real. Se logró reducir tiempos de respuesta en un 40% y mejorar la coordinación semafórica en corredores principales.',
    2023,
    'ITS',
    '["NTCIP", "PostgreSQL", "APIs REST", "Redes IP", "Python"]',
    true
),
(
    'Centro de Control de Tránsito (TMC)',
    'Desarrollo de centro de control con integración de videovigilancia, sistemas de incidencias y tableros operativos en tiempo real.',
    'Implementación de centro de control municipal que integra videovigilancia IP, sistema de gestión de incidencias, videowall operativo y generación de reportes automáticos. Incluye integración con sistemas semafóricos existentes y módulo de analítica predictiva para gestión de eventos.',
    2024,
    'TMC',
    '["Videowall", "PostgreSQL/PostGIS", "Python", "OpenCV", "Grafana"]',
    true
),
(
    'Plataforma de Analítica de Movilidad Urbana',
    'Sistema de integración de múltiples fuentes de datos de tránsito con modelado geoespacial y generación de KPIs operativos.',
    'Plataforma de analítica que integra datos de semáforos, cámaras, sensores de tráfico y GPS de transporte público. Utiliza PostGIS para análisis espacial y genera dashboards interactivos con métricas clave de movilidad. Permite evaluar desempeño de infraestructura y tomar decisiones basadas en datos.',
    2024,
    'Datos',
    '["PostgreSQL/PostGIS", "Python", "PowerBI", "APIs REST", "GeoJSON"]',
    true
),
(
    'Módulo de Gestión de Incidencias Viales',
    'Sistema web para registro, seguimiento y resolución de incidencias en vía pública con geolocalización y asignación automática.',
    'Aplicación web responsive para gestión de incidencias reportadas por operadores de campo y ciudadanía. Incluye geolocalización, asignación automática por zona, workflow de resolución, notificaciones y generación de estadísticas. Integrado con sistema de centro de control.',
    2023,
    'Software',
    '["PHP 8", "PostgreSQL", "Leaflet.js", "WebSockets", "APIs REST"]',
    true
);

-- Mensaje de contacto de ejemplo
INSERT INTO contact_messages (name, email, phone, subject, message, is_read) VALUES
(
    'Juan Pérez',
    'jperez@municipalidad.gob.pe',
    '+51 999 888 777',
    'Consulta sobre Sistema ITS',
    'Buenas tardes, estamos interesados en conocer más sobre sus soluciones de semaforización centralizada para nuestra municipalidad. ¿Podríamos agendar una reunión?',
    false
);
