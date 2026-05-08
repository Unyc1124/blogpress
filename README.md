
## Project Overview

BlogPress (JobYaari Assignment Project) is a full-stack Blog Management System developed using Laravel. The project includes both frontend and admin functionalities with dynamic AJAX-based filtering, authentication, responsive UI design, and live deployment.


---

## Live Website

```text
https://blogpress-n7jn.onrender.com
```

## GitHub Repository

```text
https://github.com/Unyc1124/blogpress
```

---

# Admin Login Credentials

## Admin Panel URL

```text
https://blogpress-n7jn.onrender.com/login
```

## Credentials

```text
Email: admin@example.com
Password: admin123
```

---

# Features

## Frontend Features

* Responsive homepage
* Blog listing with AJAX category and date filtering
* Blog detail page with table of contents
* Search by title, category, and tags
* Related blogs section
* Pagination
* Mobile responsive navbar

## Admin Features

* Admin authentication
* Create, edit, delete blog posts
* Featured image upload via Cloudinary
* Category management
* CKEditor rich text editor

---

# Technologies Used

## Backend

* PHP, Laravel 12, Eloquent ORM, Blade Templates

## Frontend

* HTML5, CSS3, JavaScript, jQuery, AJAX

## Storage

* Cloudinary (persistent image storage for production)

## Database

* PostgreSQL (Production), MySQL (Local)

## Deployment

* GitHub, Render, Docker, Cloudinary

---

# AJAX Filtering

* Filter blogs by category
* Filter blogs by date (Latest, Oldest, This Month, This Year)
* No page reload — jQuery AJAX + partial Blade rendering



# Database Relationships

* Blog belongsTo Category
* Blog belongsTo User (Author)
* Blog belongsToMany Tags
* Category hasMany Blogs

---


# Installation Steps

## 1. Clone Repository

```bash
git clone <YOUR_GITHUB_REPOSITORY_LINK>
```

---

## 2. Move Into Project

```bash
cd blogpress
```

---

## 3. Install Dependencies

```bash
composer install
```

---

## 4. Create Environment File

```bash
cp .env.example .env
```

---

## 5. Generate Application Key

```bash
php artisan key:generate
```

---

## 6. Configure Database

Update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogpress
DB_USERNAME=root
DB_PASSWORD=
```

---

## 7. Run Migrations

```bash
php artisan migrate
```

---

## 8. Seed Database (Optional)

```bash
php artisan db:seed
```

---

## 9. Start Development Server

```bash
php artisan serve
```

---

# Docker Configuration

The project uses Docker for production deployment.

Example Dockerfile:

```dockerfile
FROM richarvey/nginx-php-fpm:3.1.6

COPY . .

ENV SKIP_COMPOSER=1
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install --no-dev --optimize-autoloader
RUN php artisan migrate --force
RUN php artisan db:seed --force

CMD ["/start.sh"]
```




# Challenges Faced During Development

## Images Disappearing After Every Deployment

**Problem**

After deploying to Render, all featured images disappeared on every redeploy. The original code stored images on the server's local filesystem:

```php
$image->move(public_path('uploads'), $imageName);
$imagePath = 'uploads/' . $imageName;
```

Render uses an **ephemeral filesystem** — local files are wiped on every restart or redeploy.

**Solution — Cloudinary Integration**

Moved image storage to Cloudinary so images are stored externally and persist permanently.

```bash
composer require cloudinary-labs/cloudinary-laravel
php artisan vendor:publish --provider="CloudinaryLabs\CloudinaryLaravel\CloudinaryServiceProvider"
```

Replaced local upload with Cloudinary upload in `BlogManagementController`:

```php
// BEFORE
$image->move(public_path('uploads'), $imageName);
$imagePath = 'uploads/' . $imageName;

// AFTER
$uploaded  = Cloudinary::upload(
    $request->file('featured_image')->getRealPath(),
    ['folder' => 'blog_images']
);
$imagePath = $uploaded->getSecurePath();
```

Also added Cloudinary credentials directly in the **Render dashboard Environment Variables** since `.env` is not deployed.

**Result** — Images now store as full `https://res.cloudinary.com/...` URLs in the database and persist across all redeployments.

---

## Other Problems Solved

* AJAX rendering issues
* Docker deployment failures
* MySQL vs PostgreSQL migration conflicts
* Render environment variable configuration
* Production database migration problems

---

# Assignment Requirements Covered

* PHP/Laravel Backend
* Database Integration
* Responsive Frontend
* AJAX Filtering (jQuery, no page reload)
* Search Functionality
* CRUD Operations
* Admin Authentication
* Live Deployment
* GitHub Repository
* Mobile Responsive Design

---


# Author

Developed by Aditi Dubey

---

# Thank You

Thank you for reviewing this project.



