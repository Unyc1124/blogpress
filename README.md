# JobYaari - Blog Management System

## Project Overview

BlogPress (JobYaari Assignment Project) is a full-stack Blog Management System developed using Laravel. The project includes both frontend and admin functionalities with dynamic AJAX-based filtering, authentication, responsive UI design, and live deployment.

This project was developed as part of the PHP/Laravel Developer Internship Assessment.

---

# Live Project

## Live Website

```text
https://blogpress-e2tl.onrender.com
```

## GitHub Repository

```text
https://github.com/Unyc1124/blogpress
```

---

# Admin Login Credentials

## Admin Panel URL

```text
https://blogpress-e2tl.onrender.com/login
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
