@extends('teacher.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Student Answer Details</div>
    <div class="card-body">
        <h5 class="card-title">Question: {{ $studentAnswer->question->text }}</h5>
        <p class="card-text">Student Answer: {{ $studentAnswer->answer }}</p>
        <p class="card-text">Correct Answer: {{ $studentAnswer->question->correct_answers }}</p>
        <p class="card-text">Marks: {{ $studentAnswer->question->marks }}</p>
        <p class="card-text">Homework Title: {{ $studentAnswer->homework->title }}</p>
        
    </div>
</div>
@endsection
