# PHP Applications

This directory contains basic PHP applications demonstrating web development concepts.

## Applications

### 1. Contact Form Handler (`contact_form.php`)
A complete contact form with validation that:
- Validates user input (name, email, subject, message)
- Sanitizes data to prevent XSS attacks
- Displays error messages for validation failures
- Logs submissions to a file
- Features responsive design with gradient styling

**Usage:**
```bash
# Using PHP built-in server
php -S localhost:8000 contact_form.php
# Then visit http://localhost:8000 in your browser
```

### 2. Simple Blog System (`blog_system.php`)
A basic blog application that allows you to:
- Create blog posts with title, author, and content
- View all posts on the homepage
- Read individual posts in detail view
- Delete posts
- Track post views
- Store data in JSON format

**Usage:**
```bash
# Using PHP built-in server
php -S localhost:8001 blog_system.php
# Then visit http://localhost:8001 in your browser
```

## Requirements
- PHP 7.0 or higher
- No database required (uses file-based storage)
- No external dependencies

## Features
- Clean, modern UI with gradient designs
- Form validation and sanitization
- Responsive layouts
- File-based data persistence
- Built-in security measures
