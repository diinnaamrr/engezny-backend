# إعداد البيئة المحلية (Local Development)

هذا الدليل يوضح كيفية إعداد وتشغيل المشروع محلياً للتطوير والتعديل.

## المتطلبات

- Docker Desktop مثبت على Windows
- Git

## الإعداد السريع

### 1. نسخ ملف البيئة

```powershell
copy .env.example .env
```

### 2. تعديل ملف `.env`

تأكد من وجود الإعدادات التالية في ملف `.env`:

```env
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=nemotours_db_local
DB_USERNAME=nemotours
DB_PASSWORD=nemotours123

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 3. تشغيل الحاويات

```powershell
docker-compose -f docker-compose.local.yml up -d --build
```

أو استخدام السكريبت:

```powershell
.\local-setup.ps1 build
```

### 4. تثبيت المكتبات

```powershell
docker-compose -f docker-compose.local.yml exec app composer install
```

### 5. توليد مفتاح التطبيق

```powershell
docker-compose -f docker-compose.local.yml exec app php artisan key:generate
```

### 6. تشغيل قاعدة البيانات

```powershell
docker-compose -f docker-compose.local.yml exec app php artisan migrate
```

أو باستخدام السكريبت:

```powershell
.\local-setup.ps1 migrate
```

### 7. تعديل الصلاحيات (إذا لزم الأمر)

```powershell
docker-compose -f docker-compose.local.yml exec app chmod -R 775 storage bootstrap/cache
docker-compose -f docker-compose.local.yml exec app chown -R www-data:www-data storage bootstrap/cache
```

## الوصول للتطبيق

- **التطبيق**: http://localhost:8017
- **قاعدة البيانات MySQL**: localhost:3308
- **Redis**: localhost:6381

## استخدام السكريبت المساعد

يمكنك استخدام `local-setup.ps1` لتسهيل العمليات:

```powershell
# تشغيل الحاويات
.\local-setup.ps1 start

# إيقاف الحاويات
.\local-setup.ps1 stop

# إعادة تشغيل الحاويات
.\local-setup.ps1 restart

# عرض السجلات
.\local-setup.ps1 logs

# الدخول إلى الحاوية
.\local-setup.ps1 shell

# تشغيل أمر artisan
.\local-setup.ps1 artisan migrate
.\local-setup.ps1 artisan cache:clear

# عرض حالة الحاويات
.\local-setup.ps1 status

# بناء الحاويات
.\local-setup.ps1 build
```

## الأوامر الشائعة

### تشغيل الحاويات
```powershell
docker-compose -f docker-compose.local.yml up -d
```

### إيقاف الحاويات
```powershell
docker-compose -f docker-compose.local.yml down
```

### عرض السجلات
```powershell
docker-compose -f docker-compose.local.yml logs -f app
docker-compose -f docker-compose.local.yml logs -f nginx
```

### تنفيذ أوامر Artisan
```powershell
docker-compose -f docker-compose.local.yml exec app php artisan [command]
```

### الدخول إلى الحاوية
```powershell
docker-compose -f docker-compose.local.yml exec app bash
```

### مسح الكاش
```powershell
docker-compose -f docker-compose.local.yml exec app php artisan cache:clear
docker-compose -f docker-compose.local.yml exec app php artisan config:clear
docker-compose -f docker-compose.local.yml exec app php artisan route:clear
docker-compose -f docker-compose.local.yml exec app php artisan view:clear
```

## المميزات

- ✅ التعديلات على الملفات تظهر فوراً (Hot Reload)
- ✅ منفصل تماماً عن بيئة dev و production
- ✅ يستخدم Build محلي (ليس من Docker Hub)
- ✅ Ports منفصلة لتجنب التعارض:
  - Web: 8017 (local) vs 8016 (dev) vs 8015 (prod)
  - MySQL: 3308 (local) vs 3307 (default) vs internal (prod)
  - Redis: 6381 (local) vs 6380 (default) vs internal (prod)

## حل المشاكل

### مشاكل الصلاحيات
```powershell
docker-compose -f docker-compose.local.yml exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose -f docker-compose.local.yml exec app chmod -R 775 storage bootstrap/cache
```

### مشاكل الاتصال بقاعدة البيانات
تأكد من أن `DB_HOST=db` في ملف `.env` (وليس `localhost` أو `127.0.0.1`)

### تعارض البورتات
إذا كان البورت 8017 مستخدماً، يمكنك تغييره في `docker-compose.local.yml`

### إعادة البناء من الصفر
```powershell
docker-compose -f docker-compose.local.yml down -v
docker-compose -f docker-compose.local.yml up -d --build
```

## الفرق بين البيئات

| الميزة | Local | Dev | Production |
|--------|-------|-----|------------|
| Build | محلي | من ghcr.io | من ghcr.io |
| Port | 8017 | 8016 | 8015 |
| Hot Reload | ✅ | ❌ | ❌ |
| Debug | ✅ | ✅ | ❌ |
| Database Port | 3308 | 3307 | Internal |
| Redis Port | 6381 | 6380 | Internal |
