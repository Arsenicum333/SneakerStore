# SneakerStore

Laravel 13 + Tailwind + Vite.

## Requirements

1. PHP 8.3+
2. Composer 2+
3. Node.js 20+ and npm
4. Git

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
php artisan key:generate
php artisan migrate
```

## Database connection (PostgreSQL)

This project uses PostgreSQL.

### Connection settings (`.env`)

```env
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=iken
DB_USERNAME=user
DB_PASSWORD=password
```

### If you run with Docker Compose

The `db` service name in `docker-compose.yaml` is used as host (`DB_HOST=db`).

Run DB-related Artisan commands inside the app container:

```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan migrate:fresh
```

## Run in dev mode

### Option 1 (two terminals):

**Terminal 1:**
```bash
php artisan serve
```

**Terminal 2:**
```bash
npm run dev
```

Open: [http://127.0.0.1:8000](http://127.0.0.1:8000)

### Option 2 (single command, all in one):

```bash
composer run dev
```

## Useful commands

### Tests
```bash
php artisan test
```

### Production frontend build
```bash
npm run build
```