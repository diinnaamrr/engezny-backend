# Local Development Environment Setup Script
# This script helps you set up and manage the local development environment

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "Nemo Tours - Local Development Setup" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

$action = $args[0]

if (-not $action) {
    Write-Host "Usage: .\local-setup.ps1 [start|stop|restart|logs|shell|artisan|migrate|status]" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "Commands:" -ForegroundColor Green
    Write-Host "  start    - Start local containers"
    Write-Host "  stop     - Stop local containers"
    Write-Host "  restart  - Restart local containers"
    Write-Host "  logs     - Show container logs"
    Write-Host "  shell    - Access app container shell"
    Write-Host "  artisan  - Run artisan command (e.g., .\local-setup.ps1 artisan migrate)"
    Write-Host "  migrate  - Run database migrations"
    Write-Host "  status   - Show container status"
    Write-Host "  build    - Build containers"
    exit
}

switch ($action) {
    "start" {
        Write-Host "Starting local containers..." -ForegroundColor Green
        docker-compose -f docker-compose.local.yml up -d
        Write-Host ""
        Write-Host "Local environment is running at: http://localhost:8017" -ForegroundColor Cyan
    }
    "stop" {
        Write-Host "Stopping local containers..." -ForegroundColor Yellow
        docker-compose -f docker-compose.local.yml down
    }
    "restart" {
        Write-Host "Restarting local containers..." -ForegroundColor Yellow
        docker-compose -f docker-compose.local.yml restart
    }
    "logs" {
        Write-Host "Showing logs (Press Ctrl+C to exit)..." -ForegroundColor Green
        docker-compose -f docker-compose.local.yml logs -f
    }
    "shell" {
        Write-Host "Accessing app container shell..." -ForegroundColor Green
        docker-compose -f docker-compose.local.yml exec app bash
    }
    "artisan" {
        $artisanCmd = $args[1..($args.Length - 1)] -join " "
        if (-not $artisanCmd) {
            Write-Host "Please provide an artisan command" -ForegroundColor Red
            Write-Host "Example: .\local-setup.ps1 artisan migrate" -ForegroundColor Yellow
            exit
        }
        Write-Host "Running: php artisan $artisanCmd" -ForegroundColor Green
        docker-compose -f docker-compose.local.yml exec app php artisan $artisanCmd
    }
    "migrate" {
        Write-Host "Running database migrations..." -ForegroundColor Green
        docker-compose -f docker-compose.local.yml exec app php artisan migrate
    }
    "status" {
        Write-Host "Container Status:" -ForegroundColor Cyan
        docker-compose -f docker-compose.local.yml ps
    }
    "build" {
        Write-Host "Building local containers..." -ForegroundColor Green
        docker-compose -f docker-compose.local.yml up -d --build
        Write-Host ""
        Write-Host "Local environment is running at: http://localhost:8017" -ForegroundColor Cyan
    }
    default {
        Write-Host "Unknown command: $action" -ForegroundColor Red
        Write-Host "Run .\local-setup.ps1 without arguments to see available commands" -ForegroundColor Yellow
    }
}
