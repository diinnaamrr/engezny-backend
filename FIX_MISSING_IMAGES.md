# حل مشكلة الصور المفقودة على السيرفر

## المشكلة
الصور موجودة في Docker image وتعمل محلياً، لكنها لا تظهر على السيرفر لأنها غير موجودة في المجلد المحلي `/var/www/nemo-tours-dev/public/landing-page/assets/img/`

## الحلول

### الحل السريع (مؤقت): نسخ الصور من Container

قم بتشغيل هذه الأوامر على السيرفر:

```bash
cd /var/www/nemo-tours-dev

# نسخ الصور من الـ container
docker cp nemotours_app_dev:/var/www/html/public/landing-page/assets/img/. /var/www/nemo-tours-dev/public/landing-page/assets/img/

# تعديل الصلاحيات
chown -R www-data:www-data /var/www/nemo-tours-dev/public/landing-page/assets/img
chmod -R 755 /var/www/nemo-tours-dev/public/landing-page/assets/img

# التحقق
ls -la /var/www/nemo-tours-dev/public/landing-page/assets/img/
```

### الحل الدائم: إضافة الصور إلى Git Repository

1. **تأكد من وجود الصور في المشروع المحلي:**
   ```bash
   ls -la public/landing-page/assets/img/
   ```

2. **أضف الصور إلى Git:**
   ```bash
   git add public/landing-page/assets/img/
   git commit -m "Add missing landing page images"
   git push origin dev
   ```

3. **على السيرفر، قم بـ pull التحديثات:**
   ```bash
   cd /var/www/nemo-tours-dev
   git pull origin dev
   ```

### الحل البديل: تعديل Volume Mapping

إذا كانت الصور موجودة فقط في Docker image ولا تريد إضافتها إلى Git، يمكنك تعديل `docker-compose.dev.yml`:

**تحذير:** هذا الحل سيجعل الصور تختفي عند إعادة بناء الـ container!

```yaml
nginx:
  volumes:
    - ./:/var/www/html
    # إضافة volume من الـ app container
    - nemotours_app_dev:/var/www/html:ro  # هذا لن يعمل مباشرة
```

**الحل الأفضل:** استخدم named volume مشترك:

```yaml
services:
  app:
    volumes:
      - public_images:/var/www/html/public/landing-page/assets/img
  
  nginx:
    volumes:
      - ./:/var/www/html
      - public_images:/var/www/html/public/landing-page/assets/img:ro

volumes:
  public_images:
    driver: local
```

## التحقق من الحل

بعد تطبيق أي حل، اختبر الصورة:
```bash
curl -I https://nemotours.duckdns.org/landing-page/assets/img/hero_bg.jpg
```

يجب أن يعطي `200 OK` بدلاً من `404 Not Found`.
