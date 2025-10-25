# 🚂 Railway.app Deployment Guide

## Prerequisites

- Railway.app account
- GitHub repository connected to Railway
- Railway CLI (optional but recommended)

## Step 1: Required Environment Variables in Railway

Go to your Railway project → Variables and add these:

### Essential Variables

```env
# Application
APP_NAME="TechVerse Hub"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-railway-app.up.railway.app

# Generate a new key using: php artisan key:generate
APP_KEY=base64:your_generated_key_here

# Database (Railway PostgreSQL)
# These are automatically provided by Railway when you add PostgreSQL
# DB_CONNECTION=pgsql
# DB_HOST=${{PGHOST}}
# DB_PORT=${{PGPORT}}
# DB_DATABASE=${{PGDATABASE}}
# DB_USERNAME=${{PGUSER}}
# DB_PASSWORD=${{PGPASSWORD}}

# Or use SQLite (simpler for small projects)
DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=database

# Mail (Optional - for contact form)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@techversehub.com"
MAIL_FROM_NAME="${APP_NAME}"

# OpenAI (Optional - if using AI features)
OPENAI_API_KEY=your_openai_key_here

# OAuth (Optional - for social login)
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_secret
GOOGLE_REDIRECT_URI=${APP_URL}/auth/google/callback

GITHUB_CLIENT_ID=your_github_client_id
GITHUB_CLIENT_SECRET=your_github_secret
GITHUB_REDIRECT_URI=${APP_URL}/auth/github/callback
```

## Step 2: Set Up Database in Railway

### Option A: SQLite (Recommended for testing)

1. Add this variable:
```
DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite
```

2. Make sure `database/database.sqlite` exists in your repo

### Option B: PostgreSQL (Recommended for production)

1. In Railway dashboard, click **"+ New"** → **"Database"** → **"PostgreSQL"**
2. Railway will automatically create these variables:
   - `PGHOST`
   - `PGPORT`
   - `PGDATABASE`
   - `PGUSER`
   - `PGPASSWORD`

3. Add these to reference the PostgreSQL variables:
```
DB_CONNECTION=pgsql
DB_HOST=${{PGHOST}}
DB_PORT=${{PGPORT}}
DB_DATABASE=${{PGDATABASE}}
DB_USERNAME=${{PGUSER}}
DB_PASSWORD=${{PGPASSWORD}}
```

## Step 3: Generate APP_KEY

### Locally:
```bash
php artisan key:generate --show
```

Copy the output and add it to Railway variables as `APP_KEY`

### Using Railway CLI:
```bash
railway run php artisan key:generate --show
```

## Step 4: Update APP_URL

After deployment, Railway gives you a URL like:
```
https://your-app-name.up.railway.app
```

Update the `APP_URL` variable in Railway with this URL.

## Step 5: Set Up Storage

Since Railway uses ephemeral storage, you have 2 options:

### Option A: Use Public Directory (Simple)
Store uploaded files in `public/uploads` (already gitignored)

### Option B: Use External Storage (Recommended)
Use AWS S3, Cloudinary, or other cloud storage.

Update `config/filesystems.php` and add credentials to Railway variables.

## Step 6: Deploy

### Automatic Deployment (Recommended)

Railway automatically deploys when you push to GitHub:

```bash
git add .
git commit -m "Configure for Railway deployment"
git push origin main
```

### Manual Deployment

```bash
railway up
```

## Step 7: Run Migrations

Railway should automatically run migrations with the updated `nixpacks.toml`, but if needed:

```bash
# Using Railway CLI
railway run php artisan migrate --force

# Or add to Railway variables
RAILWAY_RUN_MIGRATIONS=true
```

## Step 8: Create Admin User

After deployment, create your first admin user:

```bash
railway run php artisan tinker

# Then in tinker:
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@yourdomain.com',
    'password' => bcrypt('your-secure-password'),
    'role' => 'admin',
    'email_verified_at' => now()
]);
```

## Common Issues & Solutions

### Issue 1: 500 Error

**Solution:** Check logs
```bash
railway logs
```

Common causes:
- Missing `APP_KEY`
- Wrong database configuration
- Cache issues

Fix:
```bash
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan view:clear
```

### Issue 2: "No supported encrypter found"

**Solution:** Generate and set APP_KEY
```bash
php artisan key:generate --show
```
Add to Railway variables

### Issue 3: Database connection failed

**Solution:** 
- Verify database variables are correct
- Check if PostgreSQL service is running
- Try SQLite instead for testing

### Issue 4: Assets not loading (CSS/JS)

**Solution:**
1. Ensure `npm run build` runs in nixpacks.toml ✅ (already added)
2. Check if `public/build` directory exists
3. Update `APP_URL` to match Railway URL
4. Clear cache:
```bash
railway run php artisan config:clear
```

### Issue 5: Storage link not working

**Solution:**
```bash
railway run php artisan storage:link
```

### Issue 6: Migrations not running

**Solution:** The `nixpacks.toml` now includes migration in start command
Or run manually:
```bash
railway run php artisan migrate --force
```

### Issue 7: "Class not found" errors

**Solution:**
```bash
railway run composer dump-autoload
railway run php artisan optimize:clear
```

## Monitoring Your App

### View Logs
```bash
railway logs --follow
```

### Check Status
```bash
railway status
```

### Connect to Shell
```bash
railway shell
```

## Performance Optimization

### 1. Enable OPcache

Add to Railway variables:
```
PHP_OPCACHE_ENABLE=1
```

### 2. Optimize Composer
Already done in `nixpacks.toml`:
```
composer install --optimize-autoloader --no-dev
```

### 3. Cache Configuration
Already done in `nixpacks.toml`:
```
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 4. Use CDN for Assets
Configure Cloudflare or similar CDN for static assets

## Maintenance Mode

### Enable
```bash
railway run php artisan down --secret="your-secret-token"
```

Access with: `https://your-app.up.railway.app/your-secret-token`

### Disable
```bash
railway run php artisan up
```

## Backup Database

### PostgreSQL
Railway provides automatic backups, or:
```bash
railway run pg_dump > backup.sql
```

### SQLite
Download the database file from Railway

## Updating After Deployment

1. Push changes to GitHub:
```bash
git add .
git commit -m "Update feature"
git push
```

2. Railway auto-deploys

3. If needed, run migrations:
```bash
railway run php artisan migrate --force
```

4. Clear cache if configuration changed:
```bash
railway run php artisan config:clear
```

## Production Checklist

- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_KEY` is set
- [ ] `APP_URL` matches Railway URL
- [ ] Database is configured
- [ ] Migrations have run
- [ ] Storage is configured
- [ ] Admin user created
- [ ] HTTPS is working
- [ ] Assets are loading
- [ ] Email is configured (if needed)
- [ ] OAuth is configured (if needed)
- [ ] Error logging is set up
- [ ] Backups are configured

## Useful Railway Commands

```bash
# Link to project
railway link

# View logs
railway logs

# Run commands
railway run <command>

# Open in browser
railway open

# View variables
railway variables

# Connect to database
railway connect
```

## Support

- Railway Docs: https://docs.railway.app/
- Laravel Docs: https://laravel.com/docs
- Project Issues: Check your GitHub repo

---

## Quick Deploy Summary

1. **Push updated files** (nixpacks.toml, Procfile) to GitHub
2. **Connect Railway** to your GitHub repo
3. **Add PostgreSQL** database (or use SQLite)
4. **Set environment variables** (at minimum: APP_KEY, APP_URL, DB_CONNECTION)
5. **Deploy** (automatic on push)
6. **Create admin user** via Railway CLI
7. **Visit your site!** 🚀

Your TechVerse Hub is now live on Railway! 🎉

