# Docker Setup Guide

This guide will help you set up and run the Laravel application using Docker.

## Prerequisites

- Docker Desktop (Windows/Mac) or Docker Engine + Docker Compose (Linux)
- Git

## Environments

This project supports three different environments:

- **Local**: For local development with hot-reload (`docker-compose.local.yml`)
- **Dev**: Development environment using pre-built images (`docker-compose.dev.yml`)
- **Production**: Production environment (`docker-compose.prod.yml`)

## Local Development Setup (Recommended for Local Editing)

This setup allows you to edit files locally and see changes immediately.

1. **Copy environment file** (if not already present):
   ```bash
   cp .env.example .env
   ```

2. **Update your `.env` file** with the following database configuration:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=nemotours_db_local
   DB_USERNAME=nemotours
   DB_PASSWORD=nemotours123
   
   REDIS_HOST=redis
   REDIS_PASSWORD=null
   REDIS_PORT=6379
   
   APP_ENV=local
   APP_DEBUG=true
   ```

3. **Build and start the local containers**:
   ```bash
   docker-compose -f docker-compose.local.yml up -d --build
   ```

4. **Install PHP dependencies**:
   ```bash
   docker-compose -f docker-compose.local.yml exec app composer install
   ```

5. **Generate application key**:
   ```bash
   docker-compose -f docker-compose.local.yml exec app php artisan key:generate
   ```

6. **Run database migrations**:
   ```bash
   docker-compose -f docker-compose.local.yml exec app php artisan migrate
   ```

7. **Set proper permissions** (if needed):
   ```bash
   docker-compose -f docker-compose.local.yml exec app chmod -R 775 storage bootstrap/cache
   docker-compose -f docker-compose.local.yml exec app chown -R www-data:www-data storage bootstrap/cache
   ```

**Access the Local Application**: http://localhost:8017

## Quick Start (Default/Dev)

1. **Copy environment file** (if not already present):
   ```bash
   cp .env.example .env
   ```

2. **Update your `.env` file** with the following database configuration:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=wayak_db
   DB_USERNAME=wayak_user
   DB_PASSWORD=root
   
   REDIS_HOST=redis
   REDIS_PASSWORD=null
   REDIS_PORT=6379
   ```

3. **Build and start the containers**:
   ```bash
   docker-compose up -d --build
   ```

4. **Install PHP dependencies**:
   ```bash
   docker-compose exec app composer install
   ```

5. **Generate application key**:
   ```bash
   docker-compose exec app php artisan key:generate
   ```

6. **Run database migrations**:
   ```bash
   docker-compose exec app php artisan migrate
   ```

7. **Install and build frontend assets**:
   ```bash
   docker-compose exec node npm install
   docker-compose exec node npm run dev
   ```

8. **Set proper permissions** (if needed):
   ```bash
   docker-compose exec app chmod -R 775 storage bootstrap/cache
   docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
   ```

## Access the Application

### Local Environment
- **Web Application**: http://localhost:8017
- **MySQL Database**: localhost:3308
- **Redis**: localhost:6381

### Dev Environment
- **Web Application**: http://localhost:8016
- **MySQL Database**: localhost:3307 (if exposed)
- **Redis**: localhost:6380 (if exposed)

### Production Environment
- **Web Application**: http://localhost:8015
- **MySQL Database**: localhost (internal only)
- **Redis**: localhost (internal only)

## Common Commands

### Local Environment Commands

#### Start local containers
```bash
docker-compose -f docker-compose.local.yml up -d
```

#### Stop local containers
```bash
docker-compose -f docker-compose.local.yml down
```

#### View local logs
```bash
docker-compose -f docker-compose.local.yml logs -f app
docker-compose -f docker-compose.local.yml logs -f nginx
```

#### Execute Artisan commands (local)
```bash
docker-compose -f docker-compose.local.yml exec app php artisan [command]
```

#### Access local container shell
```bash
docker-compose -f docker-compose.local.yml exec app bash
```

### General Commands (Default/Dev)

### Start containers
```bash
docker-compose up -d
# or for dev:
docker-compose -f docker-compose.dev.yml up -d
```

### Stop containers
```bash
docker-compose down
# or for dev:
docker-compose -f docker-compose.dev.yml down
```

### View logs
```bash
docker-compose logs -f app
docker-compose logs -f nginx
```

### Execute Artisan commands
```bash
docker-compose exec app php artisan [command]
```

### Access container shell
```bash
docker-compose exec app bash
```

### Run database migrations
```bash
docker-compose exec app php artisan migrate
```

### Run database seeders
```bash
docker-compose exec app php artisan db:seed
```

### Clear application cache
```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

### Rebuild containers
```bash
docker-compose down
docker-compose up -d --build
```

## Services

### Local Environment
- **app**: PHP-FPM 8.2 application container (built locally)
- **nginx**: Web server (port 8017)
- **db**: MySQL 8.0 database (port 3308)
- **redis**: Redis cache/queue service (port 6381)

### Dev Environment
- **app**: PHP-FPM 8.2 application container (from ghcr.io)
- **nginx**: Web server (port 8016)
- **db**: MySQL 8.0 database
- **redis**: Redis cache/queue service

### Production Environment
- **app**: PHP-FPM 8.2 application container (from ghcr.io)
- **nginx**: Web server (port 8015)
- **db**: MySQL 8.0 database
- **redis**: Redis cache/queue service

## Troubleshooting

### Permission Issues
If you encounter permission issues with storage or cache directories:
```bash
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

### Database Connection Issues
Ensure your `.env` file has the correct database host (`db` instead of `localhost` or `127.0.0.1`).

### Port Conflicts
If port 8000, 3306, or 6379 are already in use, modify the ports in `docker-compose.yml`.

### Clear Everything and Start Fresh
```bash
docker-compose down -v
docker-compose up -d --build
```

## Production Considerations

For production deployment, consider:
- Using environment-specific `.env` files
- Setting up proper SSL/TLS certificates
- Configuring proper database backups
- Using managed database services
- Setting up proper logging and monitoring
- Optimizing PHP-FPM and Nginx configurations
- Using multi-stage builds for smaller images

