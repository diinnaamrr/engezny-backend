#!/bin/bash
# ===========================================
# نسخ الصور من Git مباشرة إلى السيرفر (Production)
# Run this script on the server: /var/www/nemo-tours-prod
# ===========================================

echo "📋 Copying images from Git repository to production server..."

cd /var/www/nemo-tours-prod

# Pull latest code from GitHub
echo "📥 Pulling latest code from GitHub..."
git fetch origin || true
git pull origin master || git pull origin main || true

# تأكد من وجود المجلد
mkdir -p ./public/landing-page/assets/img/clients

# نسخ الصور من git repository
echo "📁 Copying images from git repository..."
if [ -d "./public/landing-page/assets/img/clients" ]; then
    # التحقق من وجود الصور في git
    echo "🔍 Checking for images in git..."
    git ls-files public/landing-page/assets/img/clients/ | head -10
    
    # نسخ الصور من git working directory
    # الصور موجودة بالفعل في git pull، فقط تأكد من الصلاحيات
    echo "✅ Images should be in ./public/landing-page/assets/img/clients/"
else
    echo "❌ Directory not found in git repository"
fi

# التأكد من الصلاحيات
echo "🔐 Setting permissions..."
chown -R www-data:www-data ./public/landing-page/assets 2>/dev/null || chmod -R 755 ./public/landing-page/assets

# عرض الصور الموجودة
echo "📝 Current images in directory:"
ls -la ./public/landing-page/assets/img/clients/ | head -20

echo "✅ Done!"
