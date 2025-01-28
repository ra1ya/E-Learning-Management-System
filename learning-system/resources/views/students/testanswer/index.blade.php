@extends('students.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach($testanswer as $test)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h5>{{ $test->title }}</h5>
                </div>
                <div class="card-body">
                    <p>{{ Str::limit($test->description, 100) }}</p>
                    <center>
                        <a href="{{ route('students.testanswer.create') }}?test_id={{ $test->id }}" class="btn btn-success">test answer</a>
                    </center>
                </div>
            </div>
        </div>
        @if(session('success'))
        <div class="alert alert-success text-center my-4">
            {{ session('success') }}
        </div>
    @endif
    

        @endforeach
    </div>
</div>
@endsection
