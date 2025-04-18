# Login and Registration System

This is a simple login and registration system built with:

- PHP
- MySQL
- jQuery & AJAX
- Bootstrap 5

## Features
- User registration with hashed password
- User login with validation
- Protected user area (`project.php`)
- Simple database schema (`users` table)
- AJAX-based forms for better UX

## Database Setup
1. Import the `myproject_db.sql` file into your local MySQL server to create the `users` table.

## Usage
1. Run using XAMPP/WAMP or any local PHP server.
2. Access `index.html` to login or register.
3. After login, users are redirected to `project.php` — a protected page only accessible if logged in.
4. Attempting to access `project.php` directly without login will redirect back to the login page.

## Author
Built by [hager51](https://github.com/hager51)
