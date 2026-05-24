# Deployment Guide

This project is ready for Render deployment using Docker and a `render.yaml` Blueprint.

## What Was Added

- `Dockerfile` builds Laravel, Composer dependencies, and Vite assets.
- `docker/start.sh` runs migrations, optional seed data, caches config/routes/views, and starts Apache.
- `docker/000-default.conf` points Apache to Laravel's `public` folder.
- `render.yaml` creates one web service and one managed PostgreSQL database.

## Important

The app uses MySQL locally, but Render Blueprint uses PostgreSQL because Render manages PostgreSQL databases. Laravel migrations and Eloquent models are database-friendly, so this works for deployment.

## Before Deploy

Push the project to GitHub/GitLab/Bitbucket. Render needs a Git repo.

```bash
git init
git add .
git commit -m "Prepare Laravel blog for deployment"
git branch -M main
git remote add origin YOUR_GITHUB_REPO_URL
git push -u origin main
```

## Deploy On Render

Open this URL after pushing the repo:

```text
https://dashboard.render.com/blueprint/new
```

Select your repo. Render will detect `render.yaml`.

Fill these secret/env values in the Render Dashboard:

```env
APP_URL=https://your-render-service-url.onrender.com
ADMIN_EMAIL=your-email@gmail.com
```

Optional mail settings for real contact emails:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Blog Website"
```

## Seed Data

`SEED_DATABASE=true` is enabled in `render.yaml`, so sample categories, posts, admin user, contact, and subscriber will be added.

After first successful deployment, you can change `SEED_DATABASE=false` in Render if you do not want seed data to run again.

Default admin login:

```text
admin@example.com
password
```
