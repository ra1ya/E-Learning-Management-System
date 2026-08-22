<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Batches;
use App\Models\Courses;
use App\Models\Enrollment;
use App\Models\Payments;
use App\Models\Students;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Demo Admin',
                'password' => Hash::make('password'),
                'mobile' => '+000000000001',
            ]
        );

        Teacher::updateOrCreate(
            ['email' => 'teacher@example.com'],
            [
                'name' => 'Demo Teacher',
                'password' => Hash::make('password'),
                'mobile' => '+000000000201',
            ]
        );

        $student = Students::updateOrCreate(
            ['email' => 'student1@example.com'],
            [
                'name' => 'Demo Student',
                'password' => Hash::make('password'),
                'mobile' => '+000000000101',
                'address' => 'Demo City',
            ]
        );

        $course = Courses::updateOrCreate(
            ['name' => 'Laravel Fundamentals'],
            [
                'syllabus' => 'MVC, routing, Eloquent, authentication and database workflows',
                'duration' => '8 weeks',
                'video_link' => null,
                'pdf_file' => null,
            ]
        );

        $batch = Batches::updateOrCreate(
            ['name' => 'Laravel Demo Batch'],
            [
                'course_id' => $course->id,
                'start_date' => '2026-09-01',
            ]
        );

        $enrollment = Enrollment::updateOrCreate(
            ['enroll_no' => 'DEMO-ENR-001'],
            [
                'batch_id' => $batch->id,
                'student_id' => $student->id,
                'join_date' => '2026-09-01',
                'fee' => 100,
            ]
        );

        Payments::updateOrCreate(
            ['enrollment_id' => $enrollment->id, 'paid_date' => '2026-09-01'],
            ['amount' => 100]
        );
    }
}
