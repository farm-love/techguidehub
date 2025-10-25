#!/bin/bash

# Railway startup script for Laravel
echo "🚀 Starting TechVerse Hub on Railway..."

# Get the port from Railway (default to 8080 if not set)
PORT="${PORT:-8080}"
echo "📡 Using port: $PORT"

# Run migrations
echo "📊 Running database migrations..."
php artisan migrate --force

# Clear and cache config
echo "🔧 Optimizing application..."
php artisan config:clear
php artisan config:cache

# Start PHP server
echo "🌐 Starting web server on 0.0.0.0:$PORT..."
php -S "0.0.0.0:${PORT}" -t public

