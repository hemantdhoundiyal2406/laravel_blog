# Purely Blog Website Documentation

## Project Overview

Ye Laravel beginner-friendly blog website hai jisme public blog frontend aur simple admin panel dono available hain.

Main features:

- Clean responsive blog website
- Bootstrap 5 based frontend and admin UI
- Quill rich text editor for blog full content
- Laravel Breeze authentication
- Blog listing, category filter, search, blog detail page
- Admin dashboard with blog/category/contact/subscriber management
- Image upload using Laravel public storage
- Contact form database save plus admin email
- Newsletter subscriber save with duplicate email protection

## Tech Stack

- Laravel 12.60.2
- PHP 8.2 compatible setup
- Laravel Breeze for login/register/logout
- Bootstrap 5 and Bootstrap Icons for UI
- Quill editor CDN for blog content writing
- Blade templates
- Eloquent ORM
- Laravel validation
- Laravel Mail
- MySQL for real setup
- SQLite is used locally in this workspace only for quick testing

Note: As of this setup, Laravel 13 latest stable needs PHP 8.3+. This machine has PHP 8.2.12, so the project uses the latest Laravel 12 release compatible with PHP 8.2.

## Fresh Laravel Install Commands

If you are creating this project from zero:

```bash
composer create-project laravel/laravel blog-website "^12.0"
cd blog-website
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run build
```

## Existing Project Setup Commands

Run these commands after downloading or copying this project:

Copy env file first:

```bash
# Windows PowerShell
Copy-Item .env.example .env

# macOS/Linux
cp .env.example .env
```

```bash
composer install
npm install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve
```

Open the website:

```text
http://127.0.0.1:8000
```

## MySQL Database Setup

Create a MySQL database:

```sql
CREATE DATABASE blog_website;
```

Update `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_website
DB_USERNAME=root
DB_PASSWORD=
```

Then run:

```bash
php artisan migrate --seed
```

## Mail Setup

Contact form submit hone par admin email par mail send hota hai. Gmail ke liye app password use karein.

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Blog Website"
ADMIN_EMAIL=your-email@gmail.com
```

Local testing ke liye `MAIL_MAILER=log` bhi use kar sakte hain. Is case me email actual inbox me nahi jayega, Laravel log file me save hoga.

## Admin Login Setup

Seeder ek admin user create karta hai:

```text
Email: admin@example.com
Password: password
```

Admin panel:

```text
http://127.0.0.1:8000/login
```

Login ke baad dashboard open hota hai.

## Database Tables Role

`users`

- Breeze authentication ke users store hote hain.
- Login/register/logout isi table ke through kaam karta hai.

`categories`

- Blog categories store hoti hain.
- Fields: name, slug, icon, image.
- Category ka relation posts ke saath one-to-many hai.

`posts`

- Blog posts store hote hain.
- Fields: category_id, title, slug, short_description, content, image, read_time, is_featured, is_popular, status.
- `status = published` wale posts frontend par show hote hain.

`contacts`

- Contact form se aane wale messages store hote hain.
- Admin messages view/delete kar sakta hai.

`subscribers`

- Newsletter emails store hote hain.
- Email unique hai, duplicate save nahi hota.

## Category And Post Relation

Relation simple hai:

```text
One Category has many Posts
One Post belongs to one Category
```

Files:

- `app/Models/Category.php` me `posts()` relation
- `app/Models/Post.php` me `category()` relation

Example:

```php
$post->category->name
$category->posts
```

## Frontend Blog Flow

Routes `routes/web.php` me defined hain.

- `/` home page
- `/blog` blog listing
- `/blog/{slug}` blog detail
- `/about` about page
- `/contact` contact page
- `/subscribe` newsletter submit

`BlogController` data fetch karta hai:

- featured post
- latest posts
- popular posts
- category filter
- search result
- related posts

Blade views `resources/views/public` folder me hain.

## Admin Backend Flow

Admin routes auth middleware ke andar hain:

```text
/dashboard
/admin/posts
/admin/categories
/admin/contacts
/admin/subscribers
```

Admin controllers:

- `Admin/DashboardController.php`
- `Admin/PostController.php`
- `Admin/CategoryController.php`
- `Admin/ContactMessageController.php`
- `Admin/SubscriberController.php`

Admin views:

- `resources/views/admin/dashboard.blade.php`
- `resources/views/admin/posts`
- `resources/views/admin/categories`
- `resources/views/admin/contacts`
- `resources/views/admin/subscribers`

## Blog Add/Edit/Delete Flow

Add blog:

1. Admin opens `/admin/posts/create`
2. Form submit goes to `PostController@store`
3. Laravel validation checks required fields
4. Quill rich text editor content is saved as HTML in `content`
5. Image uploads to `storage/app/public/posts`
6. Post saves in `posts` table
7. Frontend shows post if status is `published`

Edit blog:

1. Admin opens edit page
2. Form submit goes to `PostController@update`
3. New image upload replaces old local image
4. Post data updates

Delete blog:

1. Delete button sends DELETE request
2. Local uploaded image is deleted
3. Post row is deleted from database

## Image Upload Flow

Admin uploaded images are stored on public disk:

```php
$request->file('image')->store('posts', 'public');
```

Public URL is generated in model accessor:

```php
$post->image_url
```

Required command:

```bash
php artisan storage:link
```

This connects:

```text
public/storage -> storage/app/public
```

## Contact Form Email Flow

1. User fills contact form on `/contact`
2. `BlogController@storeContact` validates data
3. Message saves in `contacts` table
4. Laravel Mail sends `ContactMessageMail` to `ADMIN_EMAIL`
5. Admin can view/delete message in backend

Important files:

- `app/Mail/ContactMessageMail.php`
- `resources/views/emails/contact-message.blade.php`
- `app/Http/Controllers/BlogController.php`

## Newsletter Flow

1. User enters email in newsletter form
2. `BlogController@subscribe` validates email
3. Laravel checks `unique:subscribers,email`
4. Email saves in `subscribers` table
5. Admin can view/delete subscribers

## Important File Map

Routes:

- `routes/web.php` public and admin routes
- `routes/auth.php` Breeze authentication routes

Models:

- `app/Models/User.php`
- `app/Models/Category.php`
- `app/Models/Post.php`
- `app/Models/Contact.php`
- `app/Models/Subscriber.php`

Controllers:

- `app/Http/Controllers/BlogController.php`
- `app/Http/Controllers/Admin/PostController.php`
- `app/Http/Controllers/Admin/CategoryController.php`
- `app/Http/Controllers/Admin/ContactMessageController.php`
- `app/Http/Controllers/Admin/SubscriberController.php`

Views:

- `resources/views/layouts/public.blade.php`
- `resources/views/layouts/admin.blade.php`
- `resources/views/layouts/guest.blade.php`
- `resources/views/public/*.blade.php`
- `resources/views/admin/**/*.blade.php`
- `resources/views/auth/*.blade.php`

Styling:

- `resources/css/app.css`
- Bootstrap 5 CDN in layouts
- Bootstrap Icons CDN in layouts
- Quill editor CDN in `resources/views/admin/posts/form.blade.php`

Database:

- `database/migrations`
- `database/seeders/DatabaseSeeder.php`

Mail:

- `app/Mail/ContactMessageMail.php`
- `resources/views/emails/contact-message.blade.php`
- `config/mail.php`

## Interview Explanation

You can explain the project like this:

```text
This is a Laravel blog website with a public frontend and an authenticated admin panel.
I used Laravel Breeze for authentication, Bootstrap 5 for responsive UI, Blade for templates, and Eloquent relationships for categories and posts.
The frontend shows published posts with category filter and search. The admin can create, update, and delete posts and categories. Images are uploaded using Laravel storage and shown through a model accessor. Contact messages are saved in the database and also emailed to the admin using Laravel Mail. Newsletter emails are stored in the subscribers table and duplicate emails are prevented using validation plus a unique database column.
```

Important relation to mention:

```text
Category has many posts, and each post belongs to one category.
```

Important flow to mention:

```text
Route -> Controller -> Model/Database -> Blade View
```

Example:

```text
/blog route calls BlogController@index, controller fetches published posts from Post model, and blog-index.blade.php displays cards using Bootstrap.
```
