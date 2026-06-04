# Setup Guide

## Prerequisites

Before setting up Clacker, ensure you have the following installed:

### Required
- **PHP 8.1+** - Check with `php -v`
- **Composer** - PHP dependency manager, install from [getcomposer.org](https://getcomposer.org)
- **Node.js 16+** - Check with `node -v`
- **npm 8+** - Usually comes with Node.js
- **Git** - For cloning the repository

### Database
Choose one:
- **MySQL 8.0+**
- **PostgreSQL 12+**
- **SQLite 3** (for development)

## Installation Steps

### 1. Clone the Repository

```bash
git clone https://github.com/horobchenko/clacker.git
cd clacker
```

### 2. Install PHP Dependencies

```bash
composer install
```

This will install all PHP packages defined in `composer.json`.

### 3. Install JavaScript Dependencies

```bash
npm install
```

This will install all npm packages including React, Vite, and Tailwind CSS.

### 4. Environment Configuration

```bash
# Copy the example environment file
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

This generates a unique application key required by Laravel for encryption.

### 6. Database Setup

#### For MySQL:

```bash
# Create a new database
mysql -u root -p
> CREATE DATABASE clacker;
> EXIT;
```

Then update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clacker
DB_USERNAME=root
DB_PASSWORD=your_password
```

#### For PostgreSQL:

Update your `.env` file:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=clacker
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

#### For SQLite (Development):

Update your `.env` file:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/clacker/database/database.sqlite
```

### 7. Run Migrations

```bash
php artisan migrate
```

This creates all necessary database tables.

### 8. Seed Database (Optional)

```bash
php artisan db:seed
```

This populates the database with sample data.

## Development Environment

### Start Development Servers

```bash
npm run dev
```

This command:
- Starts Vite development server (usually on `http://localhost:5173`)
- Starts Laravel development server (usually on `http://localhost:8000`)
- Watches for file changes and hot-reloads

### Access the Application

Open your browser and navigate to:
```
http://localhost:8000
```

## Configuration Files

### Key Files to Review

- `.env` - Application configuration (database, mail, cache, etc.)
- `config/app.php` - Application name, timezone, locale
- `config/database.php` - Database connection settings
- `vite.config.js` - Vite build configuration
- `tailwind.config.js` - Tailwind CSS configuration

### Important Environment Variables

```env
APP_NAME=Clacker
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clacker
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync
```

## Troubleshooting

### Port Already in Use

If port 8000 is already in use:

```bash
php artisan serve --port=8001
```

### Database Connection Error

1. Check your `.env` file database credentials
2. Ensure database server is running
3. For MySQL: `mysql -u root -p -e "SHOW DATABASES;"`
4. For PostgreSQL: `psql -U postgres -l`

### Node Modules Issues

```bash
# Clear npm cache
npm cache clean --force

# Reinstall dependencies
rm -rf node_modules
npm install
```

### PHP/Composer Issues

```bash
# Update Composer
composer self-update

# Clear composer cache
composer clear-cache

# Reinstall dependencies
rm -rf vendor
composer install
```

## Production Deployment

For production setup, see [Deployment Guide](DEPLOYMENT.md).

## Next Steps

1. Review the [Development Guide](DEVELOPMENT.md)
2. Familiarize yourself with [Architecture Overview](ARCHITECTURE.md)
3. Check out the [Frontend Guide](FRONTEND.md)
4. Read the [API Documentation](API.md)
