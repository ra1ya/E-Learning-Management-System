# E-Learning Management System (LMS)

[![LMS CI](https://github.com/ra1ya/E-Learning-Management-System/actions/workflows/ci.yml/badge.svg)](https://github.com/ra1ya/E-Learning-Management-System/actions/workflows/ci.yml)
[![Laravel 11](https://img.shields.io/badge/Laravel-11-red.svg)](https://laravel.com/)
[![PHP 8.2+](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://www.php.net/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

A multi-role Learning Management System built with **Laravel 11**, **PHP 8.2+**, **MySQL/MariaDB**, and **Blade**. The application separates administrator, teacher, and student workflows with dedicated Laravel authentication guards and role-specific routes.

The project focuses on backend workflow design, authorization, relational data, assessment handling, PDF receipts, and maintainable Laravel structure rather than UI complexity.

## Recruiter Snapshot

- Dedicated `admin`, `teacher`, and `students` authentication guards
- Protected administrator workflows for users, courses, batches, enrollments, payments, and receipts
- Student access restricted to enrolled courses and their assessments
- Assessment submissions use the authenticated student identity and validate question ownership
- Validated CRUD workflows and hashed credentials
- Course PDF uploads through Laravel public storage
- Sanitized demo database and repeatable demo seeding
- GitHub Actions verifies PHP syntax, migrations, seeders, routes, the full automated test suite, and frontend production build

## Core Features

### Administrator
- Manage students and teachers
- Manage courses and batches
- Manage enrollments and payments
- Generate protected PDF payment receipts
- Update account profile and password

### Teacher
- Manage courses
- Create and manage homework and tests
- Create assessment questions as part of assessment workflows
- Review student homework and test submissions
- Manage student results
- Update account profile and password

> **Portfolio scope:** teacher accounts are treated as trusted instructional staff with shared course-management access. Per-teacher course ownership is outside this demo's scope and is not advertised as implemented.

### Student
- Dedicated student registration and authentication
- Access enrolled courses only
- Access homework and tests only for enrolled courses
- Submit homework and test answers
- View only personal answer details and results
- Update account profile and password

## Security and Data Integrity

- Public administrator and teacher self-registration is disabled
- Payment reports require administrator authentication
- Student submissions derive identity from the authenticated student guard
- Homework/test questions must belong to the selected assessment
- Students cannot access assessments outside their enrolled courses
- Student answer detail pages are scoped to the authenticated student
- Administrative CRUD requests use validation instead of raw request mass assignment
- Passwords are hashed using Laravel's password casting/Hash facilities
- Demo data is fictional and sanitized

## Tech Stack

- **Backend:** PHP 8.2+, Laravel 11
- **Database:** MySQL / MariaDB
- **Frontend:** Blade, HTML, CSS, JavaScript, Vite
- **ORM:** Eloquent
- **PDF:** DomPDF
- **Testing:** PHPUnit / Laravel Feature Tests
- **CI:** GitHub Actions

## Project Structure

```text
app/
├── Http/Controllers/
│   ├── Admin/
│   ├── Teacher/
│   └── Students/
└── Models/

database/
├── migrations/
├── seeders/
└── sample/
    └── dblearnn_demo.sql

resources/
└── views/

routes/
├── web.php
├── admin-auth.php
├── teacher-auth.php
└── students-auth.php

tests/
└── Feature/
    └── LmsSecurityTest.php
```

## Local Setup

### Requirements

- PHP 8.2+
- Composer
- Node.js 20+
- npm
- MySQL / MariaDB, or SQLite for automated tests

### Install

```bash
git clone https://github.com/ra1ya/E-Learning-Management-System.git
cd E-Learning-Management-System
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Configure database credentials in `.env`, then choose one database setup method.

### Option A — Fresh Laravel database with demo seed

```bash
php artisan migrate:fresh --seed
```

### Option B — Sanitized MySQL demo dump

```bash
mysql -u YOUR_DB_USER -p YOUR_DB_NAME < database/sample/dblearnn_demo.sql
```

Create the public storage link for uploaded course PDFs:

```bash
php artisan storage:link
```

Run the application:

```bash
npm run dev
php artisan serve
```

## Automated Verification

The CI workflow runs on pushes and pull requests and verifies:

```text
composer validate
PHP syntax linting
php artisan migrate:fresh --seed
php artisan route:list
php artisan test
npm ci
npm run build
```

This makes the repository reproducible for technical review instead of relying only on manual setup claims.

## Demo Database

A sanitized SQL sample is available at:

```text
database/sample/dblearnn_demo.sql
```

The sample contains fictional administrator, teacher, student, course, assessment, enrollment, payment, and result data. It does not contain production credentials or session payloads.

Demo password for seeded/demo accounts:

```text
password
```

## Portfolio Highlights

This project demonstrates Laravel MVC architecture, multi-guard authentication, relational database design, Eloquent relationships, enrollment-based authorization, validated CRUD workflows, assessment submission and grading logic, file uploads, PDF generation, automated testing, and CI verification.

## License

This project is available under the MIT License. See `LICENSE`.

## Author

**Rian Aldini**  
Full-Stack Web & Mobile Developer  
Laravel • PHP • MySQL • Flutter

LinkedIn: https://www.linkedin.com/in/rian-aldini-353102329
