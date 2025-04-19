# Login and Registration System

A secure login and registration system using JWT authentication, built with:

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
3. Import the SQL file to your DB.
4. Set up local server (e.g., XAMPP).
5. Visit `index.html` to start.

## Features
- User registration with hashed password
- Secure user login with JWT token
- Protected routes/pages using JWT verification
- Responsive UI with AJAX-based forms

## Database Setup
Import the `sql/myproject_db.sql` file into your MySQL server. It creates a `users` table inside the `myproject_db` database.

### Database Structure

**Table: users**
| Column     | Type                 | Description           |
|------------|----------------------|-----------------------|
| id         | INT (AUTO_INCREMENT) | Primary key           |
| name       | VARCHAR(100)         | User's full name      |
| email      | VARCHAR(100)         | Unique email address  |
| password   | TEXT                 | Hashed password       |
| created_at | TIMESTAMP            | Account creation time |


## How to Run
1. Start your local server using XAMPP/WAMP.
2. Install dependencies using Composer: composer require firebase/php-jwt
3. Open index.html in browser to register or login.
4. After login, users are redirected to a protected page (protected/project.php).
5. Direct access to protected pages is blocked unless a valid token is present.

## Author
Built by [hager51](https://github.com/hager51)
