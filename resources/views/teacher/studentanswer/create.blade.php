@extends('teacher.layouts.app')

@section('content')
    <h1> insert new answer   </h1>

    <form action="{{ route('teacher.studentanswer.store') }}" method="POST">
        @csrf
        <input type="hidden" name="homework_id" value="{{ $homework->id }}">
        <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">

        @foreach($homework->questions as $question)
            <div>
                <label>{{ $question->text }}</label>
                @if($question->type == 'radio')
                    @foreach(json_decode($question->options) as $option)
                        <input type="radio" name="answers[{{ $loop->index }}][answer]" value="{{ $option }}">
                        {{ $option }}
                    @endforeach
                @elseif($question->type == 'checkbox')
                    @foreach(json_decode($question->options) as $option)
                        <input type="checkbox" name="answers[{{ $loop->index }}][answer][]" value="{{ $option }}">
                        {{ $option }}
                    @endforeach
                @else
                    <textarea name="answers[{{ $loop->index }}][answer]"></textarea>
                @endif
                <input type="hidden" name="answers[{{ $loop->index }}][question_id]" value="{{ $question->id }}">
            </div>
        @endforeach

        <button type="submit">submit answer</button>
    </form>
@endsection
