# MOVINGENIA - Sitio Web Corporativo

Sitio web de **MOVINGENIA**: Ingeniería de Movilidad Inteligente para ciudades y organizaciones.

## 🎯 Stack Tecnológico

- **Frontend:** Astro (SSG) con HTML/CSS/JS mínimo
- **Backend:** PHP 8.x + PDO + PostgreSQL (FASE 2+)
- **Hosting:** cPanel + FTP
- **Diseño:** CSS puro (sin frameworks)

## 🎨 Paleta de Colores

- **Azul Principal:** `#2B5B88`
- **Azul Oscuro:** `#25598B`
- **Verde Acento:** `#82CA6F`
- **Fondo:** `#F8FAFC`
- **Texto:** `#111827`
- **Texto Secundario:** `#6B7280`
- **Bordes:** `#E5E7EB`
- **CTA:** `#F59E0B`

---

## 📁 Estructura del Proyecto

```
movingenia-web/
├── public/
│   ├── favicon.svg           # Logo M gradiente
│   └── images/               # Assets estáticos
│
├── src/
│   ├── layouts/
│   │   └── Layout.astro      # Layout principal con SEO
│   │
│   ├── components/
│   │   ├── Header.astro      # Navegación sticky
│   │   ├── Footer.astro      # Footer con contacto
│   │   ├── Hero.astro        # Hero con 3 tamaños
│   │   ├── SectionTitle.astro
│   │   ├── CTAButton.astro
│   │   ├── ServiceCard.astro
│   │   ├── ProjectCard.astro
│   │   └── TeamMember.astro
│   │
│   ├── pages/
│   │   ├── index.astro       # Home
│   │   ├── nosotros.astro    # Quiénes somos
│   │   ├── servicios.astro   # 5 servicios + sectores
│   │   ├── proyectos.astro   # Portafolio
│   │   ├── equipo.astro      # Equipo
│   │   ├── probono.astro     # Pro Bono e Impacto
│   │   ├── contacto.astro    # Formulario contacto
│   │   └── legal.astro       # Privacidad
│   │
│   └── styles/
│       ├── global.css        # Variables + reset
│       └── components.css    # Componentes reutilizables
│
└── api/                      # Backend PHP (FASE 2+)
```

---

## 🚀 FASE 1 - COMPLETADA ✅

### Instalación y Desarrollo

```bash
# Instalar dependencias
npm install

# Desarrollo local (http://localhost:4321)
npm run dev

# Build producción
npm run build

# Preview del build
npm run preview
```

### Páginas Implementadas

1. **/** - Home con hero, intro, preview servicios, sectores
2. **/nosotros** - Quiénes somos, experiencia, misión/visión
3. **/servicios** - 5 servicios + sectores detallados
4. **/proyectos** - Portafolio (placeholder, dinámico en FASE 4)
5. **/equipo** - Equipo (placeholder, dinámico en FASE 4)
6. **/probono** - Pro Bono e Impacto Social
7. **/contacto** - Formulario + datos de contacto
8. **/legal** - Política de privacidad

### Componentes Creados

- ✅ `Layout.astro` - SEO completo, Open Graph, favicon
- ✅ `Header.astro` - Navegación responsive con menú móvil
- ✅ `Footer.astro` - 3 columnas con enlaces y contacto
- ✅ `Hero.astro` - 3 tamaños (small, medium, large)
- ✅ `SectionTitle.astro` - Títulos con divider
- ✅ `CTAButton.astro` - Botones (primary, cta, outline)
- ✅ `ServiceCard.astro` - Cards de servicios con hover
- ✅ `ProjectCard.astro` - Cards de proyectos con imagen
- ✅ `TeamMember.astro` - Cards de equipo con placeholder

### Estilos

- ✅ CSS Variables con paleta MOVINGENIA
- ✅ Sistema de tipografía y espaciado
- ✅ Animaciones sutiles (hover, fade-in)
- ✅ Responsive design (mobile-first)
- ✅ Componentes reutilizables (botones, cards, forms)

---

## ✅ Checklist de Verificación FASE 1

### Funcionalidad
- [x] Proyecto Astro inicializado
- [x] 8 páginas navegables
- [x] Navegación sticky responsive
- [x] Menú móvil funcional
- [x] Footer con enlaces y contacto
- [x] Todas las rutas funcionan correctamente

### Contenido
- [x] COPY FINAL completo implementado
- [x] Entidades mencionadas (PROMOVILIDAD, GMU, PROTRÁNSITO)
- [x] 5 servicios descritos
- [x] Misión y Visión
- [x] Sectores público/privado
- [x] Pro Bono e Impacto

### Diseño
- [x] Paleta de colores aplicada
- [x] Tipografía legible y profesional
- [x] Diseño sobrio/tecnológico
- [x] Animaciones sutiles en hover
- [x] Responsive en móvil/tablet/desktop

### SEO y Performance
- [x] Meta tags por página
- [x] Open Graph implementado
- [x] Favicon personalizado
- [x] Lazy loading de imágenes
- [x] Sin JS innecesario
- [x] CSS optimizado

### Pendiente para FASE 2+
- [ ] Backend PHP + PostgreSQL
- [ ] API pública de lectura
- [ ] Admin panel + CRUD
- [ ] Integración frontend ↔ backend
- [ ] Formulario contacto funcional
- [ ] Deploy a cPanel

---

## 🎯 Objetivos de Performance

- **Lighthouse Performance:** > 90 (desktop)
- **Accesibilidad:** > 90
- **SEO:** > 95
- **Best Practices:** > 90

---

## 📝 Notas de Desarrollo

### FASE 1 (Actual)
- Frontend 100% estático con COPY final
- Formulario de contacto muestra mensaje placeholder
- Proyectos y Equipo usan datos hardcoded
- Preparado para consumir API en FASE 4

### Próximos Pasos (FASE 2)
- Crear schema PostgreSQL
- Implementar endpoints GET `/api/team` y `/api/projects`
- Configurar conexión PDO segura
- Testing con curl

---

## 👨‍💻 Comandos Útiles

```bash
# Verificar errores de build
npm run build

# Ver estructura de archivos
tree -L 3 -I 'node_modules'

# Comprobar tamaño del bundle
npm run build && du -sh dist/
```

---

## 📄 Licencia

© 2026 MOVINGENIA. Todos los derechos reservados.

**Contacto:** contacto@movingenia.com | +51 963 552 850

---

## 🚀 FASE 2 - COMPLETADA ✅

### Backend PHP + PostgreSQL

**Archivos creados:**
- ✅ `api/sql/schema.sql` - Schema PostgreSQL
- ✅ `api/sql/schema-mysql.sql` - Schema MySQL alternativo
- ✅ `api/sql/seed.sql` - Datos de prueba
- ✅ `api/config/config.php` - Configuración general
- ✅ `api/config/database.php` - Clase Database (PDO)
- ✅ `api/config/.env.example` - Template de credenciales
- ✅ `api/src/Response.php` - Helper respuestas JSON
- ✅ `api/src/Router.php` - Router simple
- ✅ `api/src/Controllers/TeamController.php` - GET /api/team
- ✅ `api/src/Controllers/ProjectController.php` - GET /api/projects
- ✅ `api/index.php` - Entry point
- ✅ `api/.htaccess` - Seguridad + rewrite
- ✅ `docs/api-setup.md` - Guía completa

### Endpoints Implementados

```
GET  /api/health                → Health check
GET  /api/team                  → Lista equipo (order ASC)
GET  /api/team/{id}             → Detalle miembro
GET  /api/projects              → Lista proyectos (year DESC)
GET  /api/projects/{id}         → Detalle proyecto
GET  /api/projects?category=X   → Filtrar por categoría
GET  /api/projects?year=YYYY    → Filtrar por año
```

### Setup Rápido

```bash
# 1. Crear base de datos PostgreSQL
sudo -u postgres psql
CREATE DATABASE movingenia_db;
CREATE USER movingenia_user WITH PASSWORD 'password';
GRANT ALL PRIVILEGES ON DATABASE movingenia_db TO movingenia_user;
\q

# 2. Importar schema
psql -U movingenia_user -d movingenia_db -f api/sql/schema.sql
psql -U movingenia_user -d movingenia_db -f api/sql/seed.sql

# 3. Configurar .env
cd api/config
cp .env.example .env
# Editar .env con tus credenciales

# 4. Testing
curl http://localhost/api/health
curl http://localhost/api/team
curl http://localhost/api/projects
```

Ver guía completa en: [docs/api-setup.md](docs/api-setup.md)

### Próximos Pasos (FASE 3)
- [ ] Sistema de autenticación (login)
- [ ] Panel admin (/admin/)
- [ ] CRUD completo (Team, Projects, Messages)
- [ ] Upload de imágenes seguro
- [ ] CSRF protection


---

## 🎯 Estado Actual del Proyecto

### ✅ Completado

#### FASE 1: Frontend Astro (Completado)
- **8 páginas** funcionales con SEO completo
- **8 componentes** reutilizables
- **Diseño refinado** inspirado en mirandarodriguez.pe
- Build optimizado: 172KB bundle
- Performance: Preparado para Lighthouse > 90

#### FASE 2: Backend PHP + API REST (Completado)
- **API REST funcional** con 7 endpoints
- **SQLite** como base de datos (development)
- **4 tablas**: users, team_members, projects, contact_messages
- **Arquitectura MVC** con controllers y routing
- **Seguridad**: PDO con prepared statements, CORS configurado
- **Datos de ejemplo** poblados (3 miembros, 4 proyectos)

#### Diseño Refinado (Completado)
- Tipografía mejorada con mejor jerarquía visual
- Espaciado generoso y profesional
- Efectos sutiles y elegantes
- Ver detalles en [`DESIGN_REFINEMENTS.md`](DESIGN_REFINEMENTS.md)

#### Tests API (Completados)
- ✅ Health Check: `GET /health`
- ✅ Team Members: `GET /team` (3 miembros)
- ✅ Single Member: `GET /team/{id}`
- ✅ Projects List: `GET /projects` (4 proyectos)
- ✅ Single Project: `GET /projects/{id}`
- ✅ Filter by Category: `GET /projects?category=ITS`
- ✅ Filter by Year: `GET /projects?year=2024`

### 🔄 Servidores Activos

```bash
# Frontend (Astro)
http://localhost:4321

# Backend (PHP API)
http://localhost:8000
```

### 🗂️ Estructura del Proyecto

```
movingenia-web/
├── src/                       # Frontend Astro
│   ├── layouts/
│   ├── components/
│   ├── pages/
│   └── styles/
├── api/                       # Backend PHP
│   ├── config/               # Configuración y Database
│   ├── src/
│   │   ├── Controllers/     # TeamController, ProjectController
│   │   ├── Response.php     # Helper JSON responses
│   │   └── Router.php       # Sistema de routing
│   ├── sql/                 # Schemas (PostgreSQL, MySQL, SQLite)
│   ├── .env                 # Variables de entorno
│   ├── database.sqlite      # BD SQLite (development)
│   └── index.php           # Entry point
├── docs/                    # Documentación
└── README.md
```

### 📊 Base de Datos SQLite (Development)

**Tablas creadas:**
- `users` - Usuarios admin
- `team_members` - 3 miembros del equipo
- `projects` - 4 proyectos de ejemplo
- `contact_messages` - Mensajes de contacto

**Datos de ejemplo:**
- **Equipo**: Ing. Carlos Miranda, Ing. María Rodríguez, Arq. José Gutierrez
- **Proyectos**: Sistema Control Tráfico (ITS), Corredor BRT, PMUS Arequipa, Ciclovía

### 🧪 Cómo Testear la API

```bash
# Health Check
curl http://localhost:8000/health | jq

# Listar equipo
curl http://localhost:8000/team | jq

# Listar proyectos
curl http://localhost:8000/projects | jq

# Filtrar por categoría
curl "http://localhost:8000/projects?category=ITS" | jq

# Ver miembro específico
curl http://localhost:8000/team/1 | jq
```

### ⏭️ Próximos Pasos

1. **FASE 3**: Panel de administración con autenticación
2. **FASE 4**: Integrar frontend con API REST
3. **FASE 5**: Formulario de contacto y deployment

---

**Última actualización**: 13 de enero 2026  
**Stack**: Astro 5.16.9 + PHP 8.x + SQLite
