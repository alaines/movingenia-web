# Plan de Desarrollo MOVINGENIA - 5 Fases

## Visión General

Desarrollo progresivo del sitio web corporativo de MOVINGENIA con enfoque en calidad, seguridad y performance.

**Stack Tecnológico:**
- Frontend: Astro 5.16.9 (SSG)
- Backend: PHP 8.x
- Base de datos: PostgreSQL (producción) / SQLite (desarrollo)
- Deployment: cPanel + FTP

**Objetivo de Performance:** Lighthouse > 90 (desktop)

---

## FASE 1: Frontend Estático ✅ COMPLETADO

### Objetivos
Crear frontend completo con Astro SSG, incluyendo todas las páginas y componentes reutilizables con el contenido final (COPY FINAL).

### Entregables
- [x] 8 páginas completamente funcionales:
  - Home (`/`)
  - Nosotros (`/nosotros`)
  - Servicios (`/servicios`)
  - Proyectos (`/proyectos`)
  - Equipo (`/equipo`)
  - Pro Bono (`/probono`)
  - Contacto (`/contacto`)
  - Legal (`/legal`)

- [x] 8 componentes reutilizables:
  - `Layout.astro` - Layout principal con SEO
  - `Header.astro` - Navegación sticky con menú mobile
  - `Footer.astro` - Footer de 3 columnas
  - `Hero.astro` - Hero con 3 variantes (small/medium/large)
  - `ServiceCard.astro` - Tarjetas de servicios
  - `ProjectCard.astro` - Tarjetas de proyectos
  - `TeamMember.astro` - Tarjetas de equipo
  - `ContactForm.astro` - Formulario de contacto

- [x] Sistema de estilos:
  - `global.css` - Variables CSS, reset, base styles
  - `components.css` - Estilos de componentes reutilizables
  - Paleta de 8 colores MOVINGENIA
  - Tipografía profesional con Inter

- [x] SEO y Metadata:
  - Meta tags completos por página
  - Open Graph tags
  - Canonical URLs
  - Favicon SVG con gradiente

### Resultados
- **Build exitoso**: 172KB bundle, 0 errores
- **8 páginas generadas** en `dist/`
- **Diseño refinado** inspirado en mirandarodriguez.pe
- **Performance optimizada** para Lighthouse > 90

---

## FASE 2: Backend PHP + API REST ✅ COMPLETADO

### Objetivos
Implementar backend PHP con arquitectura MVC y API REST completa para gestión de contenido.

### Entregables
- [x] Arquitectura backend:
  - Singleton Database class con PDO
  - Router personalizado con regex patterns
  - Response helper para JSON estandarizado
  - Manejo centralizado de errores

- [x] API REST (7 endpoints):
  - `GET /health` - Health check
  - `GET /team` - Listar equipo
  - `GET /team/{id}` - Obtener miembro
  - `GET /projects` - Listar proyectos
  - `GET /projects/{id}` - Obtener proyecto
  - `GET /projects?category={cat}` - Filtrar por categoría
  - `GET /projects?year={year}` - Filtrar por año

- [x] Base de datos:
  - Schemas para PostgreSQL, MySQL y SQLite
  - 4 tablas: `users`, `team_members`, `projects`, `contact_messages`
  - Índices optimizados
  - Datos de ejemplo (seed data)

- [x] Seguridad:
  - PDO con prepared statements
  - CORS configurado
  - `.htaccess` protection
  - Variables de entorno (.env)
  - Error logging

- [x] Documentación:
  - `docs/api-setup.md` - Guía de instalación
  - Ejemplos de uso con curl
  - Estructura de respuestas JSON

### Resultados
- **API funcional** con SQLite en desarrollo
- **7 endpoints testeados** y funcionando
- **3 miembros** y **4 proyectos** de ejemplo
- **Arquitectura escalable** lista para producción

---

## FASE 3: Panel de Administración ⏳ PENDIENTE

### Objetivos
Crear panel admin completo con autenticación y CRUD para gestión de contenido.

### Entregables Planificados
- [ ] Sistema de autenticación:
  - Login seguro con sesiones PHP
  - Password hashing con argon2id/bcrypt
  - Protección CSRF en formularios
  - Middleware de autenticación

- [ ] Panel administrativo (`/admin/`):
  - Dashboard con estadísticas
  - Gestión de equipo (CRUD completo)
  - Gestión de proyectos (CRUD completo)
  - Bandeja de mensajes de contacto

- [ ] Upload de imágenes:
  - Subida segura de archivos
  - Validación de tipo/tamaño
  - Procesamiento (resize, thumbnails)
  - Almacenamiento organizado en `/uploads/`

- [ ] Interfaz de usuario:
  - Diseño responsivo
  - Formularios validados (client + server)
  - Tablas con paginación y búsqueda
  - Confirmaciones para acciones destructivas

### Consideraciones Técnicas
- **Seguridad**:
  - Tokens CSRF en todos los formularios
  - Validación exhaustiva de inputs
  - Sanitización de datos
  - Rate limiting en login

- **UX Admin**:
  - Editor WYSIWYG para descripciones
  - Drag & drop para ordenar
  - Preview antes de guardar
  - Notificaciones de éxito/error

---

## FASE 4: Integración Frontend-Backend ⏳ PENDIENTE

### Objetivos
Conectar el frontend Astro con la API REST y hacer el sitio completamente dinámico.

### Entregables Planificados
- [ ] Integración de datos dinámicos:
  - Página `/equipo` consumiendo `GET /team`
  - Página `/proyectos` consumiendo `GET /projects`
  - Filtros de proyectos funcionales
  - Lazy loading de imágenes

- [ ] Server-Side Rendering (opcional):
  - Evaluar SSR vs SSG
  - Build incremental si aplica
  - Cache strategy

- [ ] Optimizaciones:
  - Image optimization con Astro
  - Code splitting
  - Prefetching de rutas
  - Service Worker (PWA opcional)

- [ ] Testing:
  - Tests de integración
  - Performance testing
  - Accessibility testing (a11y)
  - Browser compatibility

### Métricas Objetivo
- **Lighthouse Performance**: > 90
- **Lighthouse Accessibility**: > 95
- **Lighthouse Best Practices**: > 90
- **Lighthouse SEO**: 100

---

## FASE 5: Formulario de Contacto + Deployment ⏳ PENDIENTE

### Objetivos
Implementar formulario de contacto funcional y desplegar el sitio a producción.

### Entregables Planificados
- [ ] Formulario de contacto:
  - Endpoint `POST /contact`
  - Validación robusta (client + server)
  - Protección contra spam (reCAPTCHA v3)
  - Rate limiting
  - Almacenamiento en BD

- [ ] Notificaciones:
  - Email a MOVINGENIA al recibir mensaje
  - Auto-respuesta al cliente
  - Panel admin para gestionar mensajes

- [ ] Deployment a cPanel:
  - Build de producción
  - Configuración de base de datos PostgreSQL
  - Migración de datos
  - Configuración de .htaccess
  - SSL/HTTPS

- [ ] Post-deployment:
  - Testing en producción
  - Monitoreo de errores
  - Backups automáticos
  - Documentación de mantenimiento

### Checklist de Deployment
- [ ] Variables de entorno configuradas
- [ ] Base de datos PostgreSQL creada
- [ ] Schema importado
- [ ] DNS configurado
- [ ] SSL activo
- [ ] Emails funcionando
- [ ] Backups configurados
- [ ] Analytics instalado (Google Analytics 4)

---

## Cronograma Estimado

| Fase | Estado | Tiempo Estimado | Complejidad |
|------|--------|-----------------|-------------|
| FASE 1: Frontend | ✅ Completado | 3-4 días | Media |
| FASE 2: Backend API | ✅ Completado | 2-3 días | Media-Alta |
| FASE 3: Admin Panel | ⏳ Pendiente | 3-4 días | Alta |
| FASE 4: Integración | ⏳ Pendiente | 2-3 días | Media |
| FASE 5: Contacto + Deploy | ⏳ Pendiente | 1-2 días | Media |

**Total estimado**: 11-16 días de desarrollo

---

## Stack Tecnológico Detallado

### Frontend
- **Framework**: Astro 5.16.9
- **Styling**: CSS puro con variables
- **Build**: Vite
- **Deployment**: Static files

### Backend
- **Lenguaje**: PHP 8.x
- **Arquitectura**: MVC custom
- **Database**: PDO (PostgreSQL/MySQL/SQLite)
- **API**: REST JSON
- **Server**: Apache + mod_rewrite

### DevOps
- **Version Control**: Git + GitHub
- **Hosting**: cPanel + FTP
- **Database**: PostgreSQL (prod), SQLite (dev)
- **CI/CD**: Manual deployment (FASE 5)

### Seguridad
- **Passwords**: argon2id / bcrypt
- **Database**: Prepared statements
- **CORS**: Configurado
- **CSRF**: Tokens en formularios
- **Input**: Validación + sanitización
- **Uploads**: Validación de tipo/tamaño

---

## Progreso Actual

### ✅ Completado (40%)
- FASE 1: Frontend Astro - 100%
- FASE 2: Backend API - 100%
- Diseño refinado - 100%
- Tests API - 100%

### 🔄 En Progreso (0%)
- Ninguna fase en progreso actualmente

### ⏳ Pendiente (60%)
- FASE 3: Admin Panel - 0%
- FASE 4: Integración - 0%
- FASE 5: Contacto + Deploy - 0%

---

## Notas Importantes

### Decisiones de Arquitectura
1. **Astro SSG**: Elegido por performance y SEO
2. **PHP Backend**: Compatible con cPanel, sin frameworks pesados
3. **SQLite Dev**: Facilita desarrollo sin PostgreSQL local
4. **CSS Puro**: Sin frameworks para control total y ligereza
5. **MVC Custom**: Sin frameworks para máxima flexibilidad

### Próximos Pasos Recomendados
1. Iniciar FASE 3 con sistema de autenticación
2. Implementar CRUD de proyectos
3. Implementar CRUD de equipo
4. Testear upload de imágenes
5. Continuar con FASE 4

---

**Documento creado**: 13 de enero 2026  
**Última actualización**: 13 de enero 2026  
**Versión**: 0.3.0
