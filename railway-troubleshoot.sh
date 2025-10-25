#!/bin/bash

echo "🔍 Railway Deployment Troubleshooting"
echo "======================================"
echo ""

echo "✅ Clearing all caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo ""
echo "✅ Running migrations..."
php artisan migrate --force

echo ""
echo "✅ Creating storage link..."
php artisan storage:link

echo ""
echo "✅ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

echo ""
echo "📊 Checking application status..."
echo "PHP Version: $(php -v | head -n 1)"
echo "Laravel Version: $(php artisan --version)"
echo ""

echo "🎉 Troubleshooting complete!"
echo ""
echo "If issues persist, check:"
echo "1. Railway logs: railway logs"
echo "2. Environment variables are set correctly"
echo "3. APP_KEY is generated and set"
echo "4. Database connection is working"

