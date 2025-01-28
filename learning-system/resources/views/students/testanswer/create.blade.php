@extends('students.layouts.app')

@section('content')
<br/>
    

    @php
        // التحقق من تسليم الإجابة
        $submitted = $test->testanswer()->where('student_id', auth()->user()->id)->exists();
    @endphp

    @if ($submitted)
        <!-- رسالة تأكيد التسليم -->
        <div class="alert alert-success">
            <h5>The test was submitted successfully</h5>
            <p> you cannot edit or resubmit answers</p>
        </div>
    @else
    
        <!-- نموذج الإجابة -->
        <form action="{{ route('students.testanswer.store') }}" method="POST">
            @csrf
            <input type="hidden" name="test_id" value="{{ $test->id }}">
            <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">

            <div class="row">
                @foreach($test->testques as $index => $testques)
                    <div class="col-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h5 class="card-title">{{ $testques->text }}</h5>
                            </div>
                            <div class="card-body">
                                @if($testques->type == 'radio')
                                    @foreach(json_decode($testques->options) as $option)
                                        <div class="form-check">
                                            <input type="radio" name="answers[{{ $index }}][answer]" value="{{ $option }}" class="form-check-input" id="option_{{ $index }}_{{ $loop->index }}">
                                            <label class="form-check-label" for="option_{{ $index }}_{{ $loop->index }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                    @endforeach
                                @elseif($testques->type == 'checkbox')
                                    @foreach(json_decode($testques->options) as $option)
                                        <div class="form-check">
                                            <input type="checkbox" name="answers[{{ $index }}][answer][]" value="{{ $option }}" class="form-check-input" id="checkbox_{{ $index }}_{{ $loop->index }}">
                                            <label class="form-check-label" for="checkbox_{{ $index }}_{{ $loop->index }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    <textarea name="answers[{{ $index }}][answer]" class="form-control" placeholder="enter answer..."></textarea>
                                @endif
                                <input type="hidden" name="answers[{{ $index }}][testques_id]" value="{{ $testques->id }}">
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
