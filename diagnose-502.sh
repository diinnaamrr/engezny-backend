#!/bin/bash

# Script لتشخيص مشكلة 502 Bad Gateway لـ nemotours.duckdns.org

echo "=========================================="
echo "تشخيص مشكلة 502 Bad Gateway"
echo "=========================================="
echo ""

# 1. التحقق من حالة الـ containers
echo "1. التحقق من حالة الـ containers:"
echo "-----------------------------------"
cd /var/www/nemo-tours-dev 2>/dev/null || cd /var/www/nemo-tours 2>/dev/null || { echo "❌ لم يتم العثور على مجلد المشروع"; exit 1; }
docker-compose -f docker-compose.dev.yml ps
echo ""

# 2. التحقق من الـ logs
echo "2. آخر 20 سطر من logs الـ app container:"
echo "-----------------------------------"
docker logs nemotours_app_dev --tail=20 2>&1 || echo "❌ الـ container غير موجود"
echo ""

echo "3. آخر 20 سطر من logs الـ nginx container:"
echo "-----------------------------------"
docker logs nemotours_nginx_dev --tail=20 2>&1 || echo "❌ الـ container غير موجود"
echo ""

# 3. التحقق من PHP-FPM
echo "4. التحقق من PHP-FPM:"
echo "-----------------------------------"
if docker ps | grep -q nemotours_app_dev; then
    echo "✅ الـ container شغال"
    if docker exec nemotours_app_dev ps aux | grep -q php-fpm; then
        echo "✅ PHP-FPM شغال"
        docker exec nemotours_app_dev ps aux | grep php-fpm | head -3
    else
        echo "❌ PHP-FPM غير شغال!"
    fi
    echo ""
    echo "التحقق من port 9000:"
    docker exec nemotours_app_dev netstat -tulpn 2>/dev/null | grep 9000 || echo "⚠️  port 9000 غير مستمع"
else
    echo "❌ الـ container غير شغال!"
fi
echo ""

# 4. اختبار الاتصال
echo "5. اختبار الاتصال بين nginx و app:"
echo "-----------------------------------"
if docker ps | grep -q nemotours_nginx_dev && docker ps | grep -q nemotours_app_dev; then
    echo "اختبار ping:"
    docker exec nemotours_nginx_dev ping -c 2 nemotours_app_dev 2>&1 | head -5
    echo ""
    echo "اختبار port 9000:"
    docker exec nemotours_nginx_dev nc -zv nemotours_app_dev 9000 2>&1 || echo "❌ لا يمكن الاتصال بـ port 9000"
else
    echo "❌ أحد الـ containers غير شغال"
fi
echo ""

# 5. التحقق من الـ network
echo "6. التحقق من الـ network:"
echo "-----------------------------------"
docker network inspect nemotours-dev-network 2>/dev/null | grep -A 5 "Containers" || echo "❌ الـ network غير موجود"
echo ""

# 6. التحقق من port 8016
echo "7. التحقق من port 8016:"
echo "-----------------------------------"
if netstat -tulpn 2>/dev/null | grep -q 8016; then
    echo "✅ port 8016 مستمع"
    netstat -tulpn 2>/dev/null | grep 8016
else
    echo "❌ port 8016 غير مستمع"
fi
echo ""

# 7. اختبار الاتصال المحلي
echo "8. اختبار الاتصال المحلي:"
echo "-----------------------------------"
curl -I http://127.0.0.1:8016 2>&1 | head -10 || echo "❌ لا يمكن الاتصال بـ port 8016"
echo ""

# 8. التحقق من CloudPanel Nginx (إذا كان موجود)
echo "9. التحقق من CloudPanel Nginx:"
echo "-----------------------------------"
if systemctl is-active --quiet nginx 2>/dev/null; then
    echo "✅ CloudPanel Nginx شغال"
    if [ -f /etc/nginx/sites-enabled/nemotours.duckdns.org ]; then
        echo "✅ ملف الإعداد موجود"
        echo "محتوى الملف:"
        cat /etc/nginx/sites-enabled/nemotours.duckdns.org | head -20
    else
        echo "⚠️  ملف الإعداد غير موجود - يجب إعداده"
    fi
    echo ""
    echo "اختبار إعدادات nginx:"
    sudo nginx -t 2>&1
else
    echo "⚠️  CloudPanel Nginx غير شغال (قد يكون هذا طبيعي إذا لم يكن موجود)"
fi
echo ""

# 10. ملخص
echo "=========================================="
echo "ملخص التشخيص:"
echo "=========================================="
echo ""
echo "للتحقق من الـ logs بالتفصيل:"
echo "  docker logs nemotours_app_dev --tail=100"
echo "  docker logs nemotours_nginx_dev --tail=100"
echo ""
echo "لإعادة تشغيل الـ containers:"
echo "  cd /var/www/nemo-tours-dev"
echo "  docker-compose -f docker-compose.dev.yml restart"
echo ""
echo "لإعادة تشغيل كامل:"
echo "  cd /var/www/nemo-tours-dev"
echo "  docker-compose -f docker-compose.dev.yml down"
echo "  docker-compose -f docker-compose.dev.yml up -d"
echo ""
