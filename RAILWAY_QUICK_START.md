# 🚀 Railway Quick Start (5 Minutes)

## Current Issue Diagnosis

If your Railway deployment succeeded but the site isn't working, it's likely one of these:

### Most Common Issues:

1. **Missing APP_KEY** ❌
2. **Wrong APP_URL** ❌
3. **Database not configured** ❌
4. **Migrations not run** ❌
5. **Missing environment variables** ❌

## Fix It Now! (Step by Step)

### Step 1: Check Railway Logs

Go to Railway Dashboard → Your Project → Deployments → Click latest deployment → View Logs

Look for errors like:
- "No application encryption key has been specified"
- "Database connection failed"
- "Route not found"

### Step 2: Set Critical Environment Variables

In Railway Dashboard → Variables, add these **MINIMUM** required variables:

```
APP_KEY=base64:YOUR_KEY_HERE
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.up.railway.app
DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite
```

#### Generate APP_KEY:

**Locally:**
```bash
php artisan key:generate --show
```

Copy the output (starts with `base64:`) and paste it as `APP_KEY` in Railway.

### Step 3: Update and Redeploy

The updated files I just created will automatically:
- ✅ Run migrations
- ✅ Build frontend assets
- ✅ Link storage
- ✅ Cache routes and views

**Commit and push:**
```bash
git add .
git commit -m "Configure for Railway deployment"
git push origin main
```

Railway will automatically redeploy.

### Step 4: Verify Deployment

1. Wait for deployment to complete (2-3 minutes)
2. Visit your Railway URL
3. Check if site loads

### Step 5: Create Admin User

Once site is running, create your admin:

**Option A: Using Railway CLI**
```bash
railway login
railway link
railway run php artisan tinker
```

Then in tinker:
```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@yourdomain.com',
    'password' => bcrypt('YourSecurePassword123!'),
    'role' => 'admin',
    'email_verified_at' => now()
]);
exit
```

**Option B: Using Railway Web Terminal**
1. Go to Railway Dashboard → Your Project → Connect
2. Click "Open Terminal"
3. Run:
```bash
php artisan tinker
```
4. Paste the user creation code above

### Step 6: Login and Test

Visit: `https://your-app.up.railway.app/login`

Login with the admin credentials you just created.

## Still Having Issues?

### Error: "500 | Server Error"

**Fix:**
```bash
# In Railway terminal or CLI
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan migrate --force
```

### Error: "No application encryption key"

**Fix:**
1. Generate key locally: `php artisan key:generate --show`
2. Add to Railway variables: `APP_KEY=base64:YOUR_KEY`
3. Redeploy

### Error: "Database connection failed"

**Fix Option 1 (SQLite - Recommended for testing):**
```
DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite
```

**Fix Option 2 (PostgreSQL - Recommended for production):**
1. Add PostgreSQL in Railway: + New → Database → PostgreSQL
2. Set variables:
```
DB_CONNECTION=pgsql
DB_HOST=${{PGHOST}}
DB_PORT=${{PGPORT}}
DB_DATABASE=${{PGDATABASE}}
DB_USERNAME=${{PGUSER}}
DB_PASSWORD=${{PGPASSWORD}}
```

### Error: "Mix manifest not found"

**Fix:**
The updated `nixpacks.toml` now runs `npm run build` automatically.
Redeploy after pushing the new files.

### Assets (CSS/JS) Not Loading

**Fix:**
1. Check `APP_URL` matches your Railway URL exactly
2. Clear cache:
```bash
railway run php artisan config:clear
```
3. Verify `public/build` directory exists after deployment

## Complete Railway Variable List

Here's everything you should have in Railway Variables:

### Essential (REQUIRED)
```
APP_NAME=TechVerse Hub
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY
APP_DEBUG=false
APP_URL=https://your-app.up.railway.app
DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite
```

### Optional (for full features)
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.your-service.com
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password

GOOGLE_CLIENT_ID=your-id
GOOGLE_CLIENT_SECRET=your-secret
GOOGLE_REDIRECT_URI=${APP_URL}/auth/google/callback

GITHUB_CLIENT_ID=your-id
GITHUB_CLIENT_SECRET=your-secret
GITHUB_REDIRECT_URI=${APP_URL}/auth/github/callback

OPENAI_API_KEY=your-key
```

## Useful Railway Commands

```bash
# Link your project
railway link

# View live logs
railway logs --follow

# Run artisan commands
railway run php artisan migrate
railway run php artisan cache:clear
railway run php artisan config:clear

# Open in browser
railway open

# Connect to database
railway connect
```

## What Changed in Your Repo

I updated these files to fix Railway deployment:

1. **`nixpacks.toml`** - Updated to:
   - Install Node.js
   - Run `npm run build`
   - Run migrations on startup
   - Link storage

2. **`Procfile`** - Updated to run migrations before starting

3. **`.railwayignore`** - Created to exclude unnecessary files

4. **`RAILWAY_DEPLOYMENT.md`** - Complete deployment guide

5. **`railway-troubleshoot.sh`** - Quick troubleshooting script

## Next Steps After Successful Deployment

1. ✅ Test all features
2. ✅ Create some sample posts
3. ✅ Configure OAuth (if needed)
4. ✅ Set up email (if needed)
5. ✅ Add your domain (optional)
6. ✅ Set up monitoring
7. ✅ Configure backups

## Getting Help

**Check logs first:**
```bash
railway logs
```

**Common log errors and solutions:**
- "Permission denied" → Check file permissions in `storage/` and `bootstrap/cache/`
- "Class not found" → Run `railway run composer dump-autoload`
- "Route not found" → Run `railway run php artisan route:clear`
- "View not found" → Run `railway run php artisan view:clear`

## Success Checklist

- [ ] Railway deployment shows "Success"
- [ ] Site loads without errors
- [ ] CSS and JS are working
- [ ] Can access admin dashboard
- [ ] Database is working (can create posts)
- [ ] Images upload correctly
- [ ] All routes work

---

## TL;DR - Fastest Fix

```bash
# 1. Generate APP_KEY locally
php artisan key:generate --show

# 2. Add these to Railway Variables:
APP_KEY=base64:YOUR_KEY_FROM_STEP_1
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-railway-url.up.railway.app
DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite

# 3. Push updated files
git add .
git commit -m "Fix Railway deployment"
git push

# 4. Wait for redeploy (2-3 minutes)

# 5. Create admin user via Railway CLI
railway run php artisan tinker
# Then create user (see Step 5 above)

# 6. Visit your site and login! 🎉
```

Your site should now be working! 🚀

