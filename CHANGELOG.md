# Changelog

Todos los cambios notables de este proyecto serán documentados en este archivo.

El formato está basado en [Keep a Changelog](https://keepachangelog.com/es-ES/1.0.0/),
y este proyecto adhiere a [Semantic Versioning](https://semver.org/lang/es/).

## [0.3.0] - 2026-01-13

### ✅ Completado

#### FASE 2: Backend PHP + API REST
- Arquitectura MVC con controllers personalizados
- 7 endpoints REST funcionales y testeados
- Database class con singleton pattern y soporte multi-driver (PostgreSQL, MySQL, SQLite)
- Router personalizado con regex patterns
- Response helper para JSON estandarizado
- Schemas SQL para PostgreSQL, MySQL y SQLite
- Base de datos SQLite poblada con datos de ejemplo (3 miembros, 4 proyectos)
- Sistema de configuración con variables de entorno (.env)
- Seguridad: PDO con prepared statements, CORS configurado
- Documentación completa en `docs/api-setup.md`

#### Tests API
- ✅ Health Check: `GET /health`
- ✅ Team Members: `GET /team` (retorna 3 miembros)
- ✅ Single Member: `GET /team/{id}`
- ✅ Projects List: `GET /projects` (retorna 4 proyectos)
- ✅ Single Project: `GET /projects/{id}`
- ✅ Filter by Category: `GET /projects?category=ITS`
- ✅ Filter by Year: `GET /projects?year=2024`

#### Diseño Refinado
- Tipografía mejorada con letter-spacing optimizado
- Espaciado generoso (agregado `--space-4xl: 10rem`)
- Font weights variables (400, 500, 600, 700, 800)
- Tamaños de texto aumentados (+0.0625rem a +0.75rem)
- Line-heights mejorados (body: 1.75, headings: 1.15)
- Max-width en párrafos (75ch) para legibilidad óptima
- Botones con shadows sutiles y padding generoso
- Cards elegantes con bordes minimales
- Header con glassmorphism (`backdrop-filter: blur(8px)`)
- Hero más dramático con font-weight 800
- Efectos hover sutiles (`translateY(-2px)` vs `-4px`)
- Inspiración de diseño: mirandarodriguez.pe

### Agregado
- `api/` - Directorio completo del backend PHP
- `api/config/database.php` - Clase Database con soporte SQLite/PostgreSQL/MySQL
- `api/config/config.php` - Sistema de configuración con .env
- `api/src/Controllers/TeamController.php` - Controller de equipo
- `api/src/Controllers/ProjectController.php` - Controller de proyectos
- `api/src/Response.php` - Helper para respuestas JSON
- `api/src/Router.php` - Sistema de routing con regex
- `api/index.php` - Entry point del API
- `api/.htaccess` - Configuración Apache con CORS
- `api/.env` - Variables de entorno (development)
- `api/sql/schema.sql` - Schema PostgreSQL
- `api/sql/schema-mysql.sql` - Schema MySQL
- `api/sql/schema-sqlite.sql` - Schema SQLite con seed data
- `api/database.sqlite` - Base de datos SQLite poblada
- `api/test-db.php` - Script de pruebas de base de datos
- `docs/api-setup.md` - Documentación de instalación del API
- `docs/PHASES.md` - Plan completo de las 5 fases
- `DESIGN_REFINEMENTS.md` - Documentación de cambios de diseño
- `CHANGELOG.md` - Este archivo

### Modificado
- `src/styles/global.css` - Variables tipográficas y espaciado
- `src/styles/components.css` - Botones, cards y headers refinados
- `src/components/Header.astro` - Navegación con glassmorphism
- `src/components/Hero.astro` - Tipografía más dramática
- `src/pages/index.astro` - Todos los componentes refinados
- `README.md` - Estado actualizado con FASE 2 y tests

### Técnico
- Servidor PHP funcionando en `localhost:8000`
- Servidor Astro funcionando en `localhost:4321`
- SQLite como base de datos de desarrollo
- Preparado para PostgreSQL en producción

---

## [0.2.0] - 2026-01-12

### ✅ Completado

#### FASE 1: Frontend Astro Completo
- 8 páginas completamente funcionales con contenido COPY FINAL
- 8 componentes reutilizables
- Sistema de estilos CSS con variables
- SEO completo con Open Graph
- Build optimizado (172KB bundle)

### Agregado
- `src/layouts/Layout.astro` - Layout principal con SEO
- `src/components/Header.astro` - Navegación sticky con menú mobile
- `src/components/Footer.astro` - Footer de 3 columnas
- `src/components/Hero.astro` - Hero con 3 variantes de tamaño
- `src/components/ServiceCard.astro` - Tarjetas de servicios
- `src/components/ProjectCard.astro` - Tarjetas de proyectos
- `src/components/TeamMember.astro` - Tarjetas de equipo
- `src/components/ContactForm.astro` - Formulario de contacto
- `src/pages/index.astro` - Página home
- `src/pages/nosotros.astro` - Página nosotros
- `src/pages/servicios.astro` - Página servicios
- `src/pages/proyectos.astro` - Página proyectos
- `src/pages/equipo.astro` - Página equipo
- `src/pages/probono.astro` - Página pro bono
- `src/pages/contacto.astro` - Página contacto
- `src/pages/legal.astro` - Página legal/privacidad
- `src/styles/global.css` - Variables CSS, reset, base styles
- `src/styles/components.css` - Estilos de componentes
- `public/favicon.svg` - Favicon con gradiente MOVINGENIA
- `README.md` - Documentación inicial

### Técnico
- Astro 5.16.9 configurado
- Build exitoso sin errores
- Performance optimizada para Lighthouse > 90

---

## [0.1.0] - 2026-01-11

### Inicial
- Inicialización del proyecto
- Estructura de carpetas definida
- Plan de 5 fases establecido
- Stack tecnológico definido (Astro + PHP + PostgreSQL)
- Brief y contenido COPY FINAL recibido

### Decisiones de Arquitectura
- Astro SSG para frontend (performance y SEO)
- PHP 8.x sin frameworks para backend (compatibilidad cPanel)
- PostgreSQL como base de datos principal
- SQLite para desarrollo local
- CSS puro sin frameworks (control total)
- Deployment vía cPanel + FTP

---

## Tipos de Cambios

- `Agregado` - para nuevas funcionalidades
- `Modificado` - para cambios en funcionalidades existentes
- `Deprecado` - para funcionalidades que serán eliminadas
- `Eliminado` - para funcionalidades eliminadas
- `Corregido` - para corrección de bugs
- `Seguridad` - para vulnerabilidades corregidas
- `Técnico` - para cambios técnicos internos
- `Documentación` - para cambios en documentación

---

## Versionado

Este proyecto usa [Semantic Versioning](https://semver.org/lang/es/):

- **MAJOR** (X.0.0): Cambios incompatibles en el API
- **MINOR** (0.X.0): Nueva funcionalidad compatible
- **PATCH** (0.0.X): Correcciones de bugs compatibles

**Versión actual**: `0.3.0`

### Roadmap de Versiones

- `0.1.0` - Planificación y estructura inicial
- `0.2.0` - FASE 1: Frontend Astro completo
- `0.3.0` - FASE 2: Backend PHP + API REST ← **Estamos aquí**
- `0.4.0` - FASE 3: Admin panel + CRUD
- `0.5.0` - FASE 4: Integración frontend-backend
- `1.0.0` - FASE 5: Contacto + Deployment a producción

---

## Links

- [Repositorio](https://github.com/alaines/movingenia-web)
- [Documentación de Fases](docs/PHASES.md)
- [Documentación API](docs/api-setup.md)
- [Refinamientos de Diseño](DESIGN_REFINEMENTS.md)

---

**Mantenido por**: GitHub Copilot  
**Última actualización**: 13 de enero 2026
