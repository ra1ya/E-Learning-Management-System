@extends('students.layouts.app')

@section('content')
    <h1>تفاصيل الإجابة</h1>

    <p><strong>الطالب:</strong> {{ $studentAnswer->student->name }}</p>
    <p><strong>الواجب:</strong> {{ $studentAnswer->homework->title }}</p>
    <p><strong>السؤال:</strong> {{ $studentAnswer->question->text }}</p>
    <p><strong>الإجابة:</strong> {{ $studentAnswer->answer }}</p>

    <a href="{{ route('teacher.studentanswer.index') }}">العودة إلى القائمة</a>
@endsection
