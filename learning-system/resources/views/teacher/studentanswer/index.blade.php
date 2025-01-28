@extends('teacher.layouts.app')

@section('content')
<br/>
<div class="content">
    <div class="card-header">
        <h2>Student Assignments</h2>
    </div>
    <div class="card-body" style="background-color: white">
        <a href="{{ route('teacher.studentanswer.create') }}" class="btn btn-success btn-sm">Add New Student Answer</a>
        <br/><br/>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Course Name</th>
                        <th>Assignment Title</th>
                        <th>Total Marks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studentAnswers as $answer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $answer['student']->name ?? 'Unknown Student' }}</td>
                        <td>{{ $answer['homework']->courses->name ?? 'Unknown Homework' }}</td>
                        <td>{{ $answer['homework']->title ?? 'No Homework' }}</td>
                        <td>{{ $answer['total_marks'] }} / {{ $answer['max_marks'] }}</td>

                        <td>
                         

                        </td> 
                    </tr>
                @endforeach
                
                          
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
