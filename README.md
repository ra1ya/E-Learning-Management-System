# E-Learning Management System (LMS)

A multi-role Learning Management System built with **Laravel 11**, **PHP 8.2+**, **MySQL**, and **Blade**. The application separates administrator, teacher, and student workflows with dedicated Laravel authentication guards and role-specific routes.

## Core Features

### Administrator
- Manage students and teachers
- Manage courses and batches
- Manage enrollments and payments
- Generate protected PDF payment receipts

### Teacher
- Manage courses
- Create homework and assessment questions
- Create tests and test questions
- Review student homework and test submissions
- Manage student results

### Student
- Dedicated student registration and authentication
- Access enrolled courses only
- Submit homework and test answers
- View personal results

## Security and Data Integrity

- Separate `admin`, `teacher`, and `students` authentication guards
- Public administrator and teacher registration is disabled
- Payment reports require administrator authentication
- Student submissions use the authenticated student identity rather than trusting a submitted student ID
- Homework/test questions are validated against the selected assessment
- Student answer detail pages are scoped to the authenticated student
- Passwords are hashed and administrative CRUD requests are validated
- Demo SQL contains fictional data only

## Tech Stack

- PHP 8.2+
- Laravel 11
- MySQL / MariaDB
- Blade, HTML, CSS, JavaScript
- Eloquent ORM
- DomPDF
- Composer and npm

## Project Structure

```text
app/
├── Http/Controllers/
│   ├── Admin/
│   ├── Teacher/
│   └── Students/
├── Models/
database/
├── migrations/
├── sample/
│   └── dblearnn_demo.sql
resources/
└── views/
routes/
├── web.php
├── admin-auth.php
├── teacher-auth.php
└── students-auth.php
```

## Demo Database

A sanitized demo database is available at:

```text
database/sample/dblearnn_demo.sql
```

The sample contains fictional administrator, teacher, student, course, assessment, enrollment, payment, and result data. It does not contain production credentials or session payloads.

Demo password for the seeded accounts in the SQL sample:

```text
password
```

## Installation

### Requirements

- PHP 8.2+
- Composer
- Node.js and npm
- MySQL or MariaDB

### Setup

```bash
git clone https://github.com/ra1ya/E-Learning-Management-System.git
cd E-Learning-Management-System
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Configure the database credentials in `.env`, then choose one database setup method.

### Option A — Laravel migrations

```bash
php artisan migrate
```

### Option B — Sanitized demo database

```bash
mysql -u YOUR_DB_USER -p YOUR_DB_NAME < database/sample/dblearnn_demo.sql
```

Create the public storage link for uploaded course PDFs:

```bash
php artisan storage:link
```

Start the application:

```bash
npm run dev
php artisan serve
```

## Portfolio Highlights

This project demonstrates Laravel MVC architecture, multi-guard authentication, relational database design, Eloquent relationships, validated CRUD workflows, assessment submission and grading logic, access control, file uploads, and PDF generation.

## Author

**Rian Aldini**  
Full-Stack Web & Mobile Developer  
Laravel • PHP • MySQL • Flutter

LinkedIn: https://www.linkedin.com/in/rian-aldini-353102329
