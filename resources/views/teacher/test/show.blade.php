@extends('teacher.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">View Test</div>
        <div class="card-body">
            <h4>{{ $test->title }}</h4>
            <p>{{ $test->description }}</p>
            <p>course: {{ $test->courses->name }}</p>
            <p>Deadline: {{ $test->deadline }}</p>

            <hr>

            <h5>testques</h5>
            @foreach($test->testques as $testques)
                <div class="testques">
                    <p><strong>testques:</strong> {{ $testques->text }}</p>
                    <p><strong>Type:</strong> {{ $testques->type }}</p>
                    @if($testques->options)
                        <p><strong>Options:</strong></p>
                        <ul>
                            @foreach(json_decode($testques->options) as $option)
                                <li>{{ $option }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if($testques->correct_answers)
                        <p><strong>correct_answers:</strong></p>
                        <ul>
                            @foreach(json_decode($testques->correct_answers) as $correct_answers)
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
