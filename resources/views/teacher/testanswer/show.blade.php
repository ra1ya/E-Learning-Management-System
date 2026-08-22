@extends('teacher.layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Student Answer Details</div>
    <div class="card-body">
        <h5 class="card-title">Question: {{ $testanswer->testques->text }}</h5>
        <p class="card-text">Student Answer: {{ $testanswer->answer }}</p>
        <p class="card-text">Correct Answer: {{ $testanswer->testques->correct_answers }}</p>
        <p class="card-text">Marks: {{ $testanswer->testques->marks }}</p>
        <p class="card-text">Homework Title: {{ $testanswer->test->title }}</p>
        
    </div>
</div>
@endsection
