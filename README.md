# E-Learning Management System (LMS)

A multi-role Learning Management System built with **Laravel**, **PHP**, and **MySQL** to support core academic workflows for administrators, teachers, and students.

This project demonstrates practical experience with Laravel MVC architecture, authentication, relational database design, Eloquent models, role-specific workflows, reporting, and PDF generation.

## Overview

The system provides dedicated workflows for three main user roles:

- **Administrators** — manage students, teachers, courses, batches, enrollments, payments, and reports.
- **Teachers** — manage course-related activities, homework, questions, tests, student answers, and results.
- **Students** — access courses, assessment-related workflows, answers, and results through dedicated authenticated routes.

## Key Features

### Administration
- Student and teacher management
- Course and batch management
- Student enrollment management
- Payment management
- Administrative dashboards and workflows
- PDF payment receipt generation

### Teacher
- Course-related management
- Homework management
- Question and test management
- Student answer review
- Result management

### Student
- Dedicated student authentication flow
- Course access
- Assessment-related workflows
- Answer submission and management
- Result viewing

## Tech Stack

- **Backend:** PHP 8.2+, Laravel 11
- **Database:** MySQL
- **Architecture:** MVC
- **ORM:** Eloquent
- **Frontend:** Blade, HTML, CSS, JavaScript
- **Authentication:** Role-specific Laravel authentication flows
- **PDF Generation:** DomPDF
- **Package Management:** Composer, npm

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
resources/
├── views/
routes/
├── web.php
├── admin-auth.php
├── teacher-auth.php
└── students-auth.php
```

The application separates key workflows by user type and uses Laravel models, controllers, routes, migrations, and Blade views to keep the codebase organized and maintainable.

## Main Domain Models

The system includes models for core LMS entities such as:

- Students
- Teachers
- Courses
- Batches
- Enrollments
- Payments
- Homework
- Questions
- Tests
- Student Answers
- Results

## Installation

### Requirements

- PHP 8.2+
- Composer
- Node.js and npm
- MySQL

### Setup

1. Clone the repository:

```bash
git clone https://github.com/ra1ya/E_learn.git
cd E_learn/learning-system
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install frontend dependencies:

```bash
npm install
```

4. Create the environment file:

```bash
cp .env.example .env
```

5. Generate the application key:

```bash
php artisan key:generate
```

6. Configure your MySQL database credentials in `.env`.

7. Run the migrations:

```bash
php artisan migrate
```

8. Start the frontend development server:

```bash
npm run dev
```

9. Start the Laravel development server:

```bash
php artisan serve
```

## Portfolio Highlights

This project demonstrates hands-on experience with:

- Multi-role application workflows
- Laravel MVC architecture
- Authentication and route separation
- Relational database design
- Eloquent models and relationships
- Business workflow implementation
- PDF document generation
- Maintainable backend structure

## Author

**Rian Aldini**  
Full-Stack Web & Mobile Developer  
Laravel • PHP • MySQL • Flutter

LinkedIn: https://www.linkedin.com/in/rian-aldini-353102329
