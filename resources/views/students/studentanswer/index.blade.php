@extends('students.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach($homeworks as $homework)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h5>{{ $homework->title }}</h5>
                </div>
                <div class="card-body">
                    <p>{{ Str::limit($homework->description, 100) }}</p>
                    <center>
                        <a href="{{ route('students.studentanswer.create') }}?homework_id={{ $homework->id }}" class="btn btn-success">homework answer</a>
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
