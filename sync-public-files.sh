#!/bin/bash
# ===========================================
# Sync public files from Docker image to host
# Run this script after pulling new image or when adding new images
# ===========================================

set -e

echo "🔄 Syncing public files from Docker image to host..."

# Check if container is running
if ! docker ps | grep -q nemotours_app_dev; then
    echo "⚠️  Container nemotours_app_dev is not running. Starting it first..."
    docker-compose -f docker-compose.dev.yml up -d app
    sleep 5
fi

# Create public directory if it doesn't exist
mkdir -p ./public/landing-page/assets/img

# Copy files from container to host
echo "📁 Copying landing-page assets..."
docker cp nemotours_app_dev:/var/www/html/public/landing-page/assets/. ./public/landing-page/assets/ 2>/dev/null || {
    echo "⚠️  Failed to copy from container. Trying alternative method..."
    # Alternative: use docker exec
    docker exec nemotours_app_dev sh -c "tar -czf - -C /var/www/html/public/landing-page/assets ." | tar -xzf - -C ./public/landing-page/assets/ 2>/dev/null || {
        echo "❌ Failed to sync files. Make sure container is running and has the files."
        exit 1
    }
}

# Copy other public static files
echo "📁 Copying other public static files..."
docker cp nemotours_app_dev:/var/www/html/public/. ./public/ 2>/dev/null || {
    echo "⚠️  Some files may not have been copied. Continuing..."
}

# Set proper permissions
echo "🔐 Setting permissions..."
chown -R www-data:www-data ./public 2>/dev/null || chmod -R 755 ./public

echo "✅ Public files synced successfully!"
echo "📝 Verify: ls -la ./public/landing-page/assets/img/"
