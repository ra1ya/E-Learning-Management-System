@extends('teacher.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">View Homework</div>
        <div class="card-body">
            <h4>{{ $homework->title }}</h4>
            <p>{{ $homework->description }}</p>
            <p>course: {{ $homework->course->name }}</p>
            <p>Deadline: {{ $homework->deadline }}</p>

            <hr>

            <h5>Questions</h5>
            @foreach($homework->question as $question)
                <div class="question">
                    <p><strong>Question:</strong> {{ $question->text }}</p>
                    <p><strong>Type:</strong> {{ $question->type }}</p>
                    @if($question->options)
                        <p><strong>Options:</strong></p>
                        <ul>
                            @foreach(json_decode($question->options) as $option)
                                <li>{{ $option }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if($question->correct_answers)
                        <p><strong>correct_answers:</strong></p>
                        <ul>
                            @foreach(json_decode($question->correct_answers) as $correct_answers)
                                <li>{{ $correct_answers }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <hr>
            @endforeach
            @if(session('earnedMarks') !== null)
    <p>Total Marks: {{ session('earnedMarks') }} / {{ session('totalMarks') }}</p>
@endif


        </div>
    </div>
@endsection
