# Login and Registration System

## Overview
MyProject is a PHP web application for user registration, login, and protected access using JWT. It includes daily tasks, a guessing game, and a homepage. MySQL is used for data storage and XAMPP for local testing.

Built with:
- PHP
- MySQL
- jQuery & AJAX
- Bootstrap 5
- Firebase PHP-JWT

## Requirements
- PHP >= 7.4
- MySQL
- Composer

## Installation
1. Clone the repo.
2. Run `composer install`.
3. Import the SQL file to your DB (or use install script).
4. Set up local server (e.g., XAMPP).
5. Run `install.php` in browser to auto-setup database:  
   `http://localhost/myproject/php/install.php`
6. Open `index.html` to start.

## Features
- User registration and login using JWT
- Token verification via `validate_jwt.php`
- Protected dashboard at `protected/project.php`
- Daily task tracking
- Simple guessing game
- Homepage (`homepage.html`) with app intro and navigation
- `install.php` script for auto-creating database, tables, and test user

## Database Setup
You can either:
- Import the SQL: `sql/myproject_db.sql`
- Or run: `http://localhost/myproject/php/install.php`

This will:
- Create the database `myproject_db` (if missing)
- Create the `users` table
- Add `role` column if missing
- Insert default admin user  
  **Email**: `admin@example.com`  
  **Password**: `admin123`

### Table: users
| Column     | Type                 | Description           |
|------------|----------------------|-----------------------|
| id         | INT (AUTO_INCREMENT) | Primary key           |
| username   | VARCHAR(50)          | Username              |
| email      | VARCHAR(100)         | Unique email          |
| password   | VARCHAR(255)         | Hashed password       |
| role       | VARCHAR(50)          | User role             |
| created_at | TIMESTAMP            | Created time          |

## How to Run
1. Place project in `htdocs`
2. Start Apache/MySQL in XAMPP
3. Open browser: `http://localhost/myproject/homepage.html`
4. Register or log in
5. Access protected pages after login
6. JWT is stored in `sessionStorage` and checked via PHP

## Notes
- `install.php` uses PDO and is safe to run multiple times
- No data duplication or errors on re-run
- All access to protected content requires a valid JWT

## Author
Built by [hager51](https://github.com/hager51)
