<!-- Proyecto de Gestión de Alumnos Duales - UTVT -->

<h1 align="center">Proyecto de Gestión de Alumnos Duales - UTVT</h1>

<p align="center">
  <img alt="Proyecto Banner" src="./public/assets/images/Logo-utvt.png" width="300">
</p>

---

## 📚 Descripción General

El **Proyecto de Gestión de Alumnos Duales - UTVT** es una plataforma integral desarrollada para optimizar el registro, seguimiento y administración de estudiantes inscritos en el modelo educativo dual de la Universidad Tecnológica del Valle de Toluca. El sistema permite la gestión eficiente de documentos, usuarios, roles y reportes, garantizando seguridad, trazabilidad y facilidad de uso para todos los actores involucrados.

---

## 🚀 Características Principales

- **Gestión Integral de Estudiantes:** Registro, edición y seguimiento de alumnos duales.
- **Carga y Validación de Documentos:** Soporte para anexos, formatos y archivos requeridos.
- **Roles y Permisos:** Acceso segmentado para Administradores, Directores, Mentores y Estudiantes.
- **Notificaciones Automatizadas:** Alertas por correo y en plataforma sobre eventos y vencimientos.
- **Reportes Personalizados:** Generación de informes por carrera, periodo, empresa, etc.
- **Panel de Control Dinámico:** Estadísticas y visualización de avances en tiempo real.
- **Soporte Multiplataforma:** Compatible con Windows, Linux y macOS.
- **Contenerización con Docker:** Despliegue sencillo y reproducible en cualquier entorno.

---

## 🏗️ Arquitectura y Tecnologías

- **Frontend:** Blade, HTML5, CSS3, JavaScript, TailwindCSS
- **Backend:** Laravel 10.x (PHP 8.1+)
- **Base de Datos:** MySQL/MariaDB
- **Herramientas DevOps:** Docker, GitHub Actions (CI/CD)
- **Testing:** PHPUnit, Laravel Test Suite
- **Gestión de Dependencias:** Composer, npm

---

## 📦 Estructura del Proyecto

```
.
├── app/                # Lógica de aplicación (Modelos, Controladores, etc.)
├── bootstrap/          # Arranque de Laravel
├── config/             # Archivos de configuración
├── database/           # Migraciones, seeders y factories
├── public/             # Archivos públicos y punto de entrada web
├── resources/          # Vistas Blade, assets y traducciones
├── routes/             # Definición de rutas web y API
├── storage/            # Archivos generados y logs
├── tests/              # Pruebas unitarias y de integración
├── vendor/             # Dependencias de Composer
├── .env.example        # Ejemplo de configuración de entorno
├── documentation.md    # Manual técnico y de usuario
└── README.md           # Este archivo
```

---

## ⚙️ Instalación y Puesta en Marcha

Consulta la [documentación técnica completa](./documentation.md) para detalles avanzados.  
A continuación, se resumen los pasos esenciales para la instalación local:

### 1. Requisitos Previos

- PHP >= 8.1
- Composer
- Node.js >= 16 y npm
- MySQL o MariaDB
- Git
- Extensiones PHP: mbstring, openssl, pdo, tokenizer, xml, ctype, json, bcmath, fileinfo

### 2. Clonar el Repositorio

```sh
git clone https://github.com/Du-F23/seguimiento_dual.git
cd seguimiento_dual
```

### 3. Instalar Dependencias

```sh
composer install
npm install
```

### 4. Configurar Variables de Entorno

```sh
cp .env.example .env
```
Edita `.env` con tus credenciales de base de datos y correo.

### 5. Generar Key de la Aplicación

```sh
php artisan key:generate
```

### 6. Migrar y Poblar la Base de Datos

```sh
php artisan migrate --seed
```

### 7. Crear Enlace de Almacenamiento

```sh
php artisan storage:link
```

### 8. Compilar Recursos Frontend

Para desarrollo:
```sh
npm run dev
```
Para producción:
```sh
npm run build
```

### 9. Levantar el Servidor de Desarrollo

```sh
php artisan serve
```
Accede a [http://localhost:8000](http://localhost:8000)

---


## 🐳 Despliegue con Docker (Opcional)

Si prefieres usar Docker, asegúrate de tener Docker y Docker Compose instalados.  
Ejemplo básico:

```sh
docker-compose up -d
```
Configura las variables de entorno para los contenedores según sea necesario.

---

## 🔒 Seguridad y Buenas Prácticas

- No subas el archivo `.env` al repositorio.
- Cambia las contraseñas predeterminadas tras la instalación.
- Configura correctamente los permisos de archivos y carpetas (`storage`, `bootstrap/cache`).
- Mantén actualizado el framework y las dependencias.
- Revisa los logs en `storage/logs/laravel.log` ante cualquier incidencia.

---


## 📄 Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo [LICENSE](./LICENSE) para más detalles.

---

## 📖 Documentación

- [Manual Técnico y de Usuario](./documentation.md)
- [Documentación Oficial de Laravel](https://laravel.com/docs)

---
