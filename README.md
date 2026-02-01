<div align="center">
<img src="public/img/logo.svg" height="80px" width="auto" /> 
<h3>
Autoviaje - Laravel Edition
</h3>
<p>Sistema moderno de gestión de autorizaciones de viaje.</p>
</div>

<p></p>

<div align="center">

![Laravel Badge](https://img.shields.io/badge/Laravel-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP Badge](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)
![Tailwind CSS Badge](https://img.shields.io/badge/Tailwind%20CSS-06B6D4?logo=tailwindcss&logoColor=fff&style=flat)
![Alpine.js Badge](https://img.shields.io/badge/Alpine.js-8BC0D0?logo=alpine.js&logoColor=fff&style=flat)
![Vite Badge](https://img.shields.io/badge/Vite-646CFF?logo=vite&logoColor=fff&style=flat)

</div>

> [!IMPORTANT]
> Esta es la versión **evolucionada** del proyecto original. Incluye una interfaz mejorada, sistema de roles y exportación de documentos.

## ✨ Características Principales

- 🔐 **Gestión de Usuarios**: Sistema de roles (Administrador/Usuario) con middleware de seguridad.
- 📄 **Autorizaciones**: Creación, edición y seguimiento de permisos de viaje.
- 📤 **Exportación**: Generación de reportes en formatos Word y Excel.
- 🎨 **Interfaz Mejorada**: Diseño moderno con soporte nativo para **Modo Oscuro**.
- 🛠️ **Seguridad Flexible**: Compatibilidad con sistemas de hashing legacy (MD5/Plaintext) y moderno (Bcrypt).

## 🧞 Comandos de Instalación

Asegúrate de tener instalado PHP 8.2+, Composer y Node.js. Ejecuta estos comandos en la raíz:

| Comando | Acción |
| :--- | :--- |
| `composer install` | Instala las dependencias de PHP |
| `npm install` | Instala las dependencias de Frontend |
| `cp .env.example .env` | Crea tu archivo de configuración |
| `php artisan key:generate` | Genera la clave única de la aplicación |
| `php artisan migrate --seed` | Prepara la base de datos y crea el usuario admin |
| `npm run dev` | Inicia el servidor de compilación de Vite |
| `php artisan serve` | Inicia el servidor de desarrollo |

## 🚀 Credenciales por Defecto

Si has ejecutado el seeder (`--seed`), utiliza:
- **Usuario**: `admin`
- **Contraseña**: `admin`

## 👀 ¿Quieres ver la versión original?

Si buscas el código fuente heredado (Vanilla PHP), puedes encontrarlo en el repositorio [Autoviaje](https://github.com/RaiderMr3003/AutoViaje).
