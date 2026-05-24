# Railway Deployment Guide

This project is ready for Railway deployment using the existing Dockerfile.

## Deploy From GitHub

1. Open Railway and create a new project.
2. Add a PostgreSQL database service.
3. Add a new app service from this GitHub repo:
   `https://github.com/hemantdhoundiyal2406/laravel_blog`
4. Railway will detect `railway.json` and build using `Dockerfile`.
5. In the app service, open Variables and add the values below.
6. Deploy the app service.
7. After deploy succeeds, go to Settings -> Networking -> Public Networking and generate a Railway domain.

## Required Variables

Use Railway's Raw Editor for the app service variables:

```env
APP_NAME="My Blog"
APP_ENV=production
APP_DEBUG=false
LOG_CHANNEL=stderr
LOG_STDERR_FORMATTER=Monolog\Formatter\JsonFormatter
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=public
DB_CONNECTION=pgsql
DB_URL=${{Postgres.DATABASE_URL}}
SEED_DATABASE=true
MAIL_MAILER=log
```

`APP_KEY` is optional for first deploy because the Docker startup script can generate one if it is missing. For stable sessions, generate one locally and add it in Railway:

```bash
php artisan key:generate --show
```

## After First Deploy

Set `SEED_DATABASE=false` after the first successful deploy if you do not want seed data to run again.

Default admin login:

```text
admin@example.com
password
```
