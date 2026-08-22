@extends('students.layouts.app')

@section('content')
<br/>
    

    @php
        // التحقق من تسليم الإجابة
        $submitted = $homework->studentAnswer()->where('student_id', auth()->user()->id)->exists();
    @endphp

    @if ($submitted)
        <!-- رسالة تأكيد التسليم -->
        <div class="alert alert-success">
            <h5>The assignment was submitted successfully</h5>
            <p>You cannot edit or resubmit answers</p>
        </div>
    @else
    
        <!-- نموذج الإجابة -->
        <form action="{{ route('students.studentanswer.store') }}" method="POST">
            @csrf
            <input type="hidden" name="homework_id" value="{{ $homework->id }}">
            <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">

            <div class="row">
                @foreach($homework->question as $index => $question)
                    <div class="col-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h5 class="card-title">{{ $question->text }}</h5>
                            </div>
                            <div class="card-body">
                                @if($question->type == 'radio')
                                    @foreach(json_decode($question->options) as $option)
                                        <div class="form-check">
                                            <input type="radio" name="answers[{{ $index }}][answer]" value="{{ $option }}" class="form-check-input" id="option_{{ $index }}_{{ $loop->index }}">
                                            <label class="form-check-label" for="option_{{ $index }}_{{ $loop->index }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                    @endforeach
                                @elseif($question->type == 'checkbox')
                                    @foreach(json_decode($question->options) as $option)
                                        <div class="form-check">
                                            <input type="checkbox" name="answers[{{ $index }}][answer][]" value="{{ $option }}" class="form-check-input" id="checkbox_{{ $index }}_{{ $loop->index }}">
                                            <label class="form-check-label" for="checkbox_{{ $index }}_{{ $loop->index }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    <textarea name="answers[{{ $index }}][answer]" class="form-control" placeholder="أدخل إجابتك هنا..."></textarea>
                                @endif
                                <input type="hidden" name="answers[{{ $index }}][question_id]" value="{{ $question->id }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Submit answer</button>
            </div>
        </form>
    @endif
@endsection
