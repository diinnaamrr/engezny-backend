#!/bin/bash
# ===========================================
# نسخ الصور من Docker Container إلى السيرفر
# Run this script on the server: /var/www/nemo-tours-dev
# ===========================================

echo "📋 Copying images from Docker container to server..."

# تأكد من وجود المجلد على السيرفر
mkdir -p /var/www/nemo-tours-dev/public/landing-page/assets/img

# نسخ الصور من الـ container إلى السيرفر
docker cp nemotours_app_dev:/var/www/html/public/landing-page/assets/img/. /var/www/nemo-tours-dev/public/landing-page/assets/img/

# التأكد من الصلاحيات
chown -R www-data:www-data /var/www/nemo-tours-dev/public/landing-page/assets/img
chmod -R 755 /var/www/nemo-tours-dev/public/landing-page/assets/img

echo "✅ Done! Images copied successfully."
echo "📝 Verify: ls -la /var/www/nemo-tours-dev/public/landing-page/assets/img/"
