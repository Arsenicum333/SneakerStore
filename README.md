# SneakerStore

Laravel 13 + Tailwind + Vite.

## Requirements

1. PHP 8.3+
2. Composer 2+
3. Node.js 20+ and npm
4. Git
5. Docker + Docker Compose

### Version check:

```bash
php -v
composer -V
node -v
npm -v
git --version
```

## First run

Run in the project root:

```bash
composer install
npm install
copy .env.example .env
docker compose up -d
php artisan key:generate
php artisan migrate
```

## Database connection (PostgreSQL)

This project uses PostgreSQL.

### Connection settings (`.env`)

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=iken
DB_USERNAME=user
DB_PASSWORD=password
```

## Run in dev mode

Start the app with one command:

```bash
composer run dev
```

## Update database

```bash
php artisan db:seed --class=ProductCatalogSeeder
```

This runs the Laravel server, queue listener, and Vite together. PostgreSQL should already be running with `docker compose up -d`.
