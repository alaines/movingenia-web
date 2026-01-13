# MOVINGENIA API - Configuración de Base de Datos

Guía paso a paso para configurar la base de datos PostgreSQL (o MySQL) para la API de MOVINGENIA.

---

## 📋 Requisitos Previos

- **PostgreSQL 12+** (recomendado) o **MySQL 8+**
- PHP 8.0+
- Extensión PHP: `pdo_pgsql` o `pdo_mysql`

---

## 🐘 Opción 1: PostgreSQL (Recomendado)

### 1. Crear base de datos y usuario

```bash
# Conectar a PostgreSQL
sudo -u postgres psql

# Crear usuario
CREATE USER movingenia_user WITH PASSWORD 'tu_password_seguro';

# Crear base de datos
CREATE DATABASE movingenia_db OWNER movingenia_user;

# Otorgar permisos
GRANT ALL PRIVILEGES ON DATABASE movingenia_db TO movingenia_user;

# Salir
\q
```

### 2. Ejecutar schema

```bash
# Importar schema
psql -U movingenia_user -d movingenia_db -f api/sql/schema.sql

# Importar datos de prueba (opcional)
psql -U movingenia_user -d movingenia_db -f api/sql/seed.sql
```

### 3. Verificar tablas

```bash
psql -U movingenia_user -d movingenia_db

# Listar tablas
\dt

# Verificar datos
SELECT * FROM team_members;
SELECT * FROM projects;

\q
```

---

## 🐬 Opción 2: MySQL (Alternativa)

### 1. Crear base de datos y usuario

```bash
# Conectar a MySQL
mysql -u root -p

# Crear base de datos
CREATE DATABASE movingenia_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Crear usuario
CREATE USER 'movingenia_user'@'localhost' IDENTIFIED BY 'tu_password_seguro';

# Otorgar permisos
GRANT ALL PRIVILEGES ON movingenia_db.* TO 'movingenia_user'@'localhost';
FLUSH PRIVILEGES;

EXIT;
```

### 2. Ejecutar schema

```bash
# Importar schema
mysql -u movingenia_user -p movingenia_db < api/sql/schema-mysql.sql

# Importar datos de prueba (opcional)
mysql -u movingenia_user -p movingenia_db < api/sql/seed.sql
```

### 3. Verificar tablas

```bash
mysql -u movingenia_user -p movingenia_db

SHOW TABLES;
SELECT * FROM team_members;
SELECT * FROM projects;

EXIT;
```

---

## ⚙️ Configuración de la API

### 1. Crear archivo .env

```bash
cd api/config
cp .env.example .env
nano .env  # o vim, code, etc.
```

### 2. Configurar credenciales

**Para PostgreSQL:**
```env
DB_DRIVER=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_NAME=movingenia_db
DB_USER=movingenia_user
DB_PASS=tu_password_seguro

APP_ENV=development
APP_DEBUG=true
```

**Para MySQL:**
```env
DB_DRIVER=mysql
DB_HOST=localhost
DB_PORT=3306
DB_NAME=movingenia_db
DB_USER=movingenia_user
DB_PASS=tu_password_seguro

APP_ENV=development
APP_DEBUG=true
```

### 3. Permisos de archivos

```bash
# Proteger .env
chmod 600 api/config/.env

# Crear directorio uploads
mkdir -p public/uploads
chmod 755 public/uploads
```

---

## 🧪 Testing de la API

### 1. Health check

```bash
curl http://localhost/api/health
```

**Respuesta esperada:**
```json
{
  "success": true,
  "data": {
    "status": "ok",
    "timestamp": "2026-01-13 17:30:00",
    "api_version": "v1"
  }
}
```

### 2. Listar equipo

```bash
curl http://localhost/api/team
```

**Respuesta esperada:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Ing. Carlos Méndez",
      "role": "Director Técnico",
      "bio": "Especialista en sistemas ITS...",
      "image": null,
      "order": 1
    }
  ],
  "count": 3
}
```

### 3. Listar proyectos

```bash
curl http://localhost/api/projects
```

### 4. Proyecto específico

```bash
curl http://localhost/api/projects/1
```

### 5. Filtrar proyectos

```bash
# Por categoría
curl http://localhost/api/projects?category=ITS

# Por año
curl http://localhost/api/projects?year=2024

# Combinado
curl http://localhost/api/projects?category=TMC&year=2024
```

---

## 🚀 Deploy en cPanel

### 1. Crear base de datos en cPanel

1. Login a cPanel
2. Ir a **MySQL Databases** (o **PostgreSQL** si está disponible)
3. Crear nueva base de datos: `movingenia_db`
4. Crear usuario: `movingenia_user`
5. Asignar usuario a base de datos con **ALL PRIVILEGES**

### 2. Importar schema

1. Ir a **phpMyAdmin** (o **phpPgAdmin**)
2. Seleccionar base de datos `movingenia_db`
3. Ir a pestaña **Import**
4. Subir archivo `schema.sql` (o `schema-mysql.sql`)
5. Ejecutar
6. (Opcional) Importar `seed.sql` para datos de prueba

### 3. Subir archivos por FTP

```
public_html/
├── api/
│   ├── config/
│   │   ├── .env           ← Crear con credenciales cPanel
│   │   ├── config.php
│   │   └── database.php
│   ├── src/
│   ├── index.php
│   └── .htaccess
├── uploads/               ← Crear y dar permisos 755
└── (archivos Astro build)
```

### 4. Configurar .env en servidor

Crear `api/config/.env` con las credenciales de cPanel:

```env
DB_DRIVER=mysql
DB_HOST=localhost
DB_PORT=3306
DB_NAME=tu_usuario_movingenia_db
DB_USER=tu_usuario_movingenia_user
DB_PASS=password_generado_cpanel

APP_ENV=production
APP_DEBUG=false
```

### 5. Verificar permisos

```bash
# En File Manager de cPanel
api/config/.env → 600
uploads/ → 755
```

### 6. Testing

```bash
curl https://tudominio.com/api/health
curl https://tudominio.com/api/team
curl https://tudominio.com/api/projects
```

---

## 🔒 Seguridad en Producción

1. **Cambiar APP_DEBUG a false** en `.env`
2. **Usar contraseñas fuertes** para la base de datos
3. **Nunca commitear .env** a Git (ya está en `.gitignore`)
4. **Verificar que** `/api/config/` y `/api/sql/` estén protegidos por `.htaccess`
5. **Habilitar HTTPS** en producción
6. **Configurar CORS** correctamente (no usar `*` en producción)

---

## 🐛 Troubleshooting

### Error: Connection refused

- Verificar que PostgreSQL/MySQL esté corriendo
- Verificar credenciales en `.env`
- Verificar puerto correcto (5432 para PostgreSQL, 3306 para MySQL)

### Error: Access denied

- Verificar permisos del usuario en la base de datos
- Verificar password correcto en `.env`

### Error: 500 Internal Server Error

- Activar `APP_DEBUG=true` para ver el error detallado
- Revisar logs de PHP: `tail -f /var/log/php_errors.log`
- Verificar que extensión PDO esté instalada: `php -m | grep pdo`

### Error: File not found (404)

- Verificar que `.htaccess` esté en `/api/`
- Verificar que `mod_rewrite` esté habilitado en Apache

---

## 📚 Recursos Adicionales

- [PostgreSQL Documentation](https://www.postgresql.org/docs/)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [PHP PDO](https://www.php.net/manual/en/book.pdo.php)

---

**Última actualización:** Enero 2026  
**Contacto:** contacto@movingenia.com
