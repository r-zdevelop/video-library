# Video Management Application

Esta es una aplicación de Laravel con Tailwind y Livewire para administrar y ver videos, diseñada con roles para administradores y usuarios. Incluye puntos finales de API para enumerar, buscar y realizar un seguimiento de las estadísticas de video. Los videos se integran desde YouTube y permiten realizar un seguimiento de las estadísticas básicas de búsqueda y visualización.
## Features

- **Admin Role**: Administra la biblioteca de videos agregando, actualizando y eliminando videos.
- **User Role**: Busca, visualiza y reproduce vídeos con seguimiento de análisis básicos.
- **API Endpoints**: Lists, searches, and tracks analytics.
- **Technologies Used**: Laravel, Livewire, Tailwind CSS, Sanctum para autenticación, PHPUnit para pruebas.

## Requerimientos

- PHP 8.0+
- Composer
- Node.js & npm
- MySQL u otra base de datos compatible

## Installation

Siga estos pasos para configurar el proyecto en su máquina local.

### 1. Clone the Repository

```bash
git clone https://github.com/r-zdevelop/video-library
cd video-library
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies
```bash
npm install
```

### 4. Set Up Environment Variables
Cree un archivo `.env` copiando del archivo de ejemplo:
```bash
cp .env.example .env
```

Generate the application key:
```bash
php artisan key:generate
```

### 5. Configure the Database
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=video_library
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 6. Run Migrations and Seed the Database
Compile frontend assets with:
```bash
php artisan migrate --seed
```
The seeder will create sample videos and a default admin user with credentials below.

### 7. Build Frontend Assets
```bash
npm run dev
```

### 8. Run the Application
Start the Laravel development server:
```bash
composer run dev
```
The application should now be accessible at http://127.0.0.1:8000.

### 9. Default Admin Credentials
To access admin routes, log in with the following credentials:
- **Email**: `admin@admin.com`
- **Password**: `password`
It's recommended to change this password in a production environment.

## Tests
To verify functionality, use the following command to run the unit and feature tests:
```bash
php artisan test
```