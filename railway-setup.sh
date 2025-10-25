#!/bin/bash

# Railway Setup Helper Script
# Run this locally before deploying to Railway

echo "🚂 Railway Deployment Setup"
echo "============================"
echo ""

# Generate APP_KEY
echo "📝 Generating APP_KEY..."
APP_KEY=$(php artisan key:generate --show)
echo "Generated: $APP_KEY"
echo ""

echo "✅ Copy this to Railway Variables:"
echo "-----------------------------------"
echo "APP_KEY=$APP_KEY"
echo ""

# Check for required files
echo "🔍 Checking deployment files..."

if [ -f "nixpacks.toml" ]; then
    echo "✅ nixpacks.toml found"
else
    echo "❌ nixpacks.toml missing"
fi

if [ -f "Procfile" ]; then
    echo "✅ Procfile found"
else
    echo "❌ Procfile missing"
fi

if [ -f "database/database.sqlite" ]; then
    echo "✅ SQLite database found"
else
    echo "⚠️  SQLite database not found - will be created on deployment"
fi

echo ""
echo "📋 Recommended Railway Variables:"
echo "-----------------------------------"
echo "APP_NAME=TechVerse Hub"
echo "APP_ENV=production"
echo "APP_KEY=$APP_KEY"
echo "APP_DEBUG=false"
echo "APP_URL=https://your-app.up.railway.app"
echo "DB_CONNECTION=sqlite"
echo "DB_DATABASE=/app/database/database.sqlite"
echo ""

echo "🚀 Next Steps:"
echo "-----------------------------------"
echo "1. Copy the variables above to Railway Dashboard"
echo "2. Update APP_URL with your actual Railway URL"
echo "3. Commit and push your code:"
echo "   git add ."
echo "   git commit -m 'Configure Railway deployment'"
echo "   git push origin main"
echo "4. Wait for Railway to deploy"
echo "5. Create admin user with: railway run php artisan tinker"
echo ""
echo "📚 Read RAILWAY_QUICK_START.md for detailed instructions"
echo ""

