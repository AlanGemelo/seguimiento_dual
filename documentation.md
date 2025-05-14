<!-- Manual Técnico de Instalación y Puesta en Marcha -->
<h1 align="center">Manual Técnico de Instalación y Ejecución</h1>

<p align="center">
  <img alt="Proyecto Banner" src="./public/assets/images/Logo-utvt.png">
</p>

---

## 1. Requisitos Previos

Antes de comenzar, asegúrate de contar con lo siguiente instalado y configurado en tu equipo:

- **Sistema Operativo:** Windows 10/11, Linux o macOS.
- **PHP:** Versión 8.1 o superior.
- **Composer:** https://getcomposer.org/
- **Node.js:** Versión 16 o superior y npm.
- **MySQL** o **MariaDB** (servidor de base de datos).
- **Git:** https://git-scm.com/
- **Extensiones PHP:** mbstring, openssl, pdo, tokenizer, xml, ctype, json, bcmath, fileinfo.
- **Servidor Web:** Apache o Nginx (opcional para desarrollo, recomendado para producción).
- **Docker:** Opcional, para despliegue en contenedores.

---

## 2. Clonación del Repositorio

Abre una terminal y ejecuta:

```sh
git clone https://github.com/Du-F23/seguimiento_dual.git
cd seguimiento_dual
```

---

## 3. Instalación de Dependencias Backend

Instala las dependencias de PHP (Laravel):

```sh
composer install
```

---

## 4. Instalación de Dependencias Frontend

Instala las dependencias de Node.js:

```sh
npm install
```

---

## 5. Configuración de Variables de Entorno

Copia el archivo de ejemplo y edítalo según tu entorno:

```sh
cp .env.example .env
```

Abre el archivo `.env` y configura los siguientes parámetros:

- **APP_NAME:** Nombre de la aplicación.
- **APP_URL:** URL base del proyecto (ejemplo: http://localhost).
- **DB_CONNECTION:** mysql
- **DB_HOST:** 127.0.0.1
- **DB_PORT:** 3306
- **DB_DATABASE:** Nombre de la base de datos.
- **DB_USERNAME:** Usuario de la base de datos.
- **DB_PASSWORD:** Contraseña de la base de datos.
- **MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION, MAIL_FROM_ADDRESS, MAIL_FROM_NAME:** Configuración de correo para notificaciones (opcional pero recomendado).

Guarda los cambios.

---

## 6. Generar la Key de la Aplicación

```sh
php artisan key:generate
```

---

## 7. Migrar y Poblar la Base de Datos

Asegúrate de tener la base de datos creada en tu gestor (MySQL/MariaDB).

```sh
php artisan migrate --seed
```

Esto ejecuta las migraciones y carga los datos iniciales (usuarios, roles, catálogos, etc.).

---

## 8. Crear el Enlace de Almacenamiento

Esto permite acceder a los archivos subidos desde el navegador.

```sh
php artisan storage:link
```

---

## 9. Compilar los Recursos Frontend

Para desarrollo:

```sh
npm run dev
```

Para producción:

```sh
npm run build
```

---

## 10. Levantar el Servidor de Desarrollo

```sh
php artisan serve
```

Por defecto, la aplicación estará disponible en [http://localhost:8000](http://localhost:8000).

---

## 11. Pruebas Unitarias y de Integración

Para ejecutar los tests:

```sh
php artisan test
```
o
```sh
./vendor/bin/phpunit
```

---

## 12. Uso de Docker (Opcional)

Si prefieres usar Docker, asegúrate de tener instalado Docker y Docker Compose. Puedes crear un archivo `docker-compose.yml` y levantar los servicios con:

```sh
docker-compose up -d
```

Configura las variables de entorno para que apunten a los contenedores de base de datos y servicios.

---

## 13. Configuración de Permisos

Asegúrate de que las carpetas `storage` y `bootstrap/cache` tengan permisos de escritura:

```sh
chmod -R 775 storage bootstrap/cache
```

En Windows, asegúrate de que los archivos no estén en modo solo lectura.

---

## 14. Acceso Inicial

- El sistema crea usuarios iniciales mediante los seeders. Consulta los datos de acceso en los seeders o directamente en la base de datos.
- Cambia las contraseñas por seguridad tras el primer acceso.

---

## 15. Recursos y Documentación

- [README.md](README.md): Guía rápida y presentación del proyecto.
- [documentation.md](documentation.md): Manual técnico y de usuario.
- Código fuente en las carpetas [app/](app/), [routes/](routes/), [resources/](resources/), etc.

---

## 16. Solución de Problemas

- Si encuentras errores, revisa los logs en `storage/logs/laravel.log`.
- Verifica que todas las dependencias estén correctamente instaladas.
- Asegúrate de que los servicios de base de datos y servidor web estén activos.
- Si tienes problemas con permisos, revisa la configuración de carpetas y archivos.

---

## 17. Recomendaciones de Seguridad

- No subas el archivo `.env` al repositorio.
- Cambia las contraseñas predeterminadas.
- Configura correctamente los permisos de archivos y carpetas.
- Mantén actualizado el framework y las dependencias.

---

## 18. Contacto y Soporte

Para dudas técnicas, incidencias o soporte, contacta al área de TI de la universidad o revisa la documentación oficial de Laravel en https://laravel.com/docs.

---

**¡Listo! El sistema debe estar funcionando y listo para su uso o desarrollo.**
