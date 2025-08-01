#_SITIO WEB PARA OFICINA DE EMPLEO Y CAPACITACION DEL MUNICIPIO DE TRES ARROYOS_

![Texto alternativo](\EmprendedoresMuniTsAs\public\assets\img\iconos\logo-muni-azul-claro-removebg-preview.png)

## 📌 Objetivo

El sistema tiene como finalidad **visibilizar, registrar y gestionar los emprendimientos locales** y las propuestas de capacitación para la comunidad. Permite:

-   Mostrar perfiles de emprendedores y sus proyectos.
-   Cargar información institucional.
-   Publicar cursos y capacitaciones.
-   Administrar usuarios según roles (administrador, visitante).
-   Visualizar noticias y programas del municipio.

## 🧰 Tecnologías utilizadas

-   **Backend:** Laravel 4.2
-   **Frontend:** Blade, Bootstrap, HTML/CSS, JavaScript
-   **Base de datos:** MySQL
-   **Control de versiones:** Git y GitHub
-   **Servidor local:** Laragon

## 🚀 Instalación y ejecución

### Requisitos previos

-   PHP <= 8.1
-   Composer
-   Node.js + npm
-   MySQL o MariaDB
-   Laragon / XAMPP / WAMP

### Pasos

1. Clonar el repositorio:

    ```bash
    git clone https://github.com/ingridl23/EmprendedoresMuniTsAs.git
    cd EmprendedoresMuniTsAs
    ```

2. Instalar dependencias de laravel y Frontend

    ```bash
    composer install
    npm install && npm run dev
    ```

3. Configurar el entorno

```bash
 cp .env.example .env
```

4.Generar la clave de aplicacion y generar la base de datos

```bash
php artisan key:generate
php artisan migrate --seed
```

5.Levantar el Servidor

```bash
php artisan serve
```

## 📂 Estructura general

```
├── app/
   |_______http/
     |__ Controllers
     |__ Middleware
     |__ Requests
   |_______Mail/
   |_______Models/
     |__direccion
     |__Emprendedor
     |__Imagen
     |__noticias
     |__redes
     |__User
   |______Providers/
   |______View/
     |__Components
|__boostrap/
|__config/
├── database/
|__node_modules/
├── public/
├── resources/
│ ├── views/
│ ├── css/
│ └── js/
| |__ lang/
| |__ sass/
├── routes/
│ └── web.php
├── .env
└── README.md
```

### Dimensión determinada de las imagenes

Cada imagen tendrá como máximo de ancho : 1920px y de alto:1080px.
Se busca optimizar el manejo de las imagenes, tanto en la carga como en la muestra de estas en la vista.

-   PHP <= 8.1
-   Composer
-   Node.js + npm
-   MySQL o MariaDB
-   Laragon / XAMPP / WAMP

## 📚 Créditos

### Desarrollado por:

_Ingrid Ledesma – Pasante en la Municipalidad de Tres Arroyos_

_Valentina Castillo - Pasante en la Municipalidad de Tres Arroyos_

### Acompañamiento por personal de la Oficina de Empleo y Capacitaciones

### Carrera: TUDAI (Desarrollo de Aplicaciones Informáticas) – UNICEN

## ⚖️ Licencia

_Proyecto de uso institucional. Su distribución, copia o modificación está sujeta a autorización de la Municipalidad de Tres Arroyos y sus autores._
