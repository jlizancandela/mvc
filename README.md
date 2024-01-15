# Proyecto Tienda de Ropa MVC con PHP, Twig y Tailwind

Este proyecto es una aplicación web de una tienda de ropa desarrollada utilizando el patrón de diseño Modelo Vista Controlador (MVC) con PHP, Twig y Tailwind CSS.

## Estructura del Proyecto

El proyecto sigue la estructura MVC para organizar el código de manera clara y modular:

- **app/**: Contiene la lógica de la aplicación.
  - **Controllers/**: Controladores que manejan las solicitudes del usuario.
  - **Models/**: Modelos que interactúan con la base de datos.
  - **Views/**: Vistas que muestran la interfaz de usuario.
- **public/**: Contiene archivos públicos accesibles desde el navegador.
  - **img/**: Imágenes utilizadas en la aplicación.
  - **media/**: Videos utilizadas en la aplicación.
- **js/**: Archivos JavaScript necesarios.
- **templates/**: Plantillas Twig para las vistas.

## Configuración

1. Clona el repositorio: `git clone https://github.com/tu_usuario/tienda-ropa.git`
2. Configura la conexión a la base de datos en `app/config/database_config.php`.
3. Instala las dependencias con Composer: `composer install`

## Uso

1. Inicia el servidor PHP: `php -S localhost:8000 -t public`
2. Abre tu navegador y visita [http://localhost:8000](http://localhost:8000)

## Requisitos del Sistema

- PHP 7.4 o superior
- Composer
- Node.js y npm (para Tailwind CSS)

## Dependencias

- [Twig](https://twig.symfony.com): Motor de plantillas para PHP.
- [Tailwind CSS](https://tailwindcss.com): Framework CSS utilizable a nivel de componentes.
