# 🎓 College Event Management System

A role-based web application that allows Admins, Students, and Visitors to interact with the college event registration and management system. Built using **PHP**, **MySQL**, **HTML**, **CSS**, and **JavaScript**.

---

## 📁 Features

### 👤 Main Roles

- **Admin**
  - Secure login
  - Add, view, update, and delete student records
  - View and manage visitor records
  - Toggle visitor status between `Pending` and `Successful`

- **Student**
  - Log in using Roll No. and Name
  - Register new student ID
  - View and update personal details (email, phone, course)

- **Visitor**
  - Register as a visitor
  - View their current registration status using visitor ID

---

## 🛠️ Technologies Used

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP (with PDO for database access)
- **Database:** MySQL
- **Server:** Apache2 (via XAMPP/LAMP)

---

## 💾 Database Schema

### `admins`
| Field       | Type         |
|-------------|--------------|
| id          | INT, PK, AI  |
| username    | VARCHAR(100) |
| password    | VARCHAR(255) |

### `students`
| Field       | Type         |
|-------------|--------------|
| id          | INT, PK, AI  |
| roll_number | VARCHAR(50)  |
| name        | VARCHAR(100) |
| email       | VARCHAR(100) |
| phone       | VARCHAR(15)  |
| course      | VARCHAR(100) |

### `visitors`
| Field        | Type         |
|--------------|--------------|
| id           | INT, PK, AI  |
| name         | VARCHAR(100) |
| email        | VARCHAR(100) |
| visit_reason | TEXT         |
| status       | VARCHAR(20)  | (default: 'Pending')

---

## 🚀 Installation Guide (Ubuntu)

1. **Install LAMP stack (Apache, MySQL, PHP):**
   ```bash
   sudo apt update
   sudo apt install apache2 mysql-server php libapache2-mod-php php-mysql

   ```
2. **Move your project to /var/www/html: **
   ```bash
   sudo cp -r your_project_directory /var/www/html/college-event-system

   ```
3. **Setup MySQL database: **
   ```bash
   mysql -u root -p
   ```
   **Inside MySQL: **
   ```sql
   CREATE DATABASE events;
   USE events;
   -- Then paste your SQL schema or use:
   SOURCE /path/to/events_backup.sql;
   ```
4. **Update db_config.php: **
   ```php
   $pdo = new PDO("mysql:host=localhost;dbname=events", "your_username", "your_password");

   ```
5. **Access in browser: **
   ```
  http://localhost/EventSys/index.html

   ```
   
