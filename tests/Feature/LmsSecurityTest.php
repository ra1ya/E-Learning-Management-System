<?php

namespace Tests\Feature;

use App\Models\Batches;
use App\Models\Courses;
use App\Models\Enrollment;
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
        [$student, $otherStudent, $course, $homework, $question] = $this->homeworkFixture();
        $this->enroll($student, $course);

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

    public function test_unenrolled_student_cannot_open_or_submit_homework(): void
    {
        [$student, , , $homework, $question] = $this->homeworkFixture();

        $this->actingAs($student, 'students')
            ->get(route('students.studentanswer.create', ['homework_id' => $homework->id]))
            ->assertForbidden();

        $this->actingAs($student, 'students')
            ->post(route('students.studentanswer.store'), [
                'homework_id' => $homework->id,
                'answers' => [
                    ['question_id' => $question->id, 'answer' => 'PHP'],
                ],
            ])
            ->assertForbidden();
    }

    public function test_student_course_access_is_limited_to_enrollments(): void
    {
        $student = $this->student('student-one@example.com', '0001');
        $allowed = Courses::create(['name' => 'Allowed', 'syllabus' => 'Demo', 'duration' => '1 week']);
        $blocked = Courses::create(['name' => 'Blocked', 'syllabus' => 'Demo', 'duration' => '1 week']);
        $this->enroll($student, $allowed);

        $this->actingAs($student, 'students')
            ->get(route('students.courses.show', $allowed->id))
            ->assertOk();

        $this->actingAs($student, 'students')
            ->get(route('students.courses.show', $blocked->id))
            ->assertForbidden();
    }

    public function test_question_resource_does_not_publish_broken_create_or_store_routes(): void
    {
        $routes = collect(app('router')->getRoutes()->getRoutes())
            ->pluck('uri')
            ->filter(fn ($uri) => str_starts_with($uri, 'teacher/question'))
            ->values();

        $this->assertFalse($routes->contains('teacher/question/create'));
    }

    private function homeworkFixture(): array
    {
        $student = $this->student('student-one@example.com', '0001');
        $otherStudent = $this->student('student-two@example.com', '0002');
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

        return [$student, $otherStudent, $course, $homework, $question];
    }

    private function student(string $email, string $mobile): Students
    {
        return Students::create([
            'name' => 'Demo Student',
            'email' => $email,
            'password' => 'password',
            'mobile' => $mobile,
            'address' => 'Demo City',
        ]);
    }

    private function enroll(Students $student, Courses $course): Enrollment
    {
        $batch = Batches::create([
            'name' => 'Demo Batch '.$course->id,
            'course_id' => $course->id,
            'start_date' => '2026-01-01',
        ]);

        return Enrollment::create([
            'enroll_no' => 'ENR-'.$student->id.'-'.$course->id,
            'batch_id' => $batch->id,
            'student_id' => $student->id,
            'join_date' => '2026-01-01',
            'fee' => 100,
        ]);
    }
}
