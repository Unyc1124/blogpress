# JobYaari - Blog Management System

## Project Overview

 JobYaari (JobYaari Assignment Project) is a full-stack Blog Management System developed using Laravel. The project includes both frontend and admin functionalities with dynamic AJAX-based filtering, authentication, responsive UI design, and live deployment.

The application allows users to browse blogs, search articles, filter blogs dynamically without page refresh, and read full blog content. Admin users can securely manage blog posts through a dedicated dashboard.

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
* Blog listing page
* Blog detail page
* Search functionality
* AJAX category filtering
* AJAX date filtering
* Dynamic blog rendering from database
* Related blogs section
* Pagination
* Mobile responsive navbar with hamburger menu
* Responsive cards and layouts

---

## Admin Features

* Admin authentication system
* Admin dashboard
* Create blog posts
* Edit blog posts
* Delete blog posts
* Upload featured images
* Manage categories
* Rich text editor using CKEditor

---

# Technologies Used

## Backend

* PHP
* Laravel 12
* Eloquent ORM
* Laravel Authentication
* Laravel Blade Templates

---

## Frontend

* HTML5
* CSS3
* JavaScript
* jQuery
* AJAX
* Responsive Design

---

## Database

* PostgreSQL (Production - Render)
* MySQL (Local Development)

---

## Deployment

* GitHub
* Render
* Docker

---

# AJAX Filtering Functionality

One of the main requirements of the assignment was implementing dynamic filtering using AJAX and jQuery.

The project includes:

* Filter blogs by category
* Filter blogs by date
* Dynamic content loading without page refresh
* Partial Blade rendering
* jQuery AJAX requests

This improves user experience by updating blogs instantly without reloading the page.

---

# Database Relationships

The project uses Laravel Eloquent relationships.

## Relationships Used

* Blog belongsTo Category
* Blog belongsTo User (Author)
* Blog belongsToMany Tags
* Category hasMany Blogs

---

# Search Functionality

The search system allows users to search blogs dynamically using:

* Blog title
* Category name
* Tag name

The search is implemented using Laravel query builder and Eloquent relationships.

---

# CKEditor Integration

CKEditor is integrated for rich blog content creation.

Features:

* Rich text formatting
* Better content editing experience
* Admin-friendly blog creation

---

# Responsive Design

The project is fully responsive and optimized for:

* Mobile devices
* Tablets
* Laptops
* Desktop screens

Responsive improvements include:

* Mobile navbar with hamburger menu
* Responsive dashboard
* Responsive tables
* Flexible blog cards
* Adaptive layouts

---

# Deployment Process

The project was deployed using Render with Docker support.

Deployment included:

* GitHub repository integration
* Docker configuration
* Environment variable setup
* PostgreSQL database integration
* Production migrations
* Laravel optimization

---

# Challenges Faced During Development

During development and deployment, several real-world issues were encountered and resolved.

## Problems Solved

* Responsive layout issues
* AJAX rendering issues
* Laravel route/cache issues
* Docker deployment failures
* MySQL vs PostgreSQL migration conflicts
* Render environment variable configuration
* Production database migration problems

These issues helped improve debugging and deployment understanding.

---

# Assignment Requirements Covered

## Completed Requirements

* PHP/Laravel Backend
* Database Integration
* Responsive Frontend
* AJAX Filtering
* Search Functionality
* CRUD Operations
* Admin Authentication
* Live Deployment
* GitHub Repository
* Mobile Responsive Design
* Blog Management System


---

# Author

Developed by:

```text
Aditi Dubey
```

---

# Thank You

Thank you for reviewing this project.
