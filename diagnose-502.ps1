# PowerShell Script لتشخيص مشكلة 502 Bad Gateway لـ nemotours.duckdns.org

Write-Host "==========================================" -ForegroundColor Cyan
Write-Host "تشخيص مشكلة 502 Bad Gateway" -ForegroundColor Cyan
Write-Host "==========================================" -ForegroundColor Cyan
Write-Host ""

# 1. التحقق من حالة الـ containers
Write-Host "1. التحقق من حالة الـ containers:" -ForegroundColor Yellow
Write-Host "-----------------------------------" -ForegroundColor Yellow
$projectPath = "C:\Users\G3\Downloads\nemo tours"
if (Test-Path $projectPath) {
    Set-Location $projectPath
    docker-compose -f docker-compose.dev.yml ps
} else {
    Write-Host "❌ لم يتم العثور على مجلد المشروع" -ForegroundColor Red
}
Write-Host ""

# 2. التحقق من الـ logs
Write-Host "2. آخر 20 سطر من logs الـ app container:" -ForegroundColor Yellow
Write-Host "-----------------------------------" -ForegroundColor Yellow
docker logs nemotours_app_dev --tail=20 2>&1
if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ الـ container غير موجود" -ForegroundColor Red
}
Write-Host ""

Write-Host "3. آخر 20 سطر من logs الـ nginx container:" -ForegroundColor Yellow
Write-Host "-----------------------------------" -ForegroundColor Yellow
docker logs nemotours_nginx_dev --tail=20 2>&1
if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ الـ container غير موجود" -ForegroundColor Red
}
Write-Host ""

# 3. التحقق من PHP-FPM
Write-Host "4. التحقق من PHP-FPM:" -ForegroundColor Yellow
Write-Host "-----------------------------------" -ForegroundColor Yellow
$appRunning = docker ps --format "{{.Names}}" | Select-String "nemotours_app_dev"
if ($appRunning) {
    Write-Host "✅ الـ container شغال" -ForegroundColor Green
    $phpFpm = docker exec nemotours_app_dev ps aux 2>&1 | Select-String "php-fpm"
    if ($phpFpm) {
        Write-Host "✅ PHP-FPM شغال" -ForegroundColor Green
        $phpFpm | Select-Object -First 3
    } else {
        Write-Host "❌ PHP-FPM غير شغال!" -ForegroundColor Red
    }
} else {
    Write-Host "❌ الـ container غير شغال!" -ForegroundColor Red
}
Write-Host ""

# 4. اختبار الاتصال
Write-Host "5. اختبار الاتصال بين nginx و app:" -ForegroundColor Yellow
Write-Host "-----------------------------------" -ForegroundColor Yellow
$nginxRunning = docker ps --format "{{.Names}}" | Select-String "nemotours_nginx_dev"
if ($nginxRunning -and $appRunning) {
    Write-Host "اختبار ping:" -ForegroundColor Cyan
    docker exec nemotours_nginx_dev ping -c 2 nemotours_app_dev 2>&1 | Select-Object -First 5
} else {
    Write-Host "❌ أحد الـ containers غير شغال" -ForegroundColor Red
}
Write-Host ""

# 5. التحقق من port 8016
Write-Host "6. التحقق من port 8016:" -ForegroundColor Yellow
Write-Host "-----------------------------------" -ForegroundColor Yellow
$port8016 = netstat -ano | Select-String ":8016"
if ($port8016) {
    Write-Host "✅ port 8016 مستمع" -ForegroundColor Green
    $port8016
} else {
    Write-Host "❌ port 8016 غير مستمع" -ForegroundColor Red
}
Write-Host ""

# 6. اختبار الاتصال المحلي
Write-Host "7. اختبار الاتصال المحلي:" -ForegroundColor Yellow
Write-Host "-----------------------------------" -ForegroundColor Yellow
try {
    $response = Invoke-WebRequest -Uri "http://127.0.0.1:8016" -Method Head -TimeoutSec 5 -ErrorAction Stop
    Write-Host "✅ يمكن الاتصال بـ port 8016" -ForegroundColor Green
    $response.Headers
} catch {
    Write-Host "❌ لا يمكن الاتصال بـ port 8016" -ForegroundColor Red
    Write-Host $_.Exception.Message
}
Write-Host ""

Write-Host "==========================================" -ForegroundColor Cyan
Write-Host "ملخص التشخيص:" -ForegroundColor Cyan
Write-Host "==========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "للتحقق من الـ logs بالتفصيل:" -ForegroundColor Yellow
Write-Host "  docker logs nemotours_app_dev --tail=100"
Write-Host "  docker logs nemotours_nginx_dev --tail=100"
Write-Host ""
Write-Host "لإعادة تشغيل الـ containers:" -ForegroundColor Yellow
Write-Host "  docker-compose -f docker-compose.dev.yml restart"
Write-Host ""
Write-Host "لإعادة تشغيل كامل:" -ForegroundColor Yellow
Write-Host "  docker-compose -f docker-compose.dev.yml down"
Write-Host "  docker-compose -f docker-compose.dev.yml up -d"
Write-Host ""
