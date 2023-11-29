
# Login and Registration Project in PHP

## Description
This PHP project demonstrates a simple login and registration system using PDO for interaction with a MySQL database. It includes pages for login, registration, password reset, and a welcome page after successful login.

## Project Structure
- **`connection/connect.php`**: Establishes a connection to the MySQL database using PDO.
- **`models/user.php`**: Defines the `User` class and the `UserDaoInterface` interface to represent a user and DAO operations.
- **`dao/userDao.php`**: Implements the `UserDaoInterface` interface and provides functionalities to manipulate users in the database.

### Views (Pages)
- **`login.php`**: Login page.
- **`register.php`**: Registration page.
- **`resetPassword.php`**: Password reset page.
- **`welcome.php`**: Welcome page after successful login.

## Usage Instructions
1. Configure the database in the `connection/connect.php` file.
2. Execute the SQL scripts to create the `users` table.
3. Start the PHP server to test the pages (e.g., `php -S localhost:8000`).
4. Navigate to `http://localhost:8000/login.php` to access the login page.

## Requirements
- Configured PHP server.
- Configured MySQL database.

## Notes
- Ensure to adjust the database settings as needed.
- These are basic codes and can be expanded based on project requirements.

### Author
Luiz Felipe Frois Neves - 2023 

