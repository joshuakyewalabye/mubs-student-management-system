# MUBS Student Management System

A Laravel-based student administration system for MUBS (Makerere University Business School), built to manage students, courses, and student course registrations with role-based access control.

## Overview

This project includes:

- Student management
- Course creation and editing
- Student course registration flow
- Dashboard overview for authenticated users
- Role-based permissions for administrators, lecturers, and students
- SQLite-ready setup for local development

## Tech stack

- PHP 8.4.1+
- Laravel 13
- Composer
- Node.js + npm
- Vite for frontend assets
- Spatie Laravel Permission

## Project structure

- `app/` – application logic, controllers, models, providers
- `database/migrations/` – schema definitions
- `database/seeders/` – seed data for users and roles
- `resources/views/` – Blade templates
- `routes/web.php` – application routes
- `public/` – publicly served assets

## Prerequisites

Before starting, make sure your machine has:

- PHP 8.4.1 or newer
- Composer
- Node.js 18+ and npm
- A local terminal with access to the project folder

Check your versions:

```bash
php -v
composer -V
node -v
npm -v
```

## Installation

1. Clone the repository:

```bash
git clone https://github.com/joshuakyewalabye/mubs-student-management-system.git
cd mubs-student-management-system
```

2. Install PHP dependencies:

```bash
composer install
```

3. Create your environment file:

```bash
cp .env.example .env
```

The project is configured for SQLite by default in `.env.example`, so no database server setup is required for local development.

4. Generate the application key:

```bash
php artisan key:generate
```

5. Run the database migrations and seed sample users:

```bash
php artisan migrate --seed
```

6. Install frontend dependencies:

```bash
npm install
```

7. Build the frontend assets:

```bash
npm run build
```

## Run the app

Start the Laravel development server:

```bash
php artisan serve
```

Then open the app in your browser at:

```text
http://localhost:8000
```

If you want the frontend to rebuild automatically while developing, run:

```bash
npm run dev
```

## Default login credentials

The database seeders create sample users with a common password:

```text
Password: password
```

Example seeded accounts include:

- admin@mubs.ac.ug
- bashir.mutebi@mubs.ac.ug
- mosh.gyagenda@mubs.ac.ug
- mathew.matovu@mubs.ac.ug
- joshua.kyewalabye@mubs.ac.ug

Use the admin account for full access during testing:

```text
Email: admin@mubs.ac.ug
Password: password
```

## Useful commands

Reset the database:

```bash
php artisan migrate:fresh --seed
```

Clear configuration cache:

```bash
php artisan config:clear
```

Run the test suite:

```bash
php artisan test
```

## Notes

- The app uses `database/database.sqlite` for the default SQLite setup.
- If you want to use MySQL instead, update the `DB_` values in `.env`.
- Role permissions are handled through Spatie Laravel Permission.

## License

This project is open-source and uses the MIT license.
