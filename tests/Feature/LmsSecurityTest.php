<?php

namespace Tests\Feature;

use App\Models\Courses;
use App\Models\Homework;
use App\Models\Question;
use App\Models\StudentAnswer;
use App\Models\Students;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LmsSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_and_teacher_registration_are_not_public(): void
    {
        $this->get('/admin/register')->assertNotFound();
        $this->get('/teacher/register')->assertNotFound();
    }

    public function test_payment_report_requires_admin_authentication(): void
    {
        $this->get('/report/report1/1')->assertRedirect(route('admin.login'));
    }

    public function test_homework_submission_uses_authenticated_student_identity(): void
    {
        $student = Students::create([
            'name' => 'Student One',
            'email' => 'student-one@example.com',
            'password' => 'password',
            'mobile' => '0001',
            'address' => 'Demo City',
        ]);

        $otherStudent = Students::create([
            'name' => 'Student Two',
            'email' => 'student-two@example.com',
            'password' => 'password',
            'mobile' => '0002',
            'address' => 'Demo City',
        ]);

        $course = Courses::create([
            'name' => 'Security Demo',
            'syllabus' => 'Demo',
            'duration' => '1 week',
        ]);

        $homework = Homework::create([
            'title' => 'Demo Homework',
            'course_id' => $course->id,
            'description' => 'Demo',
            'deadline' => '2026-12-01',
        ]);

        $question = Question::create([
            'homework_id' => $homework->id,
            'text' => 'Laravel is written in?',
            'type' => 'radio',
            'options' => json_encode(['PHP', 'Dart']),
            'correct_answers' => json_encode(['PHP']),
            'marks' => 5,
        ]);

        $this->actingAs($student, 'students')
            ->post(route('students.studentanswer.store'), [
                'homework_id' => $homework->id,
                'student_id' => $otherStudent->id,
                'answers' => [
                    ['question_id' => $question->id, 'answer' => 'PHP'],
                ],
            ])
            ->assertRedirect(route('students.studentanswer.result'));

        $answer = StudentAnswer::firstOrFail();
        $this->assertSame($student->id, $answer->student_id);
        $this->assertTrue((bool) $answer->is_correct);
        $this->assertSame(5.0, (float) $answer->total_marks);
    }
}
