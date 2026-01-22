#!/bin/bash
# ===========================================
# حل مشكلة الصور المفقودة على السيرفر
# Run this script on the server: /var/www/nemo-tours-dev
# ===========================================

set -e

echo "🔍 Checking current status..."

cd /var/www/nemo-tours-dev

# 1. التأكد من وجود آخر التحديثات من Git
echo "📥 Pulling latest changes from Git..."
git pull origin dev

# 2. التحقق من وجود الصور في Git
if [ -f "public/landing-page/assets/img/hero_bg.jpg" ]; then
    echo "✅ Images found in Git repository"
else
    echo "⚠️  Images not found in Git, copying from container..."
    
    # نسخ الصور من الـ container
    docker cp nemotours_app_dev:/var/www/html/public/landing-page/assets/img/. /var/www/nemo-tours-dev/public/landing-page/assets/img/ 2>/dev/null || {
        echo "❌ Failed to copy from container. Make sure container is running."
        exit 1
    }
fi

# 3. التأكد من الصلاحيات
echo "🔐 Setting correct permissions..."
chown -R www-data:www-data /var/www/nemo-tours-dev/public/landing-page/assets/img
chmod -R 755 /var/www/nemo-tours-dev/public/landing-page/assets/img

# 4. التحقق من وجود الصورة
if [ -f "/var/www/nemo-tours-dev/public/landing-page/assets/img/hero_bg.jpg" ]; then
    echo "✅ hero_bg.jpg exists on server"
    ls -lh /var/www/nemo-tours-dev/public/landing-page/assets/img/hero_bg.jpg
else
    echo "❌ hero_bg.jpg still missing!"
    exit 1
fi

# 5. إعادة تشغيل nginx للتأكد من التحديثات
echo "🔄 Restarting nginx..."
docker restart nemotours_nginx_dev

echo ""
echo "✅ Done! Images should now be accessible."
echo "📝 Test: curl -I https://nemotours.duckdns.org/landing-page/assets/img/hero_bg.jpg"
