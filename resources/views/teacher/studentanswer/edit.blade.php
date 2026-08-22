@extends('layouts.app')

@section('content')
    <h1> edit answer</h1>

    <form action="{{ route('teacher.studentanswer.update', $studentAnswer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>{{ $studentAnswer->question->text }}</label>
            <textarea name="answer">{{ $studentAnswer->answer }}</textarea>
        </div>

        <button type="submit">update answer </button>
    </form>
@endsection
