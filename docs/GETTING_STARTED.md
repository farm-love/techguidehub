# Getting Started

## Prerequisites
- PHP 8.2+
- Composer
- Node.js LTS
- SQLite (default) or MySQL

## Setup
1. Install dependencies:
   - `composer install`
   - `npm install && npm run build`
2. Copy env and configure:
   - Copy `.env.example` to `.env`
   - Set `APP_URL=http://localhost`
   - Configure DB (SQLite default)
   - Optional: `GA4_MEASUREMENT_ID=G-XXXXXXX`
   - Optional: `OPENAI_API_KEY=sk-...`
3. App key and migrations:
   - `php artisan key:generate`
   - `php artisan migrate --seed`
4. Run dev server:
   - `php artisan serve`

## URLs
- Home: `/`
- Categories: `/categories`
- Post: `/posts/{slug}`
- Static pages: `/about`, `/contact`, `/privacy`, `/terms`
- Auth pages via Breeze
- AI Generator (login required): `/ai-generator`

## APIs
- `GET /api/posts`
- `GET /api/posts/{slug}`
- `GET /api/categories`
- `GET /api/categories/{slug}`
- `GET /api/ads`
- `POST /api/ai-generator` body: `{ topic, outline?, tone? }`

## Ads
Use Blade component: `<x-ad-slot position="header|sidebar_top|sidebar_bottom|in_article_top|in_article_middle|in_article_bottom|footer" />`

## Notes
- Review AI content before publishing
- Keep sitemap (`/sitemap.xml`) and `robots.txt` accessible for SEO


