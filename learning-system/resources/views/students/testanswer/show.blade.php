@extends('students.layouts.app')

@section('content')
    <h1>تفاصيل الإجابة</h1>

    <p><strong>الطالب:</strong> {{ $testanswer->student->name }}</p>
    <p><strong>الواجب:</strong> {{ $testanswer->test->title }}</p>
    <p><strong>السؤال:</strong> {{ $testanswer->testques->text }}</p>
    <p><strong>الإجابة:</strong> {{ $testanswer->answer }}</p>

    <a href="{{ route('teacher.testanswer.index') }}">العودة إلى القائمة</a>
@endsection
