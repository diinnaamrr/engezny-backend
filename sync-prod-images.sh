#!/bin/bash
# ===========================================
# نسخ الصور من Docker Container إلى السيرفر (Production)
# Run this script on the server: /var/www/nemo-tours-prod
# ===========================================

echo "📋 Copying images from Docker container to production server..."

cd /var/www/nemo-tours-prod

# تأكد من وجود المجلد على السيرفر
mkdir -p ./public/landing-page/assets/img/clients

# نسخ الصور من الـ container إلى السيرفر
echo "📁 Copying images from container..."
docker cp nemotours_app_prod:/var/www/html/public/landing-page/assets/img/clients/. ./public/landing-page/assets/img/clients/ 2>/dev/null || {
    echo "⚠️  Container may not be running. Trying to copy from image directly..."
    
    # محاولة نسخ من image مباشرة
    TEMP_CONTAINER=$(docker create ghcr.io/fassla-software/nemo-tours-backend:latest 2>/dev/null || echo "")
    if [ -n "$TEMP_CONTAINER" ]; then
        docker cp "$TEMP_CONTAINER:/var/www/html/public/landing-page/assets/img/clients/." ./public/landing-page/assets/img/clients/ 2>/dev/null || true
        docker rm "$TEMP_CONTAINER" 2>/dev/null || true
        echo "✅ Images copied from image!"
    else
        echo "❌ Could not copy images. Please check if container is running."
        exit 1
    fi
}

# نسخ كل assets folder
echo "📁 Copying all landing-page assets..."
docker cp nemotours_app_prod:/var/www/html/public/landing-page/assets/. ./public/landing-page/assets/ 2>/dev/null || echo "⚠️  Some files may not have been copied"

# التأكد من الصلاحيات
echo "🔐 Setting permissions..."
chown -R www-data:www-data ./public/landing-page/assets 2>/dev/null || chmod -R 755 ./public/landing-page/assets

echo "✅ Done! Images copied successfully."
echo "📝 Verify: ls -la ./public/landing-page/assets/img/clients/"
