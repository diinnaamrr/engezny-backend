# حل مشكلة 502 Bad Gateway لـ nemotours.duckdns.org

## المشكلة
الدومين `nemotours.duckdns.org` يعطي خطأ 502 Bad Gateway بالرغم من أن GitHub Actions لا يعطي أخطاء.

## الأسباب المحتملة

### 1. CloudPanel Nginx غير مُعد
إذا كان هناك CloudPanel Nginx على السيرفر، يجب أن يكون مُعد كـ reverse proxy لـ `nemotours.duckdns.org`.

### 2. الـ App Container غير شغال
الـ container `nemotours_app_dev` قد لا يكون شغال أو PHP-FPM قد لا يكون شغال.

### 3. مشكلة في الـ Network
مشكلة في الـ network connectivity بين nginx و app container.

## الحلول

### الحل 1: إعداد CloudPanel Nginx (إذا كان موجود)

```bash
# 1. نسخ ملف الإعداد
sudo cp cloudpanel-nginx-nemotours.conf /etc/nginx/sites-available/nemotours.duckdns.org

# 2. تفعيل الموقع
sudo ln -s /etc/nginx/sites-available/nemotours.duckdns.org /etc/nginx/sites-enabled/

# 3. التحقق من الإعداد
sudo nginx -t

# 4. إعادة تحميل Nginx
sudo systemctl reload nginx
```

### الحل 2: التحقق من حالة الـ Containers

```bash
# الانتقال إلى مجلد المشروع
cd /var/www/nemo-tours-dev

# التحقق من حالة الـ containers
docker ps -a | grep nemotours

# التحقق من الـ logs
docker logs nemotours_app_dev
docker logs nemotours_nginx_dev

# إعادة تشغيل الـ containers
docker-compose -f docker-compose.dev.yml restart

# أو إعادة تشغيل كامل
docker-compose -f docker-compose.dev.yml down
docker-compose -f docker-compose.dev.yml up -d
```

### الحل 3: التحقق من PHP-FPM

```bash
# التحقق من أن PHP-FPM شغال داخل الـ container
docker exec nemotours_app_dev ps aux | grep php-fpm

# التحقق من أن الـ port 9000 يستمع
docker exec nemotours_app_dev netstat -tulpn | grep 9000

# اختبار الاتصال من nginx container إلى app container
docker exec nemotours_nginx_dev ping nemotours_app_dev
docker exec nemotours_nginx_dev nc -zv nemotours_app_dev 9000
```

### الحل 4: التحقق من الـ Network

```bash
# التحقق من الـ networks
docker network ls | grep nemotours

# التحقق من أن الـ containers في نفس الـ network
docker network inspect nemotours-dev-network

# التحقق من الـ DNS resolution
docker exec nemotours_nginx_dev nslookup nemotours_app_dev
```

### الحل 5: التحقق من الـ Ports

```bash
# التحقق من أن port 8016 يستمع
netstat -tulpn | grep 8016

# اختبار الاتصال محلياً
curl -I http://127.0.0.1:8016

# اختبار من خارج السيرفر (إذا كان متاح)
curl -I http://nemotours.duckdns.org
```

### الحل 6: التحقق من الـ Nginx Configuration

```bash
# التحقق من إعدادات nginx داخل الـ container
docker exec nemotours_nginx_dev cat /etc/nginx/conf.d/default.conf

# اختبار إعدادات nginx
docker exec nemotours_nginx_dev nginx -t

# إعادة تحميل nginx داخل الـ container
docker exec nemotours_nginx_dev nginx -s reload
```

## خطوات التشخيص الكاملة

```bash
# 1. التحقق من حالة الـ containers
cd /var/www/nemo-tours-dev
docker-compose -f docker-compose.dev.yml ps

# 2. التحقق من الـ logs
docker-compose -f docker-compose.dev.yml logs app
docker-compose -f docker-compose.dev.yml logs nginx

# 3. التحقق من PHP-FPM
docker exec nemotours_app_dev php-fpm -v
docker exec nemotours_app_dev ps aux | grep php-fpm

# 4. اختبار الاتصال
docker exec nemotours_nginx_dev ping -c 3 nemotours_app_dev
docker exec nemotours_nginx_dev nc -zv nemotours_app_dev 9000

# 5. التحقق من الـ port
curl -I http://127.0.0.1:8016

# 6. إذا كان هناك CloudPanel Nginx
sudo nginx -t
sudo systemctl status nginx
sudo cat /etc/nginx/sites-enabled/nemotours.duckdns.org
```

## الحل السريع

```bash
cd /var/www/nemo-tours-dev

# إعادة تشغيل كامل
docker-compose -f docker-compose.dev.yml down
docker-compose -f docker-compose.dev.yml pull
docker-compose -f docker-compose.dev.yml up -d

# التحقق من الحالة
docker-compose -f docker-compose.dev.yml ps
docker-compose -f docker-compose.dev.yml logs --tail=50

# إذا كان هناك CloudPanel Nginx
sudo cp cloudpanel-nginx-nemotours.conf /etc/nginx/sites-available/nemotours.duckdns.org
sudo ln -sf /etc/nginx/sites-available/nemotours.duckdns.org /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx
```

## ملاحظات مهمة

1. **Port 8016**: تأكد من أن port 8016 غير مستخدم من قبل تطبيق آخر
2. **Network**: تأكد من أن جميع الـ containers في نفس الـ network (`nemotours-dev-network`)
3. **Container Names**: تأكد من أن أسماء الـ containers صحيحة (`nemotours_app_dev`, `nemotours_nginx_dev`)
4. **PHP-FPM**: تأكد من أن PHP-FPM شغال على port 9000 داخل الـ app container
5. **CloudPanel**: إذا كان هناك CloudPanel Nginx، يجب أن يكون مُعد كـ reverse proxy

## إذا استمرت المشكلة

1. تحقق من الـ logs بالتفصيل:
   ```bash
   docker logs nemotours_app_dev --tail=100
   docker logs nemotours_nginx_dev --tail=100
   sudo tail -100 /var/log/nginx/nemotours-error.log
   ```

2. تحقق من الـ .env file:
   ```bash
   cd /var/www/nemo-tours-dev
   cat .env | grep -E "APP_|DB_|REDIS_"
   ```

3. تحقق من الـ permissions:
   ```bash
   docker exec nemotours_app_dev ls -la /var/www/html/storage
   docker exec nemotours_app_dev ls -la /var/www/html/bootstrap/cache
   ```
